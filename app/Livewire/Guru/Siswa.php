<?php

namespace App\Livewire\Guru;

use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Siswa extends Component
{
    use WithPagination;
    use WithFileUploads;

    public ?string $className = null;
    public string $search = '';
    public string $sortBy = 'name_asc';

    // Deposit Modal State
    public ?int $selectedStudentId = null;
    public string $selectedStudentName = '';
    public string $depositAmount = '';

    // Withdrawal Modal State
    public bool $isWithdrawalModalOpen = false;
    public ?int $withdrawalStudentId = null;
    public string $withdrawalStudentName = '';
    public float $withdrawalStudentBalance = 0;
    public string $withdrawalAmount = '';

    // Single Student CRUD Form State
    public bool $isFormOpen = false;
    public ?int $studentId = null;
    public string $nisn = '';
    public string $name = '';
    public float $balance = 0.00;
    public float $saving_target = 500000.00;

    // CSV Import State
    public bool $isImportOpen = false;
    public $csvFile = null;
    public array $importErrors = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'name_asc']
    ];

    public function mount()
    {
        if (Auth::user()->role !== 'guru') {
            abort(403, 'Akses ditolak.');
        }
        $this->className = Auth::user()->class_name ?? 'Kelas Saya';
    }

    // ==========================================
    // DEPOSIT MODAL LOGIC
    // ==========================================
    public function selectStudentForDeposit($studentId, $studentName)
    {
        $this->selectedStudentId = $studentId;
        $this->selectedStudentName = $studentName;
        $this->depositAmount = '';
        $this->resetValidation();
    }

    public function closeDepositModal()
    {
        $this->selectedStudentId = null;
        $this->selectedStudentName = '';
        $this->depositAmount = '';
        $this->resetValidation();
    }

    public function simpanSetoran($studentId = null, $amount = null)
    {
        if ($studentId !== null) {
            $this->selectedStudentId = (int) $studentId;
        }
        if ($amount !== null) {
            $this->depositAmount = (string) $amount;
        }

        $this->validate([
            'depositAmount' => 'required|integer|min:1000|max:10000000'
        ], [
            'depositAmount.required' => 'Nominal wajib diisi.',
            'depositAmount.integer' => 'Nominal harus berupa angka.',
            'depositAmount.min' => 'Nominal setoran minimal Rp 1.000.',
            'depositAmount.max' => 'Nominal setoran maksimal Rp 10.000.000 sekali transaksi.'
        ]);

        $success = false;

        DB::transaction(function () use (&$success) {
            $student = Student::where('id', $this->selectedStudentId)
                ->where(function ($q) {
                    $q->where('user_id', Auth::id())
                      ->orWhere('class_name', $this->className);
                })
                ->lockForUpdate()
                ->first();

            if ($student) {
                Transaction::create([
                    'student_id' => $student->id,
                    'user_id' => Auth::id(),
                    'type' => 'deposit',
                    'amount' => (float) $this->depositAmount,
                    'status' => 'approved',
                    'notes' => 'Setoran tunai oleh Wali Kelas'
                ]);

                $student->increment('balance', (float) $this->depositAmount);
                session()->flash('success', 'Setoran sebesar Rp ' . number_format($this->depositAmount, 0, ',', '.') . ' untuk ' . $student->name . ' berhasil disimpan.');
                $success = true;
            } else {
                session()->flash('error', 'Siswa tidak ditemukan.');
            }
        });

        $this->closeDepositModal();
        return $success;
    }


    // ==========================================
    // WITHDRAWAL MODAL LOGIC
    // ==========================================
    public function openWithdrawalModal($studentId, $studentName, $balance)
    {
        $this->withdrawalStudentId = $studentId;
        $this->withdrawalStudentName = $studentName;
        $this->withdrawalStudentBalance = (float) $balance;
        $this->withdrawalAmount = '';
        $this->isWithdrawalModalOpen = true;
        $this->resetValidation();
    }

    public function closeWithdrawalModal()
    {
        $this->isWithdrawalModalOpen = false;
        $this->withdrawalStudentId = null;
        $this->withdrawalStudentName = '';
        $this->withdrawalStudentBalance = 0;
        $this->withdrawalAmount = '';
        $this->resetValidation();
    }

    public function simpanPenarikan()
    {
        $this->validate([
            'withdrawalAmount' => [
                'required',
                'integer',
                'min:1000',
                'max:' . (int) $this->withdrawalStudentBalance
            ]
        ], [
            'withdrawalAmount.required' => 'Nominal penarikan wajib diisi.',
            'withdrawalAmount.integer' => 'Nominal harus berupa angka.',
            'withdrawalAmount.min' => 'Nominal penarikan minimal Rp 1.000.',
            'withdrawalAmount.max' => 'Nominal penarikan tidak boleh melebihi saldo aktif (Rp ' . number_format($this->withdrawalStudentBalance, 0, ',', '.') . ').'
        ]);

        DB::transaction(function () {
            $student = Student::where('id', $this->withdrawalStudentId)
                ->where(function ($q) {
                    $q->where('user_id', Auth::id())
                      ->orWhere('class_name', $this->className);
                })
                ->lockForUpdate()
                ->first();

            if ($student && $student->balance >= $this->withdrawalAmount) {
                Transaction::create([
                    'student_id' => $student->id,
                    'user_id' => Auth::id(),
                    'type' => 'withdrawal',
                    'amount' => $this->withdrawalAmount,
                    'status' => 'approved',
                    'notes' => 'Penarikan tunai oleh Wali Kelas'
                ]);

                $student->decrement('balance', $this->withdrawalAmount);
                session()->flash('success', 'Penarikan sebesar Rp ' . number_format($this->withdrawalAmount, 0, ',', '.') . ' untuk ' . $student->name . ' berhasil diproses.');
            } else {
                session()->flash('error', 'Saldo tidak mencukupi atau siswa tidak ditemukan.');
            }
        });

        $this->closeWithdrawalModal();
    }

    // ==========================================
    // SINGLE STUDENT FORM (CREATE / EDIT) LOGIC
    // ==========================================
    public function openForm($id = null)
    {
        $this->resetErrorBag();
        $this->studentId = $id;

        if ($id) {
            $student = Student::where('id', $id)
                ->where(function ($q) {
                    $q->where('user_id', Auth::id())
                      ->orWhere('class_name', $this->className);
                })
                ->firstOrFail();

            $this->nisn = $student->nisn;
            $this->name = $student->name;
            $this->balance = (float) $student->balance;
            $this->saving_target = (float) $student->saving_target;
        } else {
            $this->nisn = '';
            $this->name = '';
            $this->balance = 0.00;
            $this->saving_target = 500000.00;
        }

        $this->isFormOpen = true;
    }

    public function closeForm()
    {
        $this->isFormOpen = false;
        $this->reset(['studentId', 'nisn', 'name', 'balance', 'saving_target']);
        $this->resetErrorBag();
    }

    public function saveStudent()
    {
        $this->nisn = preg_replace('/\D/', '', $this->nisn);

        $rules = [
            'nisn' => [
                'required',
                'numeric',
                'digits:10',
                Rule::unique('students', 'nisn')->ignore($this->studentId),
            ],
            'name' => 'required|min:3|max:255',
            'balance' => 'required|numeric|min:0',
            'saving_target' => 'required|numeric|min:0',
        ];

        $this->validate($rules, [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.numeric' => 'NISN harus berupa angka.',
            'nisn.digits' => 'NISN harus tepat 10 digit.',
            'nisn.unique' => 'NISN ini sudah terdaftar.',
            'name.required' => 'Nama siswa wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'saving_target.required' => 'Target tabungan wajib diisi.',
        ]);

        if ($this->studentId) {
            $student = Student::where('id', $this->studentId)
                ->where(function ($q) {
                    $q->where('user_id', Auth::id())
                      ->orWhere('class_name', $this->className);
                })
                ->firstOrFail();

            $oldNisn = $student->nisn;

            $updateData = [
                'nisn' => $this->nisn,
                'name' => trim($this->name),
                'saving_target' => $this->saving_target,
                'parent_username' => 'ortu_' . $this->nisn,
            ];

            if ($oldNisn !== $this->nisn) {
                $updateData['parent_password'] = Hash::make($this->nisn);
                $updateData['must_change_password'] = true;
            }

            $student->update($updateData);
            session()->flash('success', 'Data siswa ' . $this->name . ' berhasil diperbarui.');
        } else {
            $student = Student::create([
                'user_id' => Auth::id(),
                'nisn' => $this->nisn,
                'name' => trim($this->name),
                'class_name' => $this->className ?? Auth::user()->class_name ?? 'Kelas 1-A',
                'balance' => $this->balance,
                'saving_target' => $this->saving_target,
                'parent_username' => 'ortu_' . $this->nisn,
                'parent_password' => Hash::make($this->nisn),
                'must_change_password' => true,
            ]);

            if ($this->balance > 0) {
                Transaction::create([
                    'student_id' => $student->id,
                    'user_id' => Auth::id(),
                    'type' => 'deposit',
                    'amount' => $this->balance,
                    'status' => 'approved',
                    'notes' => 'Setoran Awal Tabungan Baru',
                ]);
            }

            session()->flash('success', 'Siswa baru ' . $this->name . ' berhasil ditambahkan.');
        }

        $this->closeForm();
    }

    // Delete Student Confirmation Modal State
    public bool $isDeleteModalOpen = false;
    public ?int $deletingStudentId = null;
    public string $deletingStudentName = '';

    public function openDeleteModal($id, $name)
    {
        $this->deletingStudentId = $id;
        $this->deletingStudentName = $name;
        $this->isDeleteModalOpen = true;
    }

    public function closeDeleteModal()
    {
        $this->isDeleteModalOpen = false;
        $this->deletingStudentId = null;
        $this->deletingStudentName = '';
    }

    public function deleteStudent()
    {
        if (!$this->deletingStudentId) return;

        $student = Student::where('id', $this->deletingStudentId)
            ->where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->orWhere('class_name', $this->className);
            })
            ->first();

        if ($student) {
            $name = $student->name;
            $student->delete();
            session()->flash('success', 'Data siswa ' . $name . ' berhasil dihapus.');
        }

        $this->closeDeleteModal();
    }


    public function resetPasswordOrangTua($studentId)
    {
        $student = Student::where('id', $studentId)
            ->where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->orWhere('class_name', $this->className);
            })
            ->firstOrFail();

        $student->update([
            'parent_password' => Hash::make($student->nisn),
            'must_change_password' => true,
        ]);

        session()->flash('success', 'Password Orang Tua ' . $student->name . ' berhasil direset ke NISN (' . $student->nisn . ').');
    }

    // ==========================================
    // CSV IMPORT LOGIC
    // ==========================================
    public function openImportModal()
    {
        $this->reset(['csvFile', 'importErrors']);
        $this->isImportOpen = true;
        $this->resetErrorBag();
    }

    public function closeImportModal()
    {
        $this->isImportOpen = false;
        $this->reset(['csvFile', 'importErrors']);
        $this->resetErrorBag();
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_import_siswa_kelas.csv"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['Nama Siswa', 'NISN', 'Saldo Awal']);
            fputcsv($file, ['Ahmad Rafif', '0123456789', '50000']);
            fputcsv($file, ['Siti Aisyah', '0987654321', '0']);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function importCsv()
    {
        $this->validate([
            'csvFile' => 'required|file|mimes:csv,txt|max:2048',
        ], [
            'csvFile.required' => 'Pilih berkas CSV terlebih dahulu.',
            'csvFile.file' => 'Berkas tidak valid.',
            'csvFile.mimes' => 'Berkas harus berupa file dengan ekstensi .csv.',
            'csvFile.max' => 'Ukuran berkas maksimal 2MB.',
        ]);

        $path = $this->csvFile->getRealPath();
        $file = fopen($path, 'r');

        $bom = fread($file, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($file);
        }

        $header = fgetcsv($file, 1000, ',');
        $delimiter = ',';

        if (count($header) === 1 && strpos($header[0], ';') !== false) {
            rewind($file);
            $bom = fread($file, 3);
            if ($bom !== "\xEF\xBB\xBF") {
                rewind($file);
            }
            $delimiter = ';';
            $header = fgetcsv($file, 1000, $delimiter);
        }

        $importedCount = 0;
        $errors = [];
        $lineNumber = 1;

        while (($row = fgetcsv($file, 1000, $delimiter)) !== false) {
            $lineNumber++;
            if (empty(array_filter($row))) {
                continue;
            }

            $name = trim($row[0] ?? '');
            $nisn = preg_replace('/\D/', '', trim($row[1] ?? ''));
            $balance = floatval(trim($row[2] ?? '0'));

            if (empty($name)) {
                $errors[] = "Baris {$lineNumber}: Nama siswa kosong.";
                continue;
            }

            if (strlen($nisn) !== 10) {
                $errors[] = "Baris {$lineNumber}: NISN '{$row[1]}' harus tepat 10 digit angka.";
                continue;
            }

            if (Student::where('nisn', $nisn)->exists()) {
                $errors[] = "Baris {$lineNumber}: NISN '{$nisn}' sudah terdaftar dalam sistem.";
                continue;
            }

            $student = Student::create([
                'user_id' => Auth::id(),
                'nisn' => $nisn,
                'name' => $name,
                'class_name' => $this->className ?? Auth::user()->class_name ?? 'Kelas 1-A',
                'balance' => $balance,
                'saving_target' => 500000.00,
                'parent_username' => 'ortu_' . $nisn,
                'parent_password' => Hash::make($nisn),
                'must_change_password' => true,
            ]);

            if ($balance > 0) {
                Transaction::create([
                    'student_id' => $student->id,
                    'user_id' => Auth::id(),
                    'type' => 'deposit',
                    'amount' => $balance,
                    'status' => 'approved',
                    'notes' => 'Setoran Awal Impor CSV',
                ]);
            }

            $importedCount++;
        }

        fclose($file);

        $this->importErrors = $errors;

        if ($importedCount > 0) {
            session()->flash('success', "Berhasil mengimpor {$importedCount} data siswa baru ke dalam kelas Anda.");
            if (empty($errors)) {
                $this->closeImportModal();
            }
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Student::query()
            ->where(function ($q) {
                $q->where('user_id', Auth::id());
                if ($this->className) {
                    $q->orWhere('class_name', $this->className);
                }
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('nisn', 'like', '%' . $this->search . '%');
                });
            });

        if ($this->sortBy === 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($this->sortBy === 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($this->sortBy === 'balance_desc') {
            $query->orderBy('balance', 'desc');
        } elseif ($this->sortBy === 'balance_asc') {
            $query->orderBy('balance', 'asc');
        }

        $students = $query->paginate(10);

        return view('livewire.guru.siswa', [
            'students' => $students
        ])->layout('layouts.dashboard', ['title' => 'Kelola Siswa - ' . ($this->className ?? 'Kelas Saya')]);
    }
}

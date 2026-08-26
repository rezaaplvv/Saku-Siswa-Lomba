<?php

namespace App\Livewire\Admin;

use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Siswa extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $search = '';
    public string $classFilter = '';
    public string $schoolFilter = '';

    public function updatingSchoolFilter()
    {
        $this->resetPage();
    }

    // Form fields
    public $studentId = null;
    public string $nisn = '';
    public string $name = '';
    public string $class_name = '';
    public float $balance = 0.00;
    public float $saving_target = 500000.00;

    // CSV Import fields
    public bool $isImportOpen = false;
    public $csvFile = null;
    public array $importErrors = [];

    // Bulk delete fields
    public array $selectedStudents = [];
    public bool $selectAll = false;
    public bool $isSelectionMode = false;

    public bool $isFormOpen = false;

    public function mount()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
    }

    public function openForm($id = null)
    {
        $this->resetErrorBag();
        $this->studentId = $id;

        if ($id) {
            $student = Student::findOrFail($id);
            $this->nisn = $student->nisn;
            $this->name = $student->name;
            $this->class_name = $student->class_name;
            $this->balance = (float) $student->balance;
            $this->saving_target = (float) $student->saving_target;
        } else {
            $this->nisn = '';
            $this->name = '';
            $this->class_name = '';
            $this->balance = 0.00;
            $this->saving_target = 500000.00;
        }

        $this->isFormOpen = true;
    }

    public function closeForm()
    {
        $this->isFormOpen = false;
        $this->reset(['studentId', 'nisn', 'name', 'class_name', 'balance', 'saving_target']);
        $this->resetErrorBag();
    }

    public function saveStudent()
    {
        // Remove any accidental spaces or non-digit characters (e.g. from copy-paste)
        $this->nisn = preg_replace('/\D/', '', $this->nisn);

        $rules = [
            'nisn' => [
                'required',
                'numeric',
                'digits:10',
                Rule::unique('students', 'nisn')->ignore($this->studentId),
            ],
            'name' => 'required|min:3',
            'class_name' => 'required',
            'balance' => 'required|numeric|min:0',
            'saving_target' => 'required|numeric|min:0',
        ];

        $this->validate($rules, [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.numeric' => 'NISN harus berupa angka.',
            'nisn.digits' => 'NISN harus tepat 10 digit.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'name.required' => 'Nama siswa wajib diisi.',
            'name.min' => 'Nama minimal terdiri dari 3 karakter.',
            'class_name.required' => 'Kelas wajib diampu.',
            'balance.required' => 'Saldo awal wajib ditentukan.',
            'balance.min' => 'Saldo awal tidak boleh negatif.',
            'saving_target.required' => 'Target tabungan wajib ditentukan.',
            'saving_target.min' => 'Target tabungan tidak boleh negatif.',
        ]);

        if ($this->studentId) {
            // Update
            $student = Student::findOrFail($this->studentId);
            $oldNisn = $student->nisn;

            $updateData = [
                'nisn' => $this->nisn,
                'name' => $this->name,
                'class_name' => $this->class_name,
                'saving_target' => $this->saving_target,
                'parent_username' => 'ortu_' . $this->nisn,
            ];

            // Issue 4: If NISN changes, regenerate parent password using new NISN
            if ($oldNisn !== $this->nisn) {
                $updateData['parent_password'] = Hash::make($this->nisn);
                $updateData['must_change_password'] = true;
            }

            $student->update($updateData);
            session()->flash('success', 'Data siswa ' . $this->name . ' berhasil diperbarui.');
        } else {
            // Create
            $student = Student::create([
                'nisn' => $this->nisn,
                'name' => $this->name,
                'class_name' => $this->class_name,
                'balance' => $this->balance,
                'saving_target' => $this->saving_target,
                'parent_username' => 'ortu_' . $this->nisn,
                'parent_password' => Hash::make($this->nisn),
                'must_change_password' => true,
            ]);

            // Issue 1: Log initial deposit transaction if starting balance > 0
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

            session()->flash('success', 'Siswa baru ' . $this->name . ' beserta akun orang tua berhasil ditambahkan.');
        }

        $this->closeForm();
    }

    public function deleteStudent($id)
    {
        $student = Student::findOrFail($id);
        $name = $student->name;
        
        $student->delete();
        session()->flash('success', 'Data siswa ' . $name . ' berhasil dihapus.');
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedStudents = Student::query()
                ->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('nisn', 'like', '%' . $this->search . '%');
                    });
                })
                ->when($this->classFilter, function ($query) {
                    $query->where('class_name', $this->classFilter);
                })
                ->pluck('id')
                ->map(fn($id) => (string)$id)
                ->toArray();
        } else {
            $this->selectedStudents = [];
        }
    }

    public function updatedSelectedStudents()
    {
        $this->selectAll = false;
    }

    public function deleteSelected()
    {
        if (count($this->selectedStudents) > 0) {
            $count = count($this->selectedStudents);
            
            Student::whereIn('id', $this->selectedStudents)->delete();

            session()->flash('success', "Berhasil menghapus {$count} data siswa terpilih.");
            $this->selectedStudents = [];
            $this->selectAll = false;
            $this->isSelectionMode = false;
        }
    }

    public function toggleSelectionMode()
    {
        $this->isSelectionMode = !$this->isSelectionMode;
        if (!$this->isSelectionMode) {
            $this->selectedStudents = [];
            $this->selectAll = false;
        }
    }

    public bool $isClassroomModalOpen = false;
    public string $newClassroomName = '';

    public function openClassroomModal()
    {
        $this->newClassroomName = '';
        $this->isClassroomModalOpen = true;
        $this->resetErrorBag();
    }

    public function closeClassroomModal()
    {
        $this->isClassroomModalOpen = false;
    }

    public function addClassroom()
    {
        $this->validate([
            'newClassroomName' => 'required|min:2|max:10|unique:classrooms,name'
        ], [
            'newClassroomName.required' => 'Nama kelas wajib diisi.',
            'newClassroomName.min' => 'Minimal 2 karakter.',
            'newClassroomName.max' => 'Maksimal 10 karakter.',
            'newClassroomName.unique' => 'Kelas sudah terdaftar.'
        ]);

        \App\Models\Classroom::create([
            'name' => strtoupper(trim($this->newClassroomName))
        ]);

        $this->newClassroomName = '';
        session()->flash('class_success', 'Kelas baru berhasil ditambahkan.');
    }

    public function deleteClassroom($id)
    {
        $classroom = \App\Models\Classroom::findOrFail($id);
        
        $hasStudents = \App\Models\Student::where('class_name', $classroom->name)->exists();
        $hasTeachers = \App\Models\User::where('class_name', $classroom->name)->exists();

        if ($hasStudents || $hasTeachers) {
            session()->flash('class_error', 'Kelas tidak bisa dihapus karena sedang digunakan.');
            return;
        }

        $classroom->delete();
        session()->flash('class_success', 'Kelas berhasil dihapus.');
    }

    public function resetPasswordOrangTua($studentId)
    {
        $student = Student::findOrFail($studentId);
        $student->update([
            'parent_password' => Hash::make($student->nisn),
            'must_change_password' => true,
        ]);
        session()->flash('success', 'Password Orang Tua ' . $student->name . ' berhasil direset ke NISN (' . $student->nisn . ') dan wajib diubah saat login berikutnya.');
    }

    public function resetPinOrangTua($studentId)
    {
        $student = Student::findOrFail($studentId);
        $student->update([
            'parent_pin' => null,
        ]);
        session()->flash('success', 'PIN Orang Tua ' . $student->name . ' berhasil direset ke NULL.');
    }

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
            'Content-Disposition' => 'attachment; filename="template_import_siswa.csv"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['Nama', 'NISN', 'Kelas', 'Saldo Awal']);
            fputcsv($file, ['Ahmad Rafif', '0123456789', '1-A', '50000']);
            fputcsv($file, ['Siti Aminah', '0987654321', '1-B', '0']);
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
            $header = fgetcsv($file, 1000, ';');
            $delimiter = ';';
        }

        if (!$header || count($header) < 3) {
            $this->addError('csvFile', 'Format file CSV tidak sesuai template. Pastikan minimal terdapat kolom Nama, NISN, dan Kelas.');
            fclose($file);
            return;
        }

        $rows = [];
        $rowNumber = 1;
        $errors = [];
        $seenNisns = [];

        $availableClasses = \App\Models\Classroom::pluck('name')->toArray();

        while (($data = fgetcsv($file, 1000, $delimiter)) !== false) {
            $rowNumber++;

            if (empty(array_filter($data))) {
                continue;
            }

            $name = trim($data[0] ?? '');
            $nisn = trim($data[1] ?? '');
            $className = strtoupper(trim($data[2] ?? ''));
            $saldoAwalRaw = trim($data[3] ?? '0');

            $nisnClean = preg_replace('/\D/', '', $nisn);

            if (empty($name)) {
                $errors[] = "Baris {$rowNumber}: Nama siswa tidak boleh kosong.";
            }

            if (empty($nisnClean) || strlen($nisnClean) !== 10) {
                $errors[] = "Baris {$rowNumber}: NISN harus berupa 10 digit angka.";
            } else {
                if (in_array($nisnClean, $seenNisns)) {
                    $errors[] = "Baris {$rowNumber}: NISN '{$nisnClean}' duplikat di dalam berkas CSV.";
                } else {
                    $seenNisns[] = $nisnClean;
                }

                if (Student::where('nisn', $nisnClean)->exists()) {
                    $errors[] = "Baris {$rowNumber}: NISN '{$nisnClean}' sudah terdaftar di sistem.";
                }
            }

            if (empty($className)) {
                $errors[] = "Baris {$rowNumber}: Kelas tidak boleh kosong.";
            } elseif (!in_array($className, $availableClasses)) {
                $errors[] = "Baris {$rowNumber}: Kelas '{$className}' tidak terdaftar di sistem. Daftarkan kelas terlebih dahulu.";
            }

            $saldoAwal = 0;
            if ($saldoAwalRaw !== '') {
                $cleanSaldo = str_replace(',', '.', $saldoAwalRaw);
                if (!is_numeric($cleanSaldo)) {
                    $errors[] = "Baris {$rowNumber}: Saldo Awal harus berupa angka.";
                } else {
                    $saldoAwal = (float) $cleanSaldo;
                    if ($saldoAwal < 0) {
                        $errors[] = "Baris {$rowNumber}: Saldo Awal tidak boleh kurang dari 0.";
                    }
                }
            }

            $rows[] = [
                'name' => $name,
                'nisn' => $nisnClean,
                'class_name' => $className,
                'balance' => $saldoAwal
            ];
        }
        fclose($file);

        if (count($errors) > 0) {
            $this->importErrors = $errors;
            return;
        }

        if (count($rows) === 0) {
            $this->addError('csvFile', 'Tidak ada data siswa yang valid di dalam berkas CSV.');
            return;
        }

        \DB::transaction(function () use ($rows) {
            foreach ($rows as $rowData) {
                $student = Student::create([
                     'nisn' => $rowData['nisn'],
                     'name' => $rowData['name'],
                     'class_name' => $rowData['class_name'],
                     'balance' => $rowData['balance'],
                     'saving_target' => 500000.00,
                     'parent_username' => 'ortu_' . $rowData['nisn'],
                     'parent_password' => Hash::make($rowData['nisn']),
                     'must_change_password' => true,
                ]);

                if ($rowData['balance'] > 0) {
                     Transaction::create([
                         'student_id' => $student->id,
                         'user_id' => Auth::id(),
                         'type' => 'deposit',
                         'amount' => $rowData['balance'],
                         'status' => 'approved',
                         'notes' => 'Setoran Awal Tabungan (Import CSV)',
                     ]);
                }
            }
        });

        session()->flash('success', 'Berhasil mengimpor ' . count($rows) . ' data siswa baru.');
        $this->closeImportModal();
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingClassFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $students = Student::query()
            ->with('user')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('nisn', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->classFilter, function ($query) {
                $query->where('class_name', $this->classFilter);
            })
            ->when($this->schoolFilter, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('school_name', $this->schoolFilter);
                });
            })
            ->orderBy('name', 'asc')
            ->paginate(10);

        $availableSchools = \App\Models\User::where('role', 'guru')
            ->whereNotNull('school_name')
            ->where('school_name', '!=', '')
            ->distinct()
            ->pluck('school_name');

        return view('livewire.admin.siswa', [
            'students' => $students,
            'classrooms' => \App\Models\Classroom::orderBy('name')->get(),
            'availableClasses' => \App\Models\Classroom::orderBy('name')->pluck('name')->toArray(),
            'availableSchools' => $availableSchools,
        ])->layout('layouts.dashboard', ['title' => 'Kelola Siswa - SakuSiswa']);
    }
}

<?php

namespace App\Livewire\Admin;

use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Laporan extends Component
{
    public function mount()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
    }

    public string $search = '';
    public string $typeFilter = 'all'; // all, deposit, withdrawal
    public string $schoolFilter = 'all'; // all, SDN 01, etc.
    public string $monthFilter = 'all'; // all, 1-12
    public ?string $startDate = null;
    public ?string $endDate = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'typeFilter' => ['except' => 'all'],
        'schoolFilter' => ['except' => 'all'],
        'monthFilter' => ['except' => 'all'],
        'startDate' => ['except' => ''],
        'endDate' => ['except' => '']
    ];

    public function setDateRangePreset($preset)
    {
        if ($preset === 'today') {
            $this->startDate = today()->toDateString();
            $this->endDate = today()->toDateString();
        } elseif ($preset === '7days') {
            $this->startDate = now()->subDays(6)->toDateString();
            $this->endDate = today()->toDateString();
        } elseif ($preset === 'this_month') {
            $this->startDate = now()->startOfMonth()->toDateString();
            $this->endDate = today()->toDateString();
        } elseif ($preset === 'last_month') {
            $this->startDate = now()->subMonth()->startOfMonth()->toDateString();
            $this->endDate = now()->subMonth()->endOfMonth()->toDateString();
        } elseif ($preset === 'all') {
            $this->startDate = null;
            $this->endDate = null;
        }
    }

    private function getFilteredTransactions()
    {
        $query = Transaction::query();

        if ($this->search) {
            $query->whereHas('student', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('nisn', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->schoolFilter !== 'all') {
            $targetSchool = strtolower(trim($this->schoolFilter));
            $query->whereHas('student.user', function ($q) use ($targetSchool) {
                $q->whereRaw('LOWER(TRIM(school_name)) = ?', [$targetSchool]);
            });
        }

        if ($this->typeFilter !== 'all') {
            $query->where('type', $this->typeFilter);
        }

        if ($this->monthFilter !== 'all') {
            $query->whereMonth('created_at', $this->monthFilter);
        }

        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        return $query->with(['student.user'])->orderBy('created_at', 'desc')->get();
    }

    public function exportCsv()
    {
        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=laporan-transaksi-global-" . date('Y-m-d') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $transactions = $this->getFilteredTransactions();

        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['No', 'Tanggal & Waktu', 'Nama Sekolah', 'Kelas', 'NISN', 'Nama Siswa', 'Jenis Transaksi', 'Nominal (Rp)', 'Catatan', 'Status']);

            foreach ($transactions as $index => $tx) {
                fputcsv($file, [
                    $index + 1,
                    $tx->created_at->format('d M Y H:i'),
                    $tx->student->user->school_name ?? '-',
                    $tx->student->class_name ?? '-',
                    $tx->student->nisn,
                    $tx->student->name,
                    $tx->type === 'deposit' ? 'Setoran' : 'Penarikan',
                    $tx->amount,
                    $tx->notes ?? '-',
                    $tx->status === 'approved' ? 'Disetujui' : ($tx->status === 'pending' ? 'Pending' : 'Ditolak')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function render()
    {
        $transactions = $this->getFilteredTransactions();

        // Calculate active summaries based on current filters
        $totalSetoran = $transactions->where('type', 'deposit')->where('status', 'approved')->sum('amount');
        $setoranCount = $transactions->where('type', 'deposit')->where('status', 'approved')->count();
        
        $totalPenarikan = $transactions->where('type', 'withdrawal')->where('status', 'approved')->sum('amount');
        $penarikanCount = $transactions->where('type', 'withdrawal')->where('status', 'approved')->count();

        $saldoBersih = $totalSetoran - $totalPenarikan;

        // Available Schools list
        $availableSchools = \App\Models\User::whereNotNull('school_name')
            ->where('school_name', '!=', '')
            ->selectRaw('TRIM(school_name) as school_name')
            ->distinct()
            ->orderBy('school_name')
            ->pluck('school_name')
            ->toArray();

        return view('livewire.admin.laporan', [
            'transactions' => $transactions,
            'totalSetoran' => $totalSetoran,
            'setoranCount' => $setoranCount,
            'totalPenarikan' => $totalPenarikan,
            'penarikanCount' => $penarikanCount,
            'saldoBersih' => $saldoBersih,
            'availableSchools' => $availableSchools
        ])->layout('layouts.dashboard', ['title' => 'Laporan Transaksi - SakuSiswa']);
    }
}

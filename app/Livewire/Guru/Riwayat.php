<?php

namespace App\Livewire\Guru;

use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Riwayat extends Component
{
    public ?string $className = null;
    public string $search = '';
    public string $typeFilter = 'all'; // all, deposit, withdrawal
    public string $monthFilter = 'all'; // all, 1-12 representing months
    public ?string $startDate = null;
    public ?string $endDate = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'typeFilter' => ['except' => 'all'],
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
        } elseif ($preset === 'all') {
            $this->startDate = null;
            $this->endDate = null;
        }
    }

    public function mount()
    {
        if (Auth::user()->role !== 'guru') {
            abort(403, 'Akses ditolak.');
        }
        $this->className = Auth::user()->class_name;
    }

    private function getFilteredTransactions()
    {
        $query = Transaction::whereIn('status', ['approved', 'rejected'])
            ->whereHas('student', function ($q) {
                $q->where('class_name', $this->className);
            });

        if ($this->search) {
            $query->whereHas('student', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('nisn', 'like', '%' . $this->search . '%');
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

        return $query->with('student')->orderBy('created_at', 'desc')->get();
    }

    public function exportCsv()
    {
        if (!$this->className) {
            return null;
        }

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=laporan-tabungan-" . $this->className . "-" . date('Y-m-d') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $transactions = $this->getFilteredTransactions();

        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['No', 'Tanggal & Waktu', 'NISN', 'Nama Siswa', 'Jenis Transaksi', 'Nominal (Rp)', 'Catatan', 'Status']);

            foreach ($transactions as $index => $tx) {
                fputcsv($file, [
                    $index + 1,
                    $tx->created_at->format('d M Y H:i'),
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
        if (!$this->className) {
            return view('livewire.guru.riwayat', [
                'transactions' => collect(),
                'totalSetoran' => 0,
                'setoranCount' => 0,
                'totalPenarikan' => 0,
                'penarikanCount' => 0,
                'saldoAktifKelas' => 0
            ])->layout('layouts.dashboard', ['title' => 'Riwayat Transaksi']);
        }

        $studentsQuery = Student::where('class_name', $this->className);
        $studentIds = $studentsQuery->pluck('id');

        // Total Setoran (Approved deposits)
        $depositQuery = Transaction::where('type', 'deposit')
            ->where('status', 'approved')
            ->whereIn('student_id', $studentIds);
        $totalSetoran = $depositQuery->sum('amount');
        $setoranCount = $depositQuery->count();

        // Total Penarikan (Approved withdrawals)
        $withdrawalQuery = Transaction::where('type', 'withdrawal')
            ->where('status', 'approved')
            ->whereIn('student_id', $studentIds);
        $totalPenarikan = $withdrawalQuery->sum('amount');
        $penarikanCount = $withdrawalQuery->count();

        // Saldo Aktif Kelas
        $saldoAktifKelas = $studentsQuery->sum('balance');

        // Get filtered and sorted transactions
        $combined = $this->getFilteredTransactions();

        return view('livewire.guru.riwayat', [
            'transactions' => $combined,
            'totalSetoran' => $totalSetoran,
            'setoranCount' => $setoranCount,
            'totalPenarikan' => $totalPenarikan,
            'penarikanCount' => $penarikanCount,
            'saldoAktifKelas' => $saldoAktifKelas
        ])->layout('layouts.dashboard', ['title' => 'Riwayat Transaksi']);
    }
}

<?php

namespace App\Livewire\Admin;

use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Riwayat extends Component
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


    public function render()
    {
        // Total Setoran (Approved deposits)
        $depositQuery = Transaction::where('type', 'deposit')
            ->where('status', 'approved');
        $totalSetoran = $depositQuery->sum('amount');
        $setoranCount = $depositQuery->count();

        // Total Penarikan (Approved withdrawals)
        $withdrawalQuery = Transaction::where('type', 'withdrawal')
            ->where('status', 'approved');
        $totalPenarikan = $withdrawalQuery->sum('amount');
        $penarikanCount = $withdrawalQuery->count();

        // Saldo Aktif Global
        $saldoAktifGlobal = Student::sum('balance');

        // Get filtered and sorted transactions
        $combined = $this->getFilteredTransactions();

        // Available Schools list
        $availableSchools = \App\Models\User::whereNotNull('school_name')
            ->where('school_name', '!=', '')
            ->selectRaw('TRIM(school_name) as school_name')
            ->distinct()
            ->orderBy('school_name')
            ->pluck('school_name')
            ->toArray();

        return view('livewire.admin.riwayat', [
            'transactions' => $combined,
            'totalSetoran' => $totalSetoran,
            'setoranCount' => $setoranCount,
            'totalPenarikan' => $totalPenarikan,
            'penarikanCount' => $penarikanCount,
            'saldoAktifGlobal' => $saldoAktifGlobal,
            'availableSchools' => $availableSchools
        ])->layout('layouts.dashboard', ['title' => 'Riwayat Transaksi Global']);
    }
}

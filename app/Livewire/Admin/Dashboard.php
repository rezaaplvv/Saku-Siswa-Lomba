<?php

namespace App\Livewire\Admin;

use App\Models\Student;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public float $totalSaving = 0.00;
    public int $totalStudents = 0;
    public int $totalTeachers = 0;
    public int $totalSchools = 0;
    public $recentTransactions;
    
    // Chart Properties
    public string $timeframeDonut = 'this_month';
    public string $timeframeTrend = 'this_month';
    public float $totalDeposit = 0.00;
    public float $totalWithdrawal = 0.00;
    public array $trendLabels = [];
    public array $trendDeposits = [];
    public array $trendWithdrawals = [];

    public function mount()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $this->totalSaving = (float) Student::sum('balance');
        $this->totalStudents = Student::count();
        $this->totalTeachers = User::where('role', 'guru')->count();
        $this->totalSchools = User::where('role', 'guru')
            ->whereNotNull('school_name')
            ->where('school_name', '!=', '')
            ->selectRaw('LOWER(TRIM(school_name)) as normalized_school')
            ->distinct()
            ->get()
            ->count();

        $this->recentTransactions = Transaction::with('student')
            ->latest()
            ->limit(5)
            ->get();

        $this->loadDonutData();
        $this->loadTrendData();
    }

    public function loadDonutData()
    {
        $startDate = now()->startOfMonth();
        $endDate = now();

        if ($this->timeframeDonut === 'last_month') {
            $startDate = now()->subMonth()->startOfMonth();
            $endDate = now()->subMonth()->endOfMonth();
        } elseif ($this->timeframeDonut === 'last_7_days') {
            $startDate = now()->subDays(6)->startOfDay();
            $endDate = now()->endOfDay();
        }

        // Calculate Totals
        $this->totalDeposit = (float) Transaction::where('type', 'deposit')
            ->where('status', 'approved')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');

        $this->totalWithdrawal = (float) Transaction::where('type', 'withdrawal')
            ->where('status', 'approved')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');
    }

    public function loadTrendData()
    {
        $startDate = now()->startOfMonth();
        $endDate = now();

        if ($this->timeframeTrend === 'last_month') {
            $startDate = now()->subMonth()->startOfMonth();
            $endDate = now()->subMonth()->endOfMonth();
        } elseif ($this->timeframeTrend === 'last_7_days') {
            $startDate = now()->subDays(6)->startOfDay();
            $endDate = now()->endOfDay();
        }

        // Generate Daily Trend Data
        $labels = [];
        $deposits = [];
        $withdrawals = [];

        // Single optimized query grouping by date and type
        $transactions = Transaction::selectRaw("DATE(created_at) as tx_date, type, SUM(amount) as total")
            ->where('status', 'approved')
            ->whereBetween('created_at', [$startDate->copy()->startOfDay(), $endDate->copy()->endOfDay()])
            ->groupBy('tx_date', 'type')
            ->get();

        // Build a fast lookup dictionary
        $lookup = [];
        foreach ($transactions as $tx) {
            $lookup[$tx->tx_date][$tx->type] = (float) $tx->total;
        }

        $diffInDays = $startDate->diffInDays($endDate);
        
        for ($i = 0; $i <= $diffInDays; $i++) {
            $date = $startDate->copy()->addDays($i);
            $labels[] = $date->translatedFormat('d M');
            $dateStr = $date->format('Y-m-d');

            $deposits[] = $lookup[$dateStr]['deposit'] ?? 0.0;
            $withdrawals[] = $lookup[$dateStr]['withdrawal'] ?? 0.0;
        }

        $this->trendLabels = $labels;
        $this->trendDeposits = $deposits;
        $this->trendWithdrawals = $withdrawals;
    }

    public function setTimeframeDonut(string $value)
    {
        \Illuminate\Support\Facades\Log::info('setTimeframeDonut called: ' . $value);
        $this->timeframeDonut = $value;
        $this->loadDonutData();
        \Illuminate\Support\Facades\Log::info('donut data calculated: ' . $this->totalDeposit . ' - ' . $this->totalWithdrawal);
        $this->dispatch('donut-chart-updated', [
            'totalDeposit' => $this->totalDeposit,
            'totalWithdrawal' => $this->totalWithdrawal,
        ]);
    }

    public function setTimeframeTrend(string $value)
    {
        \Illuminate\Support\Facades\Log::info('setTimeframeTrend called: ' . $value);
        $this->timeframeTrend = $value;
        $this->loadTrendData();
        \Illuminate\Support\Facades\Log::info('trend data calculated: labels=' . count($this->trendLabels));
        $this->dispatch('trend-chart-updated', [
            'trendLabels' => $this->trendLabels,
            'trendDeposits' => $this->trendDeposits,
            'trendWithdrawals' => $this->trendWithdrawals,
        ]);
    }

    public function render()
    {
        $rawSchools = User::where('role', 'guru')
            ->whereNotNull('school_name')
            ->where('school_name', '!=', '')
            ->get();

        $schoolsBreakdown = $rawSchools->groupBy(function ($u) {
            return strtolower(trim($u->school_name));
        })->map(function ($users) {
            $first = $users->first();
            $displayName = trim($first->school_name);
            $teacherIds = $users->pluck('id');

            $studentQuery = Student::whereIn('user_id', $teacherIds);
            $studentCount = $studentQuery->count();
            $totalBalance = (float) $studentQuery->sum('balance');

            return (object) [
                'school_name' => $displayName,
                'teacher_count' => $users->count(),
                'student_count' => $studentCount,
                'total_balance' => $totalBalance,
            ];
        })->values();

        return view('livewire.admin.dashboard', [
            'schoolsBreakdown' => $schoolsBreakdown
        ])->layout('layouts.dashboard', ['title' => 'Ringkasan Sekolah - SakuSiswa']);
    }
}

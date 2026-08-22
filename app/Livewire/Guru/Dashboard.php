<?php

namespace App\Livewire\Guru;

use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public ?string $className = null;

    public function mount()
    {
        if (Auth::user()->role !== 'guru') {
            abort(403, 'Akses ditolak.');
        }
        $this->className = Auth::user()->class_name;
    }

    public function setujuiPenarikan($transactionId)
    {
        if (!$this->className) {
            session()->flash('error', 'Anda tidak terdaftar sebagai wali kelas.');
            return;
        }

        DB::transaction(function () use ($transactionId) {
            $transaction = Transaction::where('id', $transactionId)
                ->where('type', 'withdrawal')
                ->where('status', 'pending')
                ->whereHas('student', function ($query) {
                    $query->where('class_name', $this->className);
                })
                ->lockForUpdate()
                ->first();

            if ($transaction) {
                $student = Student::where('id', $transaction->student_id)
                    ->lockForUpdate()
                    ->first();

                if ($student) {
                    if ($student->balance >= $transaction->amount) {
                        $transaction->update([
                            'status' => 'approved',
                            'user_id' => Auth::id()
                        ]);

                        $student->decrement('balance', $transaction->amount);
                        session()->flash('success', 'Penarikan oleh ' . $student->name . ' telah disetujui.');
                    } else {
                        session()->flash('error', 'Saldo siswa tidak mencukupi.');
                    }
                }
            } else {
                session()->flash('error', 'Transaksi tidak ditemukan atau sudah diproses.');
            }
        });
    }

    public function tolakPenarikan($transactionId)
    {
        if (!$this->className) {
            session()->flash('error', 'Anda tidak terdaftar sebagai wali kelas.');
            return;
        }

        $transaction = Transaction::where('id', $transactionId)
            ->where('type', 'withdrawal')
            ->where('status', 'pending')
            ->whereHas('student', function ($query) {
                $query->where('class_name', $this->className);
            })
            ->first();

        if ($transaction) {
            $transaction->update([
                'status' => 'rejected',
                'user_id' => Auth::id()
            ]);
            session()->flash('success', 'Pengajuan penarikan telah ditolak.');
        } else {
            session()->flash('error', 'Transaksi tidak ditemukan atau sudah diproses.');
        }
    }

    public function render()
    {
        if (!$this->className) {
            return view('livewire.guru.dashboard', [
                'totalSaldoKelas' => 0,
                'siswaAktif' => 0,
                'setoranHariIni' => 0,
                'penarikanHariIni' => 0,
                'pendingWithdrawals' => collect(),
                'recentActivities' => collect(),
                'chartData' => [],
                'maxChartVal' => 10000
            ])->layout('layouts.dashboard', ['title' => 'Dashboard Guru']);
        }

        // Stats
        $totalSaldoKelas = Student::where('class_name', $this->className)->sum('balance');
        $siswaAktif = Student::where('class_name', $this->className)->count();
        $setoranHariIni = Transaction::where('type', 'deposit')
            ->where('status', 'approved')
            ->whereHas('student', function ($query) {
                $query->where('class_name', $this->className);
            })
            ->whereDate('created_at', today())
            ->sum('amount');

        $penarikanHariIni = Transaction::where('type', 'withdrawal')
            ->where('status', 'approved')
            ->whereHas('student', function ($query) {
                $query->where('class_name', $this->className);
            })
            ->whereDate('created_at', today())
            ->sum('amount');

        // Queue
        $pendingWithdrawals = Transaction::where('type', 'withdrawal')
            ->where('status', 'pending')
            ->whereHas('student', function ($query) {
                $query->where('class_name', $this->className);
            })
            ->with('student')
            ->latest()
            ->get();

        // Recent 5 activities
        $recentActivities = Transaction::where('status', 'approved')
            ->whereHas('student', function ($query) {
                $query->where('class_name', $this->className);
            })
            ->with('student')
            ->latest()
            ->take(5)
            ->get();

        // Calculate 7-day transaction trend data (Option 3 - Charting) - Optimized single query
        $startDate = today()->subDays(6)->startOfDay();
        $endDate = today()->endOfDay();

        $transactions = Transaction::selectRaw("DATE(created_at) as tx_date, type, SUM(amount) as total")
            ->where('status', 'approved')
            ->whereHas('student', function ($query) {
                $query->where('class_name', $this->className);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('tx_date', 'type')
            ->get();

        $lookup = [];
        foreach ($transactions as $tx) {
            $lookup[$tx->tx_date][$tx->type] = (float) $tx->total;
        }

        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = today()->subDays($i);
            $dateString = $date->toDateString();
            $formattedDate = $date->translatedFormat('d M');
            
            $chartData[] = [
                'label' => $formattedDate,
                'deposit' => $lookup[$dateString]['deposit'] ?? 0.0,
                'withdrawal' => $lookup[$dateString]['withdrawal'] ?? 0.0,
            ];
        }

        $maxChartVal = collect($chartData)->map(fn($d) => max($d['deposit'], $d['withdrawal']))->max();
        $maxChartVal = max($maxChartVal, 10000); // Prevent division by zero
        // Round up to nearest clean interval of 10.000 for perfect scale intervals
        $maxChartVal = ceil($maxChartVal / 10000) * 10000;

        return view('livewire.guru.dashboard', [
            'totalSaldoKelas' => $totalSaldoKelas,
            'siswaAktif' => $siswaAktif,
            'setoranHariIni' => $setoranHariIni,
            'penarikanHariIni' => $penarikanHariIni,
            'pendingWithdrawals' => $pendingWithdrawals,
            'recentActivities' => $recentActivities,
            'chartData' => $chartData,
            'maxChartVal' => $maxChartVal
        ])->layout('layouts.dashboard', ['title' => 'Dashboard Guru']);
    }
}

<?php

namespace App\Livewire\Parent;

use App\Models\Student;
use App\Models\Transaction;
use Livewire\Component;
use Carbon\Carbon;

class Riwayat extends Component
{
    use \Livewire\WithPagination;

    public $search = '';
    public $filter_type = 'all';
    public $filter_time = 'all';

    // Detail Modal State
    public $selected_transaction_id = null;
    public $show_detail_modal = false;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterType(): void
    {
        $this->resetPage();
    }

    public function updatingFilterTime(): void
    {
        $this->resetPage();
    }

    /**
     * Show detail modal for a specific transaction.
     */
    public function selectTransaction(int $txId): void
    {
        $studentId = session('student_id');
        
        // Ensure the transaction belongs to the logged-in student
        $tx = Transaction::where('id', $txId)
            ->where('student_id', $studentId)
            ->first();

        if ($tx) {
            $this->selected_transaction_id = $tx->id;
            $this->show_detail_modal = true;
        }
    }

    /**
     * Close the transaction detail modal.
     */
    public function closeDetailModal(): void
    {
        $this->selected_transaction_id = null;
        $this->show_detail_modal = false;
    }

    /**
     * Render the component view.
     */
    public function render()
    {
        $studentId = session('student_id');
        $student = Student::findOrFail($studentId);

        // Build transaction query with verifier user eager loaded
        $query = Transaction::where('student_id', $studentId)
            ->with('user')
            ->latest();

        // Filter: Type
        if ($this->filter_type !== 'all') {
            $query->where('type', $this->filter_type);
        }

        // Filter: Time Range
        if ($this->filter_time === 'month') {
            $query->where('created_at', '>=', Carbon::now()->startOfMonth());
        } elseif ($this->filter_time === '3months') {
            $query->where('created_at', '>=', Carbon::now()->subMonths(3));
        }

        // Filter: Search Note/Description
        if (!empty(trim($this->search))) {
            $query->where('notes', 'like', '%' . trim($this->search) . '%');
        }

        // Paginate by 5 transactions
        $transactions = $query->paginate(5);
        $totalTransactionsCount = $transactions->total();

        // Group transactions by month for structured display (e.g., "Juli 2026")
        $groupedTransactions = collect($transactions->items())->groupBy(function ($tx) {
            return $tx->created_at->translatedFormat('F Y');
        });

        // Load transaction model details if selected
        $selectedTx = null;
        if ($this->selected_transaction_id) {
            $selectedTx = Transaction::with('user')->find($this->selected_transaction_id);
        }

        return view('livewire.parent.riwayat', [
            'student' => $student,
            'groupedTransactions' => $groupedTransactions,
            'selectedTx' => $selectedTx,
            'transactions' => $transactions,
            'totalTransactionsCount' => $totalTransactionsCount,
        ])->layout('layouts.dashboard', ['title' => 'Riwayat Transaksi - SakuSiswa']);
    }
}

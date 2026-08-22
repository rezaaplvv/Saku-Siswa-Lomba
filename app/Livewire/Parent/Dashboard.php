<?php

namespace App\Livewire\Parent;

use App\Models\Student;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Dashboard extends Component
{
    public $nominal_penarikan = '';
    public $alasan_penarikan = '';

    // Target properties
    public $new_target = '';
    public $is_editing_target = false;

    // PIN properties
    public $parent_pin_input = '';
    public $new_pin = '';
    public $new_pin_confirmation = '';
    public $is_pin_set = false;

    /**
     * Start the editing mode for saving target.
     */
    public function startEditTarget(): void
    {
        $studentId = session('student_id');
        $student = Student::findOrFail($studentId);

        $this->new_target = (int) $student->saving_target;
        $this->is_editing_target = true;
    }

    /**
     * Save the new saving target to the database.
     */
    public function saveTarget(): void
    {
        $studentId = session('student_id');
        $student = Student::findOrFail($studentId);

        $this->validate([
            'new_target' => 'required|numeric|min:1000',
        ], [
            'new_target.required' => 'Target tabungan wajib diisi.',
            'new_target.numeric' => 'Target harus berupa angka.',
            'new_target.min' => 'Target minimal Rp 1.000.',
        ]);

        $student->saving_target = $this->new_target;
        $student->save();

        $this->is_editing_target = false;

        session()->flash('message', 'Target tabungan berhasil diperbarui.');
    }

    /**
     * Create a new 6-digit transaction PIN for the parent account.
     */
    public function buatPinTransaksi(): void
    {
        $studentId = session('student_id');
        $student = Student::findOrFail($studentId);

        $this->validate([
            'new_pin' => 'required|digits:6|confirmed',
        ], [
            'new_pin.required' => 'PIN baru wajib diisi.',
            'new_pin.digits' => 'PIN harus tepat 6 digit angka.',
            'new_pin.confirmed' => 'Konfirmasi PIN tidak cocok.',
        ]);

        $student->parent_pin = Hash::make($this->new_pin);
        $student->save();

        $this->reset(['new_pin', 'new_pin_confirmation']);
        $this->is_pin_set = true;

        session()->flash('message', 'PIN transaksi berhasil dibuat.');
    }

    /**
     * Submit a new withdrawal request (status initially set to 'pending').
     */
    public function ajukanPenarikan(): void
    {
        $studentId = session('student_id');
        $student = Student::findOrFail($studentId);

        $this->validate([
            'nominal_penarikan' => 'required|numeric|min:1000|max:' . $student->balance,
            'alasan_penarikan' => 'required|string|max:255',
            'parent_pin_input' => 'required|digits:6',
        ], [
            'nominal_penarikan.required' => 'Nominal penarikan wajib diisi.',
            'nominal_penarikan.numeric' => 'Nominal harus berupa angka.',
            'nominal_penarikan.min' => 'Nominal penarikan minimal Rp 1.000.',
            'nominal_penarikan.max' => 'Nominal penarikan tidak boleh melebihi saldo aktif Anda.',
            'alasan_penarikan.required' => 'Alasan penarikan wajib diisi.',
            'alasan_penarikan.max' => 'Alasan penarikan maksimal 255 karakter.',
            'parent_pin_input.required' => 'PIN otorisasi wajib diisi.',
            'parent_pin_input.digits' => 'PIN otorisasi harus tepat 6 digit angka.',
        ]);

        // Verify the 6-digit transaction PIN matches the hashed value
        if (!Hash::check($this->parent_pin_input, $student->parent_pin)) {
            $this->addError('parent_pin_input', 'PIN otorisasi salah. Silakan coba lagi.');
            return;
        }

        Transaction::create([
            'student_id' => $student->id,
            'user_id' => null, // Submitted by parent
            'type' => 'withdrawal',
            'amount' => $this->nominal_penarikan,
            'status' => 'pending',
            'notes' => $this->alasan_penarikan,
        ]);

        $this->reset(['nominal_penarikan', 'alasan_penarikan', 'parent_pin_input']);
        
        $this->dispatch('close-modal');
        
        session()->flash('message', 'Pengajuan penarikan berhasil dikirim.');
    }

    /**
     * Render the parent dashboard view with updated data.
     */
    public function render()
    {
        $studentId = session('student_id');
        $student = Student::findOrFail($studentId);

        // Fetch the 3 most recent transactions dynamically to keep list up-to-date
        $transactions = Transaction::where('student_id', $studentId)
            ->latest()
            ->limit(3)
            ->get();

        // Calculate cumulative statistics (Approved only)
        $totalDeposits = Transaction::where('student_id', $studentId)
            ->where('type', 'deposit')
            ->where('status', 'approved')
            ->sum('amount');

        $totalWithdrawals = Transaction::where('student_id', $studentId)
            ->where('type', 'withdrawal')
            ->where('status', 'approved')
            ->sum('amount');

        // Check for active pending withdrawal requests
        $pendingWithdrawal = Transaction::where('student_id', $studentId)
            ->where('type', 'withdrawal')
            ->where('status', 'pending')
            ->latest()
            ->first();

        // Determine if parent has already set a PIN
        $this->is_pin_set = !empty($student->parent_pin);

        return view('livewire.parent.dashboard', [
            'student' => $student,
            'transactions' => $transactions,
            'total_deposits' => $totalDeposits,
            'total_withdrawals' => $totalWithdrawals,
            'pending_withdrawal' => $pendingWithdrawal,
        ])->layout('layouts.dashboard', ['title' => 'Dasbor Orang Tua - SakuSiswa']);
    }
}

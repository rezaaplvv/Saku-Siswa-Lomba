<?php

namespace App\Livewire\Parent;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ForceChangePassword extends Component
{
    public string $old_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    protected array $rules = [
        'old_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ];

    protected array $messages = [
        'old_password.required' => 'Kata sandi lama wajib diisi.',
        'new_password.required' => 'Kata sandi baru wajib diisi.',
        'new_password.min' => 'Kata sandi baru minimal terdiri dari 6 karakter.',
        'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
    ];

    public function updatePassword()
    {
        $this->validate();

        $student = Student::find(session('student_id'));

        if (!$student) {
            session()->flash('error', 'Siswa tidak ditemukan.');
            return;
        }

        // Verify old password
        if (!Hash::check($this->old_password, $student->parent_password)) {
            $this->addError('old_password', 'Kata sandi lama yang Anda masukkan salah.');
            return;
        }

        // Save new password and toggle change flag
        $student->update([
            'parent_password' => Hash::make($this->new_password),
            'must_change_password' => false,
        ]);

        // Update active session hash to prevent immediate invalidation on next request
        session(['parent_password_hash' => $student->parent_password]);

        session()->flash('success', 'Kata sandi Anda berhasil diperbarui. Selamat datang kembali!');
        return redirect()->route('parent.dashboard');
    }

    public function render()
    {
        return view('livewire.parent.force-change-password')
            ->layout('layouts.app', ['title' => 'Wajib Perbarui Kata Sandi']);
    }
}

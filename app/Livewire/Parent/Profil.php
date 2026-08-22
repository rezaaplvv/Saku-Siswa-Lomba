<?php

namespace App\Livewire\Parent;

use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Profil extends Component
{
    // Form fields - Password
    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    // Form fields - PIN
    public string $login_password = '';
    public string $new_pin = '';
    public string $new_pin_confirmation = '';

    public bool $is_pin_set = false;

    // Form fields - Avatar Edit Modal
    public bool $isAvatarModalOpen = false;
    public string $avatar = 'i1.png';

    public function mount()
    {
        $studentId = session('student_id');
        $student = Student::findOrFail($studentId);
        $this->is_pin_set = !empty($student->parent_pin);
        $this->avatar = $student->avatar ?? 'i1.png';
    }

    public function openAvatarModal()
    {
        $studentId = session('student_id');
        $student = Student::findOrFail($studentId);
        $this->avatar = $student->avatar ?? 'i1.png';
        $this->isAvatarModalOpen = true;
    }

    public function selectAvatar(string $avatarName)
    {
        $allowed = ['i1.png', 'i2.png', 'i3.png', 'i4.png', 'i5.png', 'i6.png', 'i7.png', 'i8.png'];
        if (in_array($avatarName, $allowed)) {
            $this->avatar = $avatarName;
        }
    }

    public function closeAvatarModal()
    {
        $this->isAvatarModalOpen = false;
    }

    public function saveAvatar()
    {
        $studentId = session('student_id');
        $student = Student::findOrFail($studentId);

        $allowed = ['i1.png', 'i2.png', 'i3.png', 'i4.png', 'i5.png', 'i6.png', 'i7.png', 'i8.png'];
        $selectedAvatar = in_array($this->avatar, $allowed) ? $this->avatar : 'i1.png';

        $student->avatar = $selectedAvatar;
        $student->save();

        $this->isAvatarModalOpen = false;

        session()->flash('success', 'Foto avatar profil berhasil diperbarui.');
    }

    public function changePassword()
    {
        $studentId = session('student_id');
        $student = Student::findOrFail($studentId);

        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal terdiri dari 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if (!Hash::check($this->current_password, $student->parent_password)) {
            $this->addError('current_password', 'Password saat ini salah.');
            return;
        }

        $student->parent_password = Hash::make($this->new_password);
        $student->must_change_password = false;
        $student->save();

        session(['parent_password_hash' => $student->parent_password]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->dispatch('close-modal');

        session()->flash('success', 'Password login berhasil diperbarui.');
    }

    public function changePin()
    {
        $studentId = session('student_id');
        $student = Student::findOrFail($studentId);

        $this->validate([
            'login_password' => 'required',
            'new_pin' => 'required|digits:6|confirmed',
        ], [
            'login_password.required' => 'Password login wajib diisi.',
            'new_pin.required' => 'PIN baru wajib diisi.',
            'new_pin.digits' => 'PIN harus tepat 6 digit angka.',
            'new_pin.confirmed' => 'Konfirmasi PIN tidak cocok.',
        ]);

        if (!Hash::check($this->login_password, $student->parent_password)) {
            $this->addError('login_password', 'Password login salah.');
            return;
        }

        $student->parent_pin = Hash::make($this->new_pin);
        $student->save();

        $this->is_pin_set = true;
        $this->reset(['login_password', 'new_pin', 'new_pin_confirmation']);
        $this->dispatch('close-modal');

        session()->flash('success', 'PIN transaksi berhasil diperbarui.');
    }

    public function render()
    {
        $studentId = session('student_id');
        $student = Student::findOrFail($studentId);

        return view('livewire.parent.profil', [
            'student' => $student,
        ])->layout('layouts.dashboard', ['title' => 'Profil - SakuSiswa']);
    }
}

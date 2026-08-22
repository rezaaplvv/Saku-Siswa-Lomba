<?php

namespace App\Livewire\Guru;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profil extends Component
{
    public ?string $className = null;

    // Profile Edit Modal properties
    public bool $isProfileModalOpen = false;
    public string $name = '';
    public string $nip = '';
    public string $school_name = '';
    public string $edit_class_name = '';
    public string $avatar = 'i1.png';

    // Form fields for changing password
    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    public function mount()
    {
        if (Auth::user()->role !== 'guru') {
            abort(403, 'Akses ditolak.');
        }
        $this->className = Auth::user()->class_name;
    }

    public function openProfileModal()
    {
        $user = Auth::user();
        $this->name = $user->name ?? '';
        $this->nip = $user->nip ?? '';
        $this->school_name = $user->school_name ?? '';
        $this->edit_class_name = $user->class_name ?? '';
        $this->avatar = $user->avatar ?? 'i1.png';
        $this->isProfileModalOpen = true;
    }

    public function selectAvatar(string $avatarName)
    {
        $allowed = ['i1.png', 'i2.png', 'i3.png', 'i4.png', 'i5.png', 'i6.png', 'i7.png', 'i8.png'];
        if (in_array($avatarName, $allowed)) {
            $this->avatar = $avatarName;
        }
    }

    public function closeProfileModal()
    {
        $this->isProfileModalOpen = false;
        $this->resetValidation();
    }

    public function saveProfile()
    {
        $user = Auth::user();
        $dbUser = User::findOrFail($user->id);

        $this->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:18',
            'school_name' => 'required|string|max:255',
            'edit_class_name' => 'required|string|max:100',
            'avatar' => 'nullable|string',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'nip.max' => 'NIP maksimal 18 digit.',
            'school_name.required' => 'Nama sekolah wajib diisi.',
            'edit_class_name.required' => 'Nama kelas wajib diisi.',
        ]);

        $dbUser->name = $this->name;
        $dbUser->nip = $this->nip ? $this->nip : null;
        $dbUser->school_name = $this->school_name;
        $dbUser->class_name = $this->edit_class_name;
        $dbUser->avatar = $this->avatar ?? 'i1.png';
        $dbUser->save();

        Auth::setUser($dbUser);

        $this->className = $dbUser->class_name;
        $this->isProfileModalOpen = false;

        session()->flash('success', 'Profil guru dan foto avatar berhasil diperbarui.');

        return $this->redirect(route('guru.profil'), navigate: true);
    }

    public function changePassword()
    {
        $user = Auth::user();
        $dbUser = User::findOrFail($user->id);

        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal terdiri dari 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if (!Hash::check($this->current_password, $dbUser->password)) {
            $this->addError('current_password', 'Password saat ini salah.');
            return;
        }

        $dbUser->password = Hash::make($this->new_password);
        $dbUser->save();

        Auth::setUser($dbUser);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->dispatch('close-modal');

        session()->flash('success', 'Password login berhasil diperbarui.');
    }

    public function render()
    {
        $user = User::find(Auth::id()) ?? Auth::user();
        $siswaCount = Student::where('user_id', Auth::id())
            ->when($this->className, function ($q) {
                $q->orWhere('class_name', $this->className);
            })
            ->count();


        return view('livewire.guru.profil', [
            'user' => $user,
            'siswaCount' => $siswaCount,
        ])->layout('layouts.dashboard', ['title' => 'Profil - SakuSiswa']);
    }
}

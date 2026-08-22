<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';
    public string $school_name = '';
    public string $class_name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'school_name' => 'required|string|max:255',
            'class_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|regex:/[A-Z]/|regex:/[0-9]/|confirmed',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'school_name.required' => 'Nama sekolah wajib diisi.',
            'class_name.required' => 'Nama kelas wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar. Silakan masuk.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.regex' => 'Kata sandi harus mengandung minimal 1 huruf kapital (A-Z) dan 1 angka (0-9).',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ];
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => trim($this->name),
            'school_name' => trim($this->school_name),
            'class_name' => trim($this->class_name),
            'email' => strtolower(trim($this->email)),
            'password' => Hash::make($this->password),
            'role' => 'guru',
        ]);

        session()->flash('success', 'Registrasi akun Guru ' . $user->name . ' berhasil! Silakan masuk menggunakan email dan kata sandi Anda.');

        return redirect()->route('login');
    }


    public function render()
    {
        $existingSchools = User::whereNotNull('school_name')
            ->where('school_name', '!=', '')
            ->distinct()
            ->pluck('school_name');

        return view('livewire.auth.register', [
            'existingSchools' => $existingSchools
        ])->layout('layouts.app', ['title' => 'Daftar Akun Guru Baru - SakuSiswa']);
    }
}

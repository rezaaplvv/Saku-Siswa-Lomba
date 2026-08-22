<?php

namespace App\Livewire\Auth;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    // Form fields
    public $username_or_email = '';
    public $password = '';
    public $remember = true; // Always remember logins by default

    // Validation rules
    protected $rules = [
        'username_or_email' => 'required',
        'password' => 'required|min:6',
    ];

    protected $messages = [
        'username_or_email.required' => 'Email atau NISN wajib diisi.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal terdiri dari 6 karakter.',
    ];

    public function mount()
    {
        // 1. Auto-login Admin & Guru if already authenticated via guard
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->to('/admin/dashboard');
            } elseif (Auth::user()->role === 'guru') {
                return redirect()->to('/guru/dashboard');
            }
        }

        // 2. Auto-login Parent if remember cookie exists
        if (\Illuminate\Support\Facades\Cookie::has('parent_remember_id')) {
            try {
                $studentId = decrypt(\Illuminate\Support\Facades\Cookie::get('parent_remember_id'));
                $student = Student::find($studentId);
                if ($student) {
                    session([
                        'parent_logged_in' => true,
                        'student_id' => $student->id,
                        'parent_student_id' => $student->id,
                        'parent_password_hash' => $student->parent_password
                    ]);
                    return redirect()->to('/parent/dashboard');
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forget('parent_remember_id'));
            }
        }
    }

    public function login()
    {
        $this->validate();

        // 1. Check if input is Email (Admin or Guru)
        if (filter_var($this->username_or_email, FILTER_VALIDATE_EMAIL)) {
            if (Auth::attempt(['email' => $this->username_or_email, 'password' => $this->password], $this->remember)) {
                session()->forget(['parent_logged_in', 'student_id', 'parent_student_id']);
                session()->regenerate();

                $user = Auth::user();
                if ($user->role === 'admin') {
                    return redirect()->intended('/admin/dashboard');
                } elseif ($user->role === 'guru') {
                    return redirect()->intended('/guru/dashboard');
                }

                return redirect()->intended('/admin/dashboard');
            }

            $this->addError('username_or_email', 'Email atau password yang Anda masukkan salah.');
            return;
        }

        // 2. Otherwise check NISN (Wali Murid / Siswa)
        $student = Student::where('nisn', $this->username_or_email)->first();

        if ($student && Hash::check($this->password, $student->parent_password)) {
            Auth::logout();
            session()->regenerate();
            session([
                'parent_logged_in' => true,
                'student_id' => $student->id,
                'parent_student_id' => $student->id,
                'parent_password_hash' => $student->parent_password
            ]);

            if ($this->remember) {
                \Illuminate\Support\Facades\Cookie::queue(
                    \Illuminate\Support\Facades\Cookie::make('parent_remember_id', encrypt($student->id), 43200)
                );
            }

            return redirect()->intended('/parent/dashboard');
        }

        $this->addError('username_or_email', 'Email / NISN atau password yang Anda masukkan salah.');
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.app', ['title' => 'Login - SakuSiswa']);
    }
}


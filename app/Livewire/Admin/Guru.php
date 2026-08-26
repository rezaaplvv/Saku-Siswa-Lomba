<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Guru extends Component
{
    public $teacherId = null;
    public string $name = '';
    public string $email = '';
    public ?string $nip = null;
    public string $password = '';
    public ?string $class_name = null;

    public bool $isFormOpen = false;
    public string $search = '';

    public function mount()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
    }

    public function openForm($id = null)
    {
        $this->resetErrorBag();
        $this->teacherId = $id;

        if ($id) {
            $teacher = User::findOrFail($id);
            $this->name = $teacher->name;
            $this->email = $teacher->email;
            $this->nip = $teacher->nip ?? null;
            $this->class_name = $teacher->class_name ?? null;
            $this->password = '';
        } else {
            $this->name = '';
            $this->email = '';
            $this->nip = null;
            $this->class_name = null;
            $this->password = '';
        }

        $this->isFormOpen = true;
    }

    public function closeForm()
    {
        $this->isFormOpen = false;
        $this->reset(['teacherId', 'name', 'email', 'nip', 'password', 'class_name']);
        $this->resetErrorBag();
    }

    public function saveTeacher()
    {
        if ($this->nip === '') {
            $this->nip = null;
        }
        if ($this->class_name === '') {
            $this->class_name = null;
        }

        $rules = [
            'name' => 'required|min:3',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->teacherId),
            ],
            'nip' => [
                'nullable',
                'numeric',
                Rule::unique('users', 'nip')->ignore($this->teacherId),
            ],
            'class_name' => 'nullable',
        ];

        if (!$this->teacherId) {
            $rules['password'] = 'required|min:6';
        } else {
            $rules['password'] = 'nullable|min:6';
        }

        $this->validate($rules, [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal terdiri dari 3 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
        ]);

        // Custom validation for class_name assignment to prevent dual assignment
        if ($this->class_name) {
            $existing = User::where('role', 'guru')
                ->where('class_name', $this->class_name)
                ->when($this->teacherId, function($q) {
                    $q->where('id', '!=', $this->teacherId);
                })
                ->first();

            if ($existing) {
                $this->addError('class_name', 'Kelas ' . $this->class_name . ' sudah diampu oleh wali kelas ' . $existing->name . '.');
                return;
            }
        }

        if ($this->teacherId) {
            // Update
            $teacher = User::findOrFail($this->teacherId);
            $updateData = [
                'name' => $this->name,
                'email' => $this->email,
                'nip' => $this->nip ?: null,
                'class_name' => $this->class_name ?: null,
            ];

            if (!empty($this->password)) {
                $updateData['password'] = Hash::make($this->password);
            }

            $teacher->update($updateData);
            session()->flash('success', 'Data guru ' . $this->name . ' berhasil diperbarui.');
        } else {
            // Create
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'nip' => $this->nip ?: null,
                'password' => Hash::make($this->password),
                'role' => 'guru',
                'class_name' => $this->class_name ?: null,
            ]);
            session()->flash('success', 'Guru baru ' . $this->name . ' berhasil ditambahkan.');
        }

        $this->closeForm();
    }

    public bool $isClassroomModalOpen = false;
    public string $newClassroomName = '';

    public function openClassroomModal()
    {
        $this->newClassroomName = '';
        $this->isClassroomModalOpen = true;
        $this->resetErrorBag();
    }

    public function closeClassroomModal()
    {
        $this->isClassroomModalOpen = false;
    }

    public function addClassroom()
    {
        $this->validate([
            'newClassroomName' => 'required|min:2|max:10|unique:classrooms,name'
        ], [
            'newClassroomName.required' => 'Nama kelas wajib diisi.',
            'newClassroomName.min' => 'Minimal 2 karakter.',
            'newClassroomName.max' => 'Maksimal 10 karakter.',
            'newClassroomName.unique' => 'Kelas sudah terdaftar.'
        ]);

        \App\Models\Classroom::create([
            'name' => strtoupper(trim($this->newClassroomName))
        ]);

        $this->newClassroomName = '';
        session()->flash('class_success', 'Kelas baru berhasil ditambahkan.');
    }

    public function deleteClassroom($id)
    {
        $classroom = \App\Models\Classroom::findOrFail($id);
        
        $hasStudents = \App\Models\Student::where('class_name', $classroom->name)->exists();
        $hasTeachers = \App\Models\User::where('class_name', $classroom->name)->exists();

        if ($hasStudents || $hasTeachers) {
            session()->flash('class_error', 'Kelas tidak bisa dihapus karena sedang digunakan.');
            return;
        }

        $classroom->delete();
        session()->flash('class_success', 'Kelas berhasil dihapus.');
    }

    public function resetPassword($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->update([
            'password' => Hash::make('123456')
        ]);
        session()->flash('success', 'Password guru ' . $teacher->name . ' berhasil di-reset menjadi "123456".');
    }

    public function deleteTeacher($id)
    {
        $teacher = User::findOrFail($id);
        $name = $teacher->name;
        
        // Prevent deleting admin
        if ($teacher->role === 'admin') {
            session()->flash('error', 'Administrator utama tidak dapat dihapus.');
            return;
        }

        $teacher->delete();
        session()->flash('success', 'Data guru ' . $name . ' berhasil dihapus.');
    }

    public function render()
    {
        $teachers = User::where('role', 'guru')
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('school_name', 'like', '%' . $this->search . '%')
                      ->orWhere('class_name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('name', 'asc')
            ->get()
            ->map(function ($teacher) {
                $studentQuery = \App\Models\Student::where('user_id', $teacher->id);
                $teacher->student_count = $studentQuery->count();
                $teacher->total_balance = (float) \App\Models\Student::where('user_id', $teacher->id)->sum('balance');
                return $teacher;
            });

        return view('livewire.admin.guru', [
            'teachers' => $teachers,
            'classrooms' => \App\Models\Classroom::orderBy('name')->get(),
            'availableClasses' => \App\Models\Classroom::orderBy('name')->pluck('name')->toArray()
        ])->layout('layouts.dashboard', ['title' => 'Kelola Guru - SakuSiswa']);
    }
}

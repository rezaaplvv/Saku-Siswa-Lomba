<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Parent\Dashboard as ParentDashboard;
use App\Livewire\Parent\Riwayat as ParentRiwayat;
use App\Livewire\Parent\Profil as ParentProfil;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::get('/privacy-policy', function () {
    return view('privacy');
})->name('privacy');

Route::post('/logout', function () {
    if (session('parent_logged_in') === true) {
        session()->flush();
        \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forget('parent_remember_id'));
    } else {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
    return redirect()->route('login');
})->name('logout');

Route::middleware('parent')->group(function () {
    Route::get('/parent/dashboard', ParentDashboard::class)->name('parent.dashboard');
    Route::get('/parent/riwayat', ParentRiwayat::class)->name('parent.riwayat');
    Route::get('/parent/profil', ParentProfil::class)->name('parent.profil');
    Route::get('/parent/perbarui-password', \App\Livewire\Parent\ForceChangePassword::class)->name('parent.force-change-password');
});

Route::middleware('staff')->group(function () {
    Route::get('/guru/dashboard', \App\Livewire\Guru\Dashboard::class)->name('guru.dashboard');
    Route::get('/guru/siswa', \App\Livewire\Guru\Siswa::class)->name('guru.siswa');
    Route::get('/guru/riwayat', \App\Livewire\Guru\Riwayat::class)->name('guru.riwayat');
    Route::get('/guru/profil', \App\Livewire\Guru\Profil::class)->name('guru.profil');

    // Print & PDF Export Routes for Teacher
    Route::get('/guru/cetak-slip', function () {
        $user = Auth::user();
        $students = \App\Models\Student::where(function ($q) use ($user) {
            $q->where('user_id', $user->id);
            if ($user->class_name) {
                $q->orWhere('class_name', $user->class_name);
            }
        })->orderBy('name', 'asc')->get();
        return view('print.slip-login-guru', compact('students'));
    })->name('guru.cetak-slip');

    Route::get('/guru/cetak-rekap-laporan', function () {
        $user = Auth::user();
        $students = \App\Models\Student::where(function ($q) use ($user) {
            $q->where('user_id', $user->id);
            if ($user->class_name) {
                $q->orWhere('class_name', $user->class_name);
            }
        })->orderBy('name', 'asc')->get();
        return view('print.rekap-tabungan-guru', compact('students'));
    })->name('guru.cetak-rekap-laporan');


    // Admin Routes
    Route::get('/admin/dashboard', \App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/guru', \App\Livewire\Admin\Guru::class)->name('admin.guru');
    Route::get('/admin/siswa', \App\Livewire\Admin\Siswa::class)->name('admin.siswa');
    Route::get('/admin/riwayat', \App\Livewire\Admin\Riwayat::class)->name('admin.riwayat');
    Route::get('/admin/laporan', \App\Livewire\Admin\Laporan::class)->name('admin.laporan');
});

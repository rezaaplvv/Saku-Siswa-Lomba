<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Utama Platform SakuSiswa
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@sekolahtabungan.com')],
            [
                'name' => 'Administrator Utama',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'siswasakuadmin1984')),
                'role' => 'admin',
            ]
        );
    }
}

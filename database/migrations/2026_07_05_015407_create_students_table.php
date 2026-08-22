<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique();
            $table->string('name');
            $table->string('class_name'); // Contoh: '1-A', '2-B'
            $table->decimal('balance', 12, 2)->default(0.00); // Saldo menggunakan decimal agar presisi keuangan aman
            
            // Akun akses untuk Orang Tua memantau dari rumah
            $table->string('parent_username')->unique();
            $table->string('parent_password');
            
            // Target tabungan yang bisa disesuaikan oleh orang tua
            $table->decimal('saving_target', 12, 2)->default(500000.00);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
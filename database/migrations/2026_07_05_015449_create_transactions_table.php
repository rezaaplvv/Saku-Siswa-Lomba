<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // Menghubungkan transaksi ke data siswa
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            
            // Menghubungkan transaksi ke guru/admin yang memproses input data
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            
            $table->enum('type', ['deposit', 'withdrawal']); // deposit = setor, withdrawal = tarik
            $table->decimal('amount', 12, 2);
            
            // Sistem persetujuan untuk penarikan saldo oleh admin
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('approved');
            
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
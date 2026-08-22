<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nip')->nullable()->unique()->after('email');
        });

        // Fill existing teachers with realistic random 18-digit NIP values
        try {
            $gurus = \App\Models\User::where('role', 'guru')->get();
            foreach ($gurus as $guru) {
                $birthYear = rand(1975, 1995);
                $birthMonth = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
                $birthDay = str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);
                $appointYear = rand(2010, 2024);
                $appointMonth = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
                $gender = rand(1, 2);
                $seq = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
                
                $nip = $birthYear . $birthMonth . $birthDay . $appointYear . $appointMonth . $gender . $seq;
                $guru->update(['nip' => $nip]);
            }
        } catch (\Exception $e) {
            // Ignore error
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nip');
        });
    }
};

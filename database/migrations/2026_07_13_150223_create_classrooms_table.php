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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Seed default classes 1-A to 6-C
        $classes = [
            '1-A', '1-B', '1-C',
            '2-A', '2-B', '2-C',
            '3-A', '3-B', '3-C',
            '4-A', '4-B', '4-C',
            '5-A', '5-B', '5-C',
            '6-A', '6-B', '6-C',
        ];

        foreach ($classes as $class) {
            \Illuminate\Support\Facades\DB::table('classrooms')->insert([
                'name' => $class,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};

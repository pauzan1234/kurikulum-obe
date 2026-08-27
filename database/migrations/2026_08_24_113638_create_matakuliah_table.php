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
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk', 15)->unique();
            $table->string('nama_mk', 255);
            $table->unsignedTinyInteger('sks');
            $table->foreignId('semester_id')
                ->constrained('semester')
                ->cascadeOnDelete();
            // Ganti ->nullable() dengan ->constrained('program_studis') kalau tabel prodi sudah ada
            //$table->foreignId('id_prodi')->nullable();
            $table->foreignId('id_prodi')->constrained('prodi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};

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
        Schema::create('bahan_kajians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bk', 10)->unique();
            $table->string('nama_bahan_kajian', 255);
            $table->text('deskripsi')->nullable();
            $table->string('referensi', 255);
            $table->string('body_of_knowledge_acuan', 255)->nullable();
            $table->enum('tingkat_kedalaman', ['C1', 'C2', 'C3', 'C4', 'C5', 'C6'])
                ->nullable();
            // Ganti ->nullable() dengan ->constrained('program_studis') kalau tabel prodi sudah ada
            $table->foreignId('id_prodi')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_kajians');
    }
};

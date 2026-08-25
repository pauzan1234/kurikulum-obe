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
        Schema::create('cpl_bahan_kajian', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_cpl')
                ->constrained('cpl', 'id_cpl') //karena nama pkey di tabel cpl adalah id_cpl
                //kalau nama pkeynya id maka ditulis:
                //->constrained('cpl')
                ->cascadeOnDelete();

            $table->foreignId('id_bahan_kajian')
                ->constrained('bahan_kajians')
                ->cascadeOnDelete();

            $table->enum('bobot_kontribusi', ['Tinggi', 'Sedang', 'Rendah'])
                ->nullable();
            $table->text('catatan')->nullable();

            $table->timestamps();

            // Cegah duplikasi pasangan CPL - Bahan Kajian yang sama
            $table->unique(['id_cpl', 'id_bahan_kajian'], 'cpl_bk_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpl_bahan_kajian');
    }
};

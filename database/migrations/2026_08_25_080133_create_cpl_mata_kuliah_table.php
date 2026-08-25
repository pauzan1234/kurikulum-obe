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
        Schema::create('cpl_mata_kuliah', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_cpl')
                ->constrained('cpl', 'id_cpl')
                ->cascadeOnDelete();

            $table->foreignId('id_mk')
                ->constrained('mata_kuliah')
                ->cascadeOnDelete();

            $table->enum('bobot_kontribusi', [
                'Tinggi',
                'Sedang',
                'Rendah'
            ])->nullable();

            $table->text('catatan')->nullable();

            $table->timestamps();

            $table->unique(['id_cpl', 'id_mk'], 'cpl_mk_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpl_mata_kuliah');
    }
};

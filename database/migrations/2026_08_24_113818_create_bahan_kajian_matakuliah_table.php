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
        Schema::create('bahan_kajian_mata_kuliah', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_bahan_kajian')
                ->constrained('bahan_kajians')
                ->cascadeOnDelete();

            $table->foreignId('id_mk')
                ->constrained('mata_kuliah')
                ->cascadeOnDelete();

            $table->decimal('persentase_bobot', 5, 2)->nullable();

            $table->timestamps();

            // Cegah duplikasi pasangan Bahan Kajian - Mata Kuliah yang sama
            $table->unique(['id_bahan_kajian', 'id_mk'], 'bk_mk_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_kajian_mata_kuliah');
    }
};

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
        Schema::create('cpmk_mata_kuliah', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_cpmk')
                ->constrained('cpmk')
                ->cascadeOnDelete();

            $table->foreignId('id_mk')
                ->constrained('mata_kuliah')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['id_cpmk', 'id_mk'], 'cpmk_mk_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpmk_mata_kuliah');
    }
};

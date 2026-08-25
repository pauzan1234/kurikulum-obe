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
        Schema::create('cpmk', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_cpl')
                ->constrained('cpl', 'id_cpl')
                ->cascadeOnDelete();

            $table->string('kode_cpmk', 20);
            $table->text('deskripsi_cpmk');

            $table->timestamps();

            $table->unique(['id_cpl', 'kode_cpmk']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpmk');
    }
};

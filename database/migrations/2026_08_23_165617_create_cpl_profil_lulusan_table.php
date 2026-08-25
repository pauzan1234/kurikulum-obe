<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cpl_profil_lulusan', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_cpl');
            $table->unsignedBigInteger('id_pl');

            $table->timestamps();

            $table->foreign('id_cpl')
                ->references('id_cpl')
                ->on('cpl')
                ->onDelete('cascade');

            $table->foreign('id_pl')
                ->references('id_pl')
                ->on('profil_lulusan')
                ->onDelete('cascade');

            // Cegah kombinasi CPL + PL yang sama tersimpan dua kali
            $table->unique(['id_cpl', 'id_pl']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cpl_profil_lulusan');
    }
};

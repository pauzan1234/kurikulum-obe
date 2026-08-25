<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cpl', function (Blueprint $table) {
            $table->id('id_cpl');

            $table->string('kode_cpl', 20);

            $table->text('deskripsi_cpl');

            $table->enum('cpl_dasar', [
                'Sikap',
                'Pengetahuan',
                'Keterampilan Umum',
                'Keterampilan Khusus',
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cpl');
    }
};

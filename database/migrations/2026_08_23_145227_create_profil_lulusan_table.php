<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_lulusan', function (Blueprint $table) {
            $table->id('id_pl');
            $table->string('kode', 20)->unique();
            $table->text('isi_pl');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_lulusan');
    }
};

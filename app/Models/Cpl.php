<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cpl extends Model
{
    protected $table = 'cpl';

    protected $primaryKey = 'id_cpl';

    protected $fillable = [
        'kode_cpl',
        'deskripsi_cpl',
        'cpl_dasar',
    ];

    public function profilLulusan(): BelongsToMany
    {
        return $this->belongsToMany(
            ProfilLulusan::class,
            'cpl_profil_lulusan',
            'id_cpl',
            'id_pl'
        );
    }
    public function bahanKajians()
    {
        return $this->belongsToMany(
            Bahankajian::class,
            'cpl_bahan_kajian',   // nama tabel pivot
            'id_cpl',             // foreign key pivot yang mengarah ke tabel cpl
            'id_bahan_kajian'     // foreign key pivot yang mengarah ke tabel bahan_kajian
        )
            ->withPivot('bobot_kontribusi', 'catatan')
            ->withTimestamps();
    }
}

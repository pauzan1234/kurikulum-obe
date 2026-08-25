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
}

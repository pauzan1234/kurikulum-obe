<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProfilLulusan extends Model
{
    protected $table = 'profil_lulusan';

    protected $primaryKey = 'id_pl';

    protected $fillable = [
        'kode',
        'isi_pl',
        'keterangan',
    ];

    public function cpl(): BelongsToMany
    {
        return $this->belongsToMany(
            Cpl::class,
            'cpl_profil_lulusan',
            'id_pl',
            'id_cpl'
        );
    }
}

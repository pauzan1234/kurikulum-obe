<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliahs';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'id_prodi',
    ];

    /**
     * Relasi many-to-many ke Bahan Kajian melalui tabel pivot bahan_kajian_mata_kuliah.
     */
    public function bahanKajians(): BelongsToMany
    {
        return $this->belongsToMany(BahanKajian::class, 'bahan_kajian_mata_kuliah', 'id_mk', 'id_bahan_kajian')
            ->withPivot(['persentase_bobot'])
            ->withTimestamps();
    }
}

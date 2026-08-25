<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\MataKuliah;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BahanKajian extends Model
{
    use HasFactory;

    protected $table = 'bahan_kajians';

    protected $fillable = [
        'kode_bk',
        'nama_bahan_kajian',
        'deskripsi',
        'referensi',
        'body_of_knowledge_acuan',
        'tingkat_kedalaman',
        'id_prodi',
        'status',
    ];

    protected $casts = [
        'tingkat_kedalaman' => 'string',
        'status' => 'string',
    ];

    /**
     * Relasi many-to-many ke CPL melalui tabel pivot cpl_bahan_kajian.
     */
    public function cpls(): BelongsToMany
    {
        return $this->belongsToMany(
            Cpl::class, //ke model bernama Cpl
            'cpl_bahan_kajian', //ini adalah nama tabel pivotnya penghubung antara BahanKajian dengan Cpl
            'id_bahan_kajian', //nama di tabel cpl_bahan_kajian, korelasi dengan tabel bahan_kajians, id_bahan_kajian
            'id_cpl' //cpl_bahan_kajian punya fk namanya id_cpl = id_cpl di tabel cpl yg merupakan pkey
        )
            ->withPivot(['bobot_kontribusi', 'catatan'])
            ->withTimestamps();
    }

    /**
     * Relasi many-to-many ke Mata Kuliah melalui tabel pivot bahan_kajian_mata_kuliah.
     */
    public function mataKuliahs(): BelongsToMany
    {
        return $this->belongsToMany(MataKuliah::class, 'bahan_kajian_mata_kuliah', 'id_bahan_kajian', 'id_mk')
            ->withPivot(['persentase_bobot'])
            ->withTimestamps();
    }
}

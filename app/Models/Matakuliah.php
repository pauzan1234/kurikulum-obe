<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester_id', // ganti dari 'semester'
        'id_prodi',
    ];

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

    public function bahanKajians(): BelongsToMany
    {
        return $this->belongsToMany(BahanKajian::class, 'bahan_kajian_mata_kuliah', 'id_mk', 'id_bahan_kajian')
            ->withPivot(['persentase_bobot'])
            ->withTimestamps();
    }
}

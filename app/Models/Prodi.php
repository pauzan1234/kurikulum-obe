<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';

    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'jenjang',
    ];

    /**
     * Relasi one-to-many ke Mata Kuliah.
     */
    public function mataKuliahs(): HasMany
    {
        return $this->hasMany(MataKuliah::class, 'id_prodi');
    }
}

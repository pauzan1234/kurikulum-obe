<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'semester';

    protected $fillable = [
        'nama_semester',
    ];

    /**
     * Relasi one-to-many ke Mata Kuliah.
     */
    public function mataKuliahs(): HasMany
    {
        return $this->hasMany(MataKuliah::class, 'semester_id');
    }
}

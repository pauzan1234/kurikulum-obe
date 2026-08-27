<?php

// app/Models/Cpmk.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cpmk extends Model
{
    protected $table = 'cpmk';
    protected $primaryKey = 'id';
    protected $fillable = ['id_cpl', 'kode_cpmk', 'deskripsi_cpmk'];

    public function cpl()
    {
        return $this->belongsTo(Cpl::class, 'id_cpl', 'id_cpl');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prodi::create([
            'kode_prodi'  => 'TK',
            'nama_prodi'  => 'Teknik Komputer',
            'jenjang'     => 'S1',
        ]);
    }
}

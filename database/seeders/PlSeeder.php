<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profil_lulusan')->insert([
            [
                'kode' => 'PL01',
                'isi_pl' => 'Lulusan memilik kemampuan untuk melakukan perencanaan, implementasi dan pemeliharaan yang meliputi perangkat keras maupun perangkat lunak pada sistem komputasi modern yang melibatkan perangkat cerdas berbasis embedded systems',
                'keterangan' => 'Wajib (Keterampilan Umum)',
            ],
            [
                'kode' => 'PL02',
                'isi_pl' => 'Lulusan menguasai konsep matematika, sains dasar dan implementasinya yang dibutuhkan oleh lulusan yang kompeten di bidang rekayasa yang berhubungan dengan sistem komputer',
                'keterangan' => 'Wajib (Penguasaan Pengetahuan)',
            ],
            [
                'kode' => 'PL03',
                'isi_pl' => 'Lulusan memiliki kemampuan melakukan penelitian dan pengembangan yang meliputi perangkat keras dan perangkat lunak yang berhubungan dengan sistem komputer secara mandiri maupun berkelompok',
                'keterangan' => 'Ketrampilan Khusus',
            ],
            [
                'kode' => 'PL04',
                'isi_pl' => 'Lulusan Teknik Komputer memiliki etika profesionalitas dan bertanggung jawab',
                'keterangan' => 'Komunikasi dan kerja sama',
            ],

        ]);
    }
}

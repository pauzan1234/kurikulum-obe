<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semesters = [
            ['nomor_semester' => 1, 'nama_semester' => 'Semester 1', 'keterangan' => 'Ganjil'],
            ['nomor_semester' => 2, 'nama_semester' => 'Semester 2', 'keterangan' => 'Genap'],
            ['nomor_semester' => 3, 'nama_semester' => 'Semester 3', 'keterangan' => 'Ganjil'],
            ['nomor_semester' => 4, 'nama_semester' => 'Semester 4', 'keterangan' => 'Genap'],
            ['nomor_semester' => 5, 'nama_semester' => 'Semester 5', 'keterangan' => 'Ganjil'],
            ['nomor_semester' => 6, 'nama_semester' => 'Semester 6', 'keterangan' => 'Genap'],
            ['nomor_semester' => 7, 'nama_semester' => 'Semester 7', 'keterangan' => 'Ganjil'],
            ['nomor_semester' => 8, 'nama_semester' => 'Semester 8', 'keterangan' => 'Genap'],
        ];

        foreach ($semesters as $semester) {
            Semester::create($semester);
        }
    }
}

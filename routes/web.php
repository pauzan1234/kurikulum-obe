<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilLulusanController;
use App\Http\Controllers\CplController;
use App\Http\Controllers\BahanKajianController;

use App\Http\Controllers\CplBahanKajianController;
use App\Http\Controllers\MataKuliahController;

// routes/web.php
use App\Http\Controllers\CpmkController;
// Tambahkan potongan ini ke routes/web.php


Route::get('/profil-lulusan', function () {
    return view('profil-lulusan');
})->name('profil-lulusan');

Route::get('/cpl', function () {
    return view('cpl');
})->name('cpl');
Route::get('/cpl', [CplController::class, 'index'])->name('cpl');
Route::post('/cpl', [CplController::class, 'store'])->name('cpl.store');
Route::delete('/cpl/{cpl}', [CplController::class, 'destroy'])->name('cpl.destroy');
Route::get('/bahan-kajian', function () {
    return view('bahan-kajian');
})->name('bahan-kajian');


Route::post('/profil-lulusan', [ProfilLulusanController::class, 'store'])->name('profil-lulusan.store');
Route::delete('/profil-lulusan/{profil_lulusan}', [ProfilLulusanController::class, 'destroy'])->name('profil-lulusan.destroy');


Route::get('/profil-lulusan', [ProfilLulusanController::class, 'index'])->name('profil-lulusan');

Route::resource('bahan-kajian', BahanKajianController::class)
    ->except(['show']); // 'show' biasanya nggak dipakai untuk model kecil begini

Route::get('/', function () {
    return view('profil-lulusan');
});



Route::resource('bahan-kajian', BahanKajianController::class)
    ->except(['create', 'show', 'edit']);



Route::get('/cpl-bahan-kajian', [CplBahanKajianController::class, 'index'])
    ->name('cpl-bahan-kajian.index');

// routes/web.php
Route::post('/cpl-bahan-kajian', [CplBahanKajianController::class, 'store'])
    ->name('cpl-bahan-kajian.store');

// routes/web.php
Route::delete('/cpl-bahan-kajian/{cpl}/{bahanKajian}', [CplBahanKajianController::class, 'destroy'])
    ->name('cpl-bahan-kajian.destroy');

Route::get('/matakuliah', [MataKuliahController::class, 'index'])
    ->name('matakuliah.index');
Route::get('/tambah_matakuliah', [MataKuliahController::class, 'create'])
    ->name('matakuliah.create');

Route::post('/matakuliah/simpan', [MataKuliahController::class, 'store'])->name('matakuliah.store');
Route::get('/matakuliah/{matakuliah}/edit', [MataKuliahController::class, 'edit'])->name('matakuliah.edit');
Route::put('/matakuliah/{matakuliah}', [MataKuliahController::class, 'update'])->name('matakuliah.update');
Route::delete('/matakuliah/{matakuliah}', [MataKuliahController::class, 'destroy'])->name('matakuliah.destroy');
Route::get('/mata-kuliah/per-semester', [MataKuliahController::class, 'perSemester'])
    ->name('matakuliah.persemester');


Route::get('/cpl-cpmk', [CpmkController::class, 'index'])->name('cpmk.index');
Route::post('/cpl-cpmk', [CpmkController::class, 'store'])->name('cpmk.store');
Route::delete('/cpl-cpmk/{cpmk}', [CpmkController::class, 'destroy'])->name('cpmk.destroy');

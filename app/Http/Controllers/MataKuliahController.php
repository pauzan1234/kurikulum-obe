<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Prodi;
use App\Models\Semester;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = MataKuliah::orderBy('id', 'asc')->get();

        return view('matakuliah', compact('mataKuliah'));
    }

    public function create()
    {
        $prodis = Prodi::orderBy('nama_prodi')->get();
        $semesters = Semester::orderBy('id')->get();
        return view('matakuliah.create', compact('prodis', 'semesters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mk'     => 'required|string|max:15|unique:mata_kuliah,kode_mk',
            'nama_mk'     => 'required|string|max:255',
            'sks'         => 'required|integer|min:1|max:6',
            'semester_id' => 'required|exists:semester,id', // ganti dari 'semester'
            'id_prodi'    => 'required|exists:prodi,id',
        ]);

        MataKuliah::create($validated);

        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $matakuliah)
    {
        $prodis = Prodi::orderBy('nama_prodi')->get();
        return view('matakuliah.edit', ['mataKuliah' => $matakuliah, 'prodis' => $prodis]);
    }

    public function update(Request $request, MataKuliah $matakuliah)
    {
        $validated = $request->validate([
            'kode_mk'     => 'required|string|max:15|unique:mata_kuliah,kode_mk,' . $matakuliah->id,
            'nama_mk'     => 'required|string|max:255',
            'sks'         => 'required|integer|min:1|max:6',
            'semester_id' => 'required|exists:semester,id',
            'id_prodi'    => 'required|exists:prodi,id',
        ]);

        $matakuliah->update($validated);

        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}

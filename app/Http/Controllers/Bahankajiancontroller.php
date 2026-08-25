<?php

namespace App\Http\Controllers;

use App\Models\BahanKajian;
use Illuminate\Http\Request;

class BahanKajianController extends Controller
{

    public function index()
    {
        $bahanKajian = BahanKajian::orderBy('id', 'asc')->get();

        return view('bahan-kajian', compact('bahanKajian'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_bk' => 'required|string|max:20|unique:bahan_kajians,kode_bk',
            'nama_bahan_kajian' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'referensi' => 'nullable|string',
            'body_of_knowledge_acuan' => 'nullable|string|max:255',
        ]);

        BahanKajian::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Bahan Kajian berhasil ditambahkan.');
    }

    public function update(Request $request, BahanKajian $bahanKajian)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:bahan_kajians,kode,' . $bahanKajian->id,
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|text',
            'referensi' => 'nullable|string',
            'knowledge_area' => 'nullable|string|max:255',
        ]);

        $bahanKajian->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Bahan Kajian berhasil diperbarui.');
    }

    public function destroy(BahanKajian $bahanKajian)
    {
        $bahanKajian->delete();

        return redirect()
            ->back()
            ->with('success', 'Bahan Kajian berhasil dihapus.');
    }
}

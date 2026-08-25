<?php

namespace App\Http\Controllers;

use App\Models\ProfilLulusan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfilLulusanController extends Controller
{
    public function index(): View
    {
        $profilLulusan = ProfilLulusan::orderBy('id_pl', 'asc')->get();

        return view('profil-lulusan', compact('profilLulusan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode'       => ['required', 'string', 'max:20', 'unique:profil_lulusan,kode'],
            'isi_pl'     => ['required', 'string'],
            'keterangan' => ['nullable', 'string'],
        ], [
            'kode.required'   => 'Kode wajib diisi.',
            'kode.unique'     => 'Kode sudah dipakai, gunakan kode lain.',
            'isi_pl.required' => 'Isi profil lulusan wajib diisi.',
        ]);

        ProfilLulusan::create($validated);

        return redirect()
            ->route('profil-lulusan')
            ->with('success', 'Profil lulusan berhasil ditambahkan.');
    }

    public function destroy(ProfilLulusan $profilLulusan): RedirectResponse
    {
        $profilLulusan->delete();

        return redirect()
            ->route('profil-lulusan')
            ->with('success', 'Profil lulusan berhasil dihapus.');
    }
}

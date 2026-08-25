<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\ProfilLulusan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CplController extends Controller
{
    public function index(): View
    {
        $cpl = Cpl::with('profilLulusan')->orderBy('id_cpl', 'asc')->get();
        $profilLulusanList = ProfilLulusan::orderBy('kode', 'asc')->get();

        return view('cpl', compact('cpl', 'profilLulusanList'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_pl'         => ['required', 'array', 'min:1'],
            'id_pl.*'       => ['integer', 'exists:profil_lulusan,id_pl'],
            'kode_cpl'      => ['required', 'string', 'max:20', 'unique:cpl,kode_cpl'],
            'deskripsi_cpl' => ['required', 'string'],
            'cpl_dasar'     => ['required', 'in:Sikap,Pengetahuan,Keterampilan Umum,Keterampilan Khusus'],
        ], [
            'id_pl.required'         => 'Pilih minimal satu profil lulusan.',
            'id_pl.*.exists'         => 'Salah satu profil lulusan yang dipilih tidak ditemukan.',
            'kode_cpl.required'      => 'Kode CPL wajib diisi.',
            'kode_cpl.unique'        => 'Kode CPL sudah dipakai, gunakan kode lain.',
            'deskripsi_cpl.required' => 'Deskripsi CPL wajib diisi.',
            'cpl_dasar.required'     => 'Kategori CPL wajib dipilih.',
            'cpl_dasar.in'           => 'Kategori CPL yang dipilih tidak valid.',
        ]);

        $cpl = Cpl::create([
            'kode_cpl'      => $validated['kode_cpl'],
            'deskripsi_cpl' => $validated['deskripsi_cpl'],
            'cpl_dasar'     => $validated['cpl_dasar'],
        ]);

        // Simpan relasi many-to-many ke profil_lulusan
        $cpl->profilLulusan()->sync($validated['id_pl']);

        return redirect()
            ->route('cpl')
            ->with('success', 'CPL berhasil ditambahkan.');
    }

    public function destroy(Cpl $cpl): RedirectResponse
    {
        $cpl->delete();

        return redirect()
            ->route('cpl')
            ->with('success', 'CPL berhasil dihapus.');
    }
}

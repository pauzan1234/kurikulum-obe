<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\BahanKajian;
use Illuminate\Http\Request;

class CplBahanKajianController extends Controller
{
    public function index()
    {
        $cpls = Cpl::orderBy('kode_cpl')->get();
        $bahanKajians = BahanKajian::orderBy('kode_bk')->get();

        $korelasi = [];
        foreach ($cpls as $cpl) {
            foreach ($cpl->bahanKajians as $bk) {
                $korelasi[$cpl->id_cpl][$bk->id] = $bk->pivot->bobot_kontribusi;
            }
        }

        return view('cpl-bahan-kajian', compact('cpls', 'bahanKajians', 'korelasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_cpl'              => 'required|exists:cpl,id_cpl',
            'bahan_kajian'        => 'required|array|min:1',
            'bahan_kajian.*'      => 'exists:bahan_kajians,id',
            'bobot'               => 'array',
            'bobot.*'             => 'nullable|in:Tinggi,Sedang,Rendah',
        ], [
            'bahan_kajian.required' => 'Pilih minimal satu Bahan Kajian.',
        ]);

        $cpl = Cpl::findOrFail($validated['id_cpl']);

        $syncData = [];
        foreach ($validated['bahan_kajian'] as $bkId) {
            $syncData[$bkId] = [
                'bobot_kontribusi' => $request->input("bobot.$bkId", 'Sedang'),
            ];
        }

        // syncWithoutDetaching supaya relasi CPL lain yang sudah ada tidak ikut kehapus
        $cpl->bahanKajians()->syncWithoutDetaching($syncData);

        return redirect()
            ->route('cpl-bahan-kajian.index')
            ->with('success', 'Relasi CPL - Bahan Kajian berhasil disimpan.');
    }

    public function destroy(Cpl $cpl, BahanKajian $bahanKajian)
    {
        $cpl->bahanKajians()->detach($bahanKajian->id);

        return redirect()
            ->route('cpl-bahan-kajian.index')
            ->with('success', 'Relasi CPL - Bahan Kajian berhasil dihapus.');
    }
}

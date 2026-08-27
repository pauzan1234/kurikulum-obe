<?php

// app/Http/Controllers/CpmkController.php
namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Cpmk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CpmkController extends Controller
{
    public function index()
    {
        $cplList = Cpl::with('cpmks')->orderBy('kode_cpl')->get();
        $cplOptions = Cpl::orderBy('kode_cpl')->get();

        return view('cpmk.index', compact('cplList', 'cplOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_cpl' => 'required|exists:cpl,id_cpl',
            'cpmk' => 'required|array|min:1',
            'cpmk.*.kode_cpmk' => [
                'required',
                'string',
                'max:20',
                Rule::unique('cpmk', 'kode_cpmk')->where(fn($query) => $query->where('id_cpl', $request->id_cpl)),
            ],
            'cpmk.*.deskripsi_cpmk' => 'required|string',
        ], [
            'cpmk.*.kode_cpmk.unique' => 'Kode CPMK ini sudah ada untuk CPL yang dipilih.',
        ], [
            'cpmk.*.kode_cpmk' => 'kode CPMK',
            'cpmk.*.deskripsi_cpmk' => 'deskripsi CPMK',
        ]);

        // Cegah duplikat kode CPMK di dalam satu kali submit (misal user isi CPMK11 dua kali)
        $kodeList = collect($validated['cpmk'])->pluck('kode_cpmk')->map(fn($k) => strtoupper(trim($k)));
        if ($kodeList->count() !== $kodeList->unique()->count()) {
            return back()
                ->withErrors(['cpmk' => 'Terdapat kode CPMK yang sama pada form ini, pastikan setiap kode CPMK unik.'])
                ->withInput();
        }

        foreach ($validated['cpmk'] as $row) {
            Cpmk::create([
                'id_cpl' => $validated['id_cpl'],
                'kode_cpmk' => $row['kode_cpmk'],
                'deskripsi_cpmk' => $row['deskripsi_cpmk'],
            ]);
        }

        return redirect()->route('cpmk.index')->with('success', 'CPMK berhasil ditambahkan.');
    }

    public function destroy(Cpmk $cpmk)
    {
        $cpmk->delete();

        return redirect()->route('cpmk.index')->with('success', 'CPMK berhasil dihapus.');
    }
}

@extends('layouts.app')

@section('title', 'CPL - Bahan Kajian')
@section('page-title', 'CPL - Bahan Kajian')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>
            <p class="text-sm text-slate-500">
                Kurikulum &rarr; Bahan Kajian
            </p>

            <h2 class="mt-1 font-serif text-2xl font-semibold text-navy-900">
                Daftar Bahan Kajian
            </h2>
        </div>
        {{-- a href ke CPL-Bahan Kajian --}}

        {{-- TOMBOL TAMBAH --}}
        <button
            type="button"
            onclick="openTambahModal()"
            class="inline-flex items-center gap-2 rounded-lg
           bg-navy-800 px-4 py-2.5 text-sm font-medium
           text-white hover:bg-navy-700">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" class="h-4 w-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 4.5v15m7.5-7.5h-15" />
            </svg>

            Tambah Relasi CPL - BK
        </button>





    </div>


    {{-- TABLE --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">


        <div class="p-6">
            <h1 class="text-lg font-semibold text-navy-800 mb-4">
                Korelasi CPL - Bahan Kajian
            </h1>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                {{-- KETERANGAN --}}
                <div class="mb-3 flex flex-wrap items-center gap-4 text-xs text-gray-600">
                    <span class="font-medium text-gray-700">Keterangan:</span>

                    <span class="inline-flex items-center gap-1.5">
                        <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-green-600 text-white text-[10px] font-semibold">T</span>
                        Tinggi
                    </span>

                    <span class="inline-flex items-center gap-1.5">
                        <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-yellow-500 text-white text-[10px] font-semibold">S</span>
                        Sedang
                    </span>

                    <span class="inline-flex items-center gap-1.5">
                        <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-white text-[10px] font-semibold">R</span>
                        Rendah
                    </span>
                </div>
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 font-medium text-gray-600 sticky left-0 bg-gray-50">
                                CPL
                            </th>
                            @foreach ($bahanKajians as $bk)
                            <th class="px-4 py-3 font-medium text-gray-600 text-center whitespace-nowrap">
                                {{ $bk->kode_bk }}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($cpls as $cpl)
                        <tr>
                            <td class="px-4 py-3 font-medium text-navy-800 sticky left-0 bg-white">
                                {{ $cpl->kode_cpl }}
                            </td>
                            @foreach ($bahanKajians as $bk)
                            @php $bobot = $korelasi[$cpl->id_cpl][$bk->id] ?? null; @endphp
                            <td class="px-4 py-3 text-center">
                                @if ($bobot)
                                <div class="flex items-center justify-center gap-1">
                                    @if ($bobot === 'Tinggi')
                                    <span class="inline-flex h-6 w-6 items-center justify-center
                 rounded-full bg-green-600 text-white text-xs font-semibold"
                                        title="Tinggi">
                                        T
                                    </span>
                                    @elseif ($bobot === 'Sedang')
                                    <span class="inline-flex h-6 w-6 items-center justify-center
                 rounded-full bg-yellow-500 text-white text-xs font-semibold"
                                        title="Sedang">
                                        S
                                    </span>
                                    @elseif ($bobot === 'Rendah')
                                    <span class="inline-flex h-6 w-6 items-center justify-center
                 rounded-full bg-red-500 text-white text-xs font-semibold"
                                        title="Rendah">
                                        R
                                    </span>
                                    @endif

                                    <form method="POST"
                                        action="{{ route('cpl-bahan-kajian.destroy', [$cpl->id_cpl, $bk->id]) }}"
                                        onsubmit="return confirm('Hapus relasi {{ $cpl->kode_cpl }} - {{ $bk->kode_bk }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex h-5 w-5 items-center justify-center rounded-full
                       text-gray-400 hover:bg-red-100 hover:text-red-600"
                                            title="Hapus relasi">
                                            &times;
                                        </button>
                                    </form>
                                </div>
                                @else
                                <span class="text-gray-300">-</span>
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>

</div>


{{-- ========================================================= --}}
{{-- MODAL --}}
{{-- ========================================================= --}}
{{-- MODAL --}}
<div id="tambahModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">
    <div class="w-full max-w-2xl rounded-xl bg-white p-6 shadow-xl">

        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-base font-semibold text-navy-800">
                Tambah Relasi CPL - Bahan Kajian
            </h2>
            <button type="button" onclick="closeTambahModal()"
                class="text-gray-400 hover:text-gray-600">
                &times;
            </button>
        </div>

        <form method="POST" action="{{ route('cpl-bahan-kajian.store') }}">
            @csrf

            {{-- Pilih CPL --}}
            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">
                    Pilih CPL
                </label>
                <select name="id_cpl" required
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-navy-800 focus:ring-navy-800">
                    <option value="">-- Pilih CPL --</option>
                    @foreach ($cpls as $cpl)
                    <option value="{{ $cpl->id_cpl }}">
                        {{ $cpl->id_cpl }} - {{ \Illuminate\Support\Str::limit($cpl->deskripsi_cpl, 80) }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Checklist Bahan Kajian --}}
            <div class="mb-4">
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Pilih Bahan Kajian
                </label>

                <div class="max-h-64 space-y-2 overflow-y-auto rounded-lg border border-gray-200 p-3">
                    @foreach ($bahanKajians as $bk)
                    <div class="flex items-center justify-between gap-3 rounded-md px-2 py-1.5 hover:bg-gray-50">
                        <label class="flex flex-1 items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox"
                                name="bahan_kajian[]"
                                value="{{ $bk->id }}"
                                class="rounded border-gray-300 text-navy-800 focus:ring-navy-800">
                            {{ $bk->kode_bk }} - {{ $bk->nama_bahan_kajian }} - {{ \Illuminate\Support\Str::limit($bk->deskripsi, 250) }}
                        </label>

                        <select name="bobot[{{ $bk->id }}]"
                            class="rounded-md border-gray-300 text-xs focus:border-navy-800 focus:ring-navy-800">
                            <option value="Rendah">Rendah</option>
                            <option value="Sedang" selected>Sedang</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeTambahModal()"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit"
                    class="rounded-lg bg-navy-800 px-4 py-2 text-sm font-medium text-white hover:bg-navy-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>


{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}
<script>
    function openTambahModal() {
        document.getElementById('tambahModal').classList.remove('hidden');
        document.getElementById('tambahModal').classList.add('flex');
    }

    function closeTambahModal() {
        document.getElementById('tambahModal').classList.add('hidden');
        document.getElementById('tambahModal').classList.remove('flex');
    }
</script>
@endsection
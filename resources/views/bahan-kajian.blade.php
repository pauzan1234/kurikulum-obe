@extends('layouts.app')

@section('title', 'Bahan Kajian')
@section('page-title', 'Bahan Kajian')

@section('content')

<div class="mx-auto max-w-5xl space-y-6">

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

        {{-- TOMBOL TAMBAH --}}
        <button
            type="button"
            onclick="openTambahModal()"
            class="inline-flex items-center gap-2 rounded-lg
                   bg-navy-800 px-4 py-2.5 text-sm font-medium
                   text-white hover:bg-navy-700">

            <svg xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                class="h-4 w-4">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 4.5v15m7.5-7.5h-15" />

            </svg>

            Tambah Bahan Kajian

        </button>

    </div>


    {{-- TABLE --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full divide-y divide-slate-200 text-sm">

            <thead class="bg-slate-50">

                <tr>

                    <th class="px-5 py-3 text-left font-semibold text-slate-600">
                        Kode BK
                    </th>

                    <th class="px-5 py-3 text-left font-semibold text-slate-600">
                        Bahan Kajian
                    </th>

                    <th class="px-5 py-3 text-left font-semibold text-slate-600">
                        Deskripsi
                    </th>

                    <th class="px-5 py-3 text-left font-semibold text-slate-600">
                        Knowledge Area
                    </th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-600">
                        Referensi
                    </th>

                    <th class="px-5 py-3 text-right font-semibold text-slate-600">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-slate-100">

                @forelse ($bahanKajian ?? [] as $item)

                <tr class="hover:bg-slate-50">

                    <td class="px-5 py-3 font-medium text-navy-700">
                        {{ $item->kode_bk }}
                    </td>

                    <td class="px-5 py-3">
                        {{ $item->nama_bahan_kajian }}
                    </td>
                    <td class="px-5 py-3">
                        {{ $item->deskripsi ?? '-' }}
                    </td>
                    <td class="px-5 py-3">
                        {{ $item->body_of_knowledge_acuan ?? '-' }}
                    </td>

                    <td class="px-5 py-3">
                        {{ $item->referensi ?? '-' }}
                    </td>

                    <td class="px-5 py-3 text-right">

                        {{-- EDIT --}}
                        <button
                            type="button"
                            onclick='openEditModal(@json($item))'
                            class="text-navy-600 hover:underline">

                            Ubah

                        </button>

                        <span class="mx-1 text-slate-300">
                            |
                        </span>

                        {{-- DELETE --}}
                        <form
                            action="{{ route('bahan-kajian.destroy', $item->id) }}"
                            method="POST"
                            class="inline"
                            onsubmit="return confirm('Yakin ingin menghapus bahan kajian ini?')">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="text-red-600 hover:underline">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td
                        colspan="5"
                        class="px-5 py-10 text-center text-slate-400">

                        Belum ada data bahan kajian.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- ========================================================= --}}
{{-- MODAL --}}
{{-- ========================================================= --}}

<div
    id="bahanKajianModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">

    <div
        class="w-full max-w-lg rounded-xl bg-white shadow-xl">

        {{-- HEADER MODAL --}}
        <div class="flex items-center justify-between border-b px-6 py-4">

            <h3
                id="modalTitle"
                class="text-lg font-semibold text-slate-800">

                Tambah Bahan Kajian

            </h3>

            <button
                type="button"
                onclick="closeModal()"
                class="text-2xl text-slate-400 hover:text-slate-600">

                &times;

            </button>

        </div>


        {{-- FORM --}}
        <form
            id="bahanKajianForm"
            method="POST"
            action="{{ route('bahan-kajian.store') }}">

            @csrf

            <div id="methodField"></div>


            <div class="space-y-4 px-6 py-5">

                {{-- KODE --}}
                <div>

                    <label
                        class="mb-1 block text-sm font-medium text-slate-700">

                        Kode Bahan Kajian

                    </label>

                    <input
                        type="text"
                        name="kode_bk"
                        id="kode_bk"
                        required
                        placeholder="Contoh: BK01"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2">

                </div>


                {{-- NAMA --}}
                <div>

                    <label
                        class="mb-1 block text-sm font-medium text-slate-700">

                        Bahan Kajian

                    </label>

                    <input
                        type="text"
                        name="nama_bahan_kajian"
                        id="nama_bahan_kajian"
                        required
                        placeholder="Nama bahan kajian"
                        class="w-full rounded-lg border border-slate-300
                               px-3 py-2 text-sm
                               focus:border-navy-500 focus:ring-navy-500">

                </div>

                {{-- Deskripsi --}}
                <div>

                    <label
                        class="mb-1 block text-sm font-medium text-slate-700">

                        Deskripsi

                    </label>


                    <textarea
                        name="deskripsi"
                        id="deskripsi"
                        rows="3"
                        placeholder="Deskripsi bahan kajian"
                        class="w-full rounded-lg border border-slate-300
                               px-3 py-2 text-sm
                               focus:border-navy-500 focus:ring-navy-500"></textarea>

                </div>
                {{-- REFERENSI --}}
                <div>

                    <label
                        class="mb-1 block text-sm font-medium text-slate-700">

                        Referensi

                    </label>

                    <textarea
                        name="referensi"
                        id="referensi"
                        rows="3"
                        placeholder="Referensi bahan kajian"
                        class="w-full rounded-lg border border-slate-300
                               px-3 py-2 text-sm
                               focus:border-navy-500 focus:ring-navy-500"></textarea>

                </div>


                {{-- KNOWLEDGE AREA --}}
                <div>

                    <label
                        class="mb-1 block text-sm font-medium text-slate-700">

                        Knowledge Area

                    </label>

                    <input
                        type="text"
                        name="body_of_knowledge_acuan"
                        id="body_of_knowledge_acuan"
                        placeholder="Contoh: Software Engineering"
                        class="w-full rounded-lg border border-slate-300
                               px-3 py-2 text-sm
                               focus:border-navy-500 focus:ring-navy-500">

                </div>

            </div>


            {{-- FOOTER --}}
            <div
                class="flex justify-end gap-3 border-t bg-slate-50
                       px-6 py-4 rounded-b-xl">

                <button
                    type="button"
                    onclick="closeModal()"
                    class="rounded-lg border border-slate-300
                           px-4 py-2 text-sm font-medium
                           text-slate-700 hover:bg-slate-100">

                    Batal

                </button>

                <button
                    type="submit"
                    id="submitButton"
                    class="rounded-lg bg-navy-800 px-4 py-2
                           text-sm font-medium text-white
                           hover:bg-navy-700">

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
        const modal = document.getElementById('bahanKajianModal');

        const form = document.getElementById('bahanKajianForm');

        document.getElementById('modalTitle').innerText =
            'Tambah Bahan Kajian';

        document.getElementById('submitButton').innerText =
            'Simpan';

        form.action =
            "{{ route('bahan-kajian.store') }}";

        document.getElementById('methodField').innerHTML = '';

        document.getElementById('kode_bk').value = '';
        document.getElementById('nama_bahan_kajian').value = '';
        document.getElementById('deskripsi').value = '';
        document.getElementById('referensi').value = '';
        document.getElementById('body_of_knowledge_acuan').value = '';

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }


    function openEditModal(item) {
        const modal = document.getElementById('bahanKajianModal');

        const form = document.getElementById('bahanKajianForm');

        document.getElementById('modalTitle').innerText =
            'Edit Bahan Kajian';

        document.getElementById('submitButton').innerText =
            'Update';

        form.action =
            `/bahan-kajian/${item.id}`;

        document.getElementById('methodField').innerHTML =
            '@method("PUT")';

        document.getElementById('kode_bk').value =
            item.kode_bk ?? '';

        document.getElementById('nama_bahan_kajian').value =
            item.nama_bahan_kajian ?? '';
        document.getElementById('deskripsi').value =
            item.deskripsi ?? '';

        document.getElementById('referensi').value =
            item.referensi ?? '';

        document.getElementById('body_of_knowledge_acuan').value =
            item.body_of_knowledge_acuan ?? '';

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }


    function closeModal() {
        const modal =
            document.getElementById('bahanKajianModal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }


    // Klik area gelap untuk menutup modal
    document
        .getElementById('bahanKajianModal')
        .addEventListener('click', function(e) {

            if (e.target === this) {
                closeModal();
            }

        });
</script>

@endsection
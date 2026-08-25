@extends('layouts.app')

@section('title', 'Profil Lulusan')
@section('page-title', 'Profil Lulusan')

@section('content')
<div
    x-data="{ showModal: {{ $errors->any() ? 'true' : 'false' }} }"
    x-on:keydown.escape.window="showModal = false"
    class="mx-auto max-w-5xl space-y-6">

    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm text-slate-500">Kurikulum &rarr; Profil Lulusan</p>
            <h2 class="mt-1 font-serif text-2xl font-semibold text-navy-900">Daftar Profil Lulusan</h2>
        </div>
        <button
            @click="showModal = true"
            type="button"
            class="inline-flex items-center gap-2 rounded-lg bg-navy-800 px-4 py-2.5 text-sm font-medium text-white hover:bg-navy-700">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Profil Lulusan
        </button>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full table-fixed divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="w-24 px-5 py-3 text-left font-semibold text-slate-600">Kode</th>
                    <th class="w-[45%] px-5 py-3 text-left font-semibold text-slate-600">Isi Profil Lulusan</th>
                    <th class="w-[30%] px-5 py-3 text-left font-semibold text-slate-600">Keterangan</th>
                    <th class="px-5 py-3 text-right font-semibold text-slate-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($profilLulusan ?? [] as $item)
                <tr class="hover:bg-slate-50">
                    <td class="px-5 py-3 font-medium text-navy-700">{{ $item->kode }}</td>
                    <td class="px-5 py-3 whitespace-normal break-words">{{ $item->isi_pl }}</td>
                    <td class="px-5 py-3 whitespace-normal break-words text-slate-500">{{ $item->keterangan ?: '-' }}</td>
                    <td class="px-5 py-3 text-right">
                        <a href="#" class="text-navy-600 hover:underline">Ubah</a>
                        <span class="mx-1 text-slate-300">|</span>
                        <form
                            action="{{ route('profil-lulusan.destroy', $item->id_pl) }}"
                            method="POST"
                            class="inline"
                            onsubmit="return confirm('Hapus profil lulusan {{ $item->kode }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-5 py-10 text-center text-slate-400">
                        Belum ada data profil lulusan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Profil Lulusan -->
    <div
        x-show="showModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;">
        <!-- Backdrop -->
        <div
            x-show="showModal"
            x-transition:enter="transition-opacity ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="showModal = false"
            class="absolute inset-0 bg-navy-950/50"></div>

        <!-- Panel -->
        <div
            x-show="showModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative w-full max-w-lg rounded-xl bg-white shadow-xl">
            <form action="{{ route('profil-lulusan.store') }}" method="POST">
                @csrf

                <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                    <h3 class="font-serif text-lg font-semibold text-navy-900">Tambah Profil Lulusan</h3>
                    <button
                        type="button"
                        @click="showModal = false"
                        class="rounded-md p-1 text-slate-400 hover:bg-slate-100 hover:text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-4 px-6 py-5">
                    <div>
                        <label for="kode" class="block text-sm font-medium text-slate-700">Kode</label>
                        <input
                            type="text"
                            name="kode"
                            id="kode"
                            value="{{ old('kode') }}"
                            maxlength="20"
                            placeholder="cth. PL-01"
                            class="mt-1.5 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-navy-500 focus:ring-navy-500 @error('kode') border-red-400 @enderror">
                        @error('kode')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="isi_pl" class="block text-sm font-medium text-slate-700">Isi Profil Lulusan</label>
                        <textarea
                            name="isi_pl"
                            id="isi_pl"
                            rows="4"
                            placeholder="Jelaskan profil lulusan secara lengkap..."
                            class="mt-1.5 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-navy-500 focus:ring-navy-500 @error('isi_pl') border-red-400 @enderror">{{ old('isi_pl') }}</textarea>
                        @error('isi_pl')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-slate-700">
                            Keterangan <span class="font-normal text-slate-400">(opsional)</span>
                        </label>
                        <textarea
                            name="keterangan"
                            id="keterangan"
                            rows="2"
                            placeholder="Catatan tambahan..."
                            class="mt-1.5 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-navy-500 focus:ring-navy-500 @error('keterangan') border-red-400 @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-200 px-6 py-4">
                    <button
                        type="button"
                        @click="showModal = false"
                        class="rounded-lg px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100">
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="rounded-lg bg-navy-800 px-4 py-2.5 text-sm font-medium text-white hover:bg-navy-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
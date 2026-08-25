@extends('layouts.app')

@section('title', 'CPL')
@section('page-title', 'Capaian Pembelajaran Lulusan (CPL)')

@section('content')
<div
    x-data="{ showModal: {{ $errors->any() ? 'true' : 'false' }} }"
    x-on:keydown.escape.window="showModal = false"
    class="mx-auto max-w-5xl space-y-6">

    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm text-slate-500">Kurikulum &rarr; CPL</p>
            <h2 class="mt-1 font-serif text-2xl font-semibold text-navy-900">Daftar CPL</h2>
        </div>
        <button
            @click="showModal = true"
            type="button"
            class="inline-flex items-center gap-2 rounded-lg bg-navy-800 px-4 py-2.5 text-sm font-medium text-white hover:bg-navy-700">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah CPL
        </button>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full table-fixed divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="w-24 px-5 py-3 text-left font-semibold text-slate-600">Kode CPL</th>
                    <th class="w-40 px-5 py-3 text-left font-semibold text-slate-600">Profil Lulusan</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-600">Deskripsi CPL</th>
                    <th class="w-36 px-5 py-3 text-left font-semibold text-slate-600">Kategori CPL</th>
                    <th class="w-28 px-5 py-3 text-right font-semibold text-slate-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($cpl ?? [] as $item)
                <tr class="hover:bg-slate-50">
                    <td class="px-5 py-3 font-medium text-navy-700">{{ $item->kode_cpl }}</td>
                    <td class="px-5 py-3">
                        <div class="flex flex-wrap gap-1">
                            @forelse ($item->profilLulusan as $pl)
                            <span class="rounded-full bg-slate-100 px-2 py-0.5 text-xs font-medium text-slate-600">
                                {{ $pl->kode }}
                            </span>
                            @empty
                            <span class="text-xs text-slate-400">-</span>
                            @endforelse
                        </div>
                    </td>
                    <td class="px-5 py-3 whitespace-normal break-words text-slate-500">{{ $item->deskripsi_cpl }}</td>
                    <td class="px-5 py-3">
                        <span class="rounded-full bg-navy-50 px-2.5 py-1 text-xs font-medium text-navy-700">
                            {{ $item->cpl_dasar }}
                        </span>
                    </td>
                    <td class="px-5 py-3 text-right">
                        <a href="#" class="text-navy-600 hover:underline">Ubah</a>
                        <span class="mx-1 text-slate-300">|</span>
                        <form
                            action="{{ route('cpl.destroy', $item->id_cpl) }}"
                            method="POST"
                            class="inline"
                            onsubmit="return confirm('Hapus CPL {{ $item->kode_cpl }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-10 text-center text-slate-400">
                        Belum ada data CPL.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah CPL -->
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
            <form action="{{ route('cpl.store') }}" method="POST">
                @csrf

                <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                    <h3 class="font-serif text-lg font-semibold text-navy-900">Tambah CPL</h3>
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
                        <label class="block text-sm font-medium text-slate-700">Profil Lulusan Terkait</label>
                        <p class="mt-0.5 text-xs text-slate-400">Bisa pilih lebih dari satu.</p>
                        <div class="mt-1.5 max-h-40 space-y-1 overflow-y-auto rounded-lg border border-slate-300 p-3 @error('id_pl') border-red-400 @enderror">
                            @forelse ($profilLulusanList ?? [] as $pl)
                            @php $oldIds = old('id_pl', []); @endphp
                            <label class="flex cursor-pointer items-start gap-2 rounded-md p-1.5 hover:bg-slate-50">
                                <input
                                    type="checkbox"
                                    name="id_pl[]"
                                    value="{{ $pl->id_pl }}"
                                    {{ in_array($pl->id_pl, $oldIds) ? 'checked' : '' }}
                                    class="mt-0.5 h-4 w-4 rounded border-slate-300 text-navy-700 focus:ring-navy-500">
                                <span class="text-sm text-slate-700">
                                    <span class="font-medium">{{ $pl->kode }}</span>
                                    &mdash; {{ \Illuminate\Support\Str::limit($pl->isi_pl, 50) }}
                                </span>
                            </label>
                            @empty
                            <p class="text-sm text-slate-400">Belum ada data profil lulusan.</p>
                            @endforelse
                        </div>
                        @error('id_pl')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        @error('id_pl.*')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kode_cpl" class="block text-sm font-medium text-slate-700">Kode CPL</label>
                        <input
                            type="text"
                            name="kode_cpl"
                            id="kode_cpl"
                            value="{{ old('kode_cpl') }}"
                            maxlength="20"
                            placeholder="cth. CPL-01"
                            class="mt-1.5 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-navy-500 focus:ring-navy-500 @error('kode_cpl') border-red-400 @enderror">
                        @error('kode_cpl')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="deskripsi_cpl" class="block text-sm font-medium text-slate-700">Deskripsi CPL</label>
                        <textarea
                            name="deskripsi_cpl"
                            id="deskripsi_cpl"
                            rows="4"
                            placeholder="Jelaskan deskripsi CPL secara lengkap..."
                            class="mt-1.5 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-navy-500 focus:ring-navy-500 @error('deskripsi_cpl') border-red-400 @enderror">{{ old('deskripsi_cpl') }}</textarea>
                        @error('deskripsi_cpl')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="cpl_dasar" class="block text-sm font-medium text-slate-700">Kategori CPL</label>
                        <select
                            name="cpl_dasar"
                            id="cpl_dasar"
                            class="mt-1.5 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-navy-500 focus:ring-navy-500 @error('cpl_dasar') border-red-400 @enderror">
                            <option value="" disabled {{ old('cpl_dasar') ? '' : 'selected' }}>Pilih kategori...</option>
                            @foreach (['Sikap', 'Pengetahuan', 'Keterampilan Umum', 'Keterampilan Khusus'] as $kategori)
                            <option value="{{ $kategori }}" {{ old('cpl_dasar') === $kategori ? 'selected' : '' }}>
                                {{ $kategori }}
                            </option>
                            @endforeach
                        </select>
                        @error('cpl_dasar')
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
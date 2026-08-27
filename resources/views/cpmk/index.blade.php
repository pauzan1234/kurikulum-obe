@extends('layouts.app')

@section('title', 'CPL-CPMK')
@section('page-title', 'Penjabaran CPL ke CPMK')

@section('content')
<div
    x-data="{ showModal: {{ $errors->any() ? 'true' : 'false' }} }"
    x-on:keydown.escape.window="showModal = false"
    class="mx-auto max-w-5xl space-y-6">

    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm text-slate-500">Kurikulum &rarr; CPL-CPMK</p>
            <h2 class="mt-1 font-serif text-2xl font-semibold text-navy-900">Penjabaran CPL ke CPMK</h2>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('cpl') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50">
                &larr; Kembali ke CPL
            </a>
            <button
                @click="showModal = true"
                type="button"
                class="inline-flex items-center gap-2 rounded-lg bg-navy-800 px-4 py-2.5 text-sm font-medium text-white hover:bg-navy-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah CPMK
            </button>
        </div>
    </div>

    @if (session('success'))
    <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full table-fixed divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="w-24 px-5 py-3 text-left font-semibold text-slate-600">Kode CPL</th>
                    <th class="w-72 px-5 py-3 text-left font-semibold text-slate-600">Deskripsi CPL</th>
                    <th class="px-5 py-3 text-left font-semibold text-slate-600">Turunan CPMK</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($cplList as $item)
                <tr class="align-top hover:bg-slate-50">
                    <td class="px-5 py-3 font-medium text-navy-700">{{ $item->kode_cpl }}</td>
                    <td class="px-5 py-3 whitespace-normal break-words text-slate-500">{{ $item->deskripsi_cpl }}</td>
                    <td class="px-5 py-3">
                        @forelse ($item->cpmks as $cpmk)
                        <div class="mb-2 flex items-start justify-between gap-3 rounded-md bg-slate-50 px-3 py-2 last:mb-0">
                            <span class="text-slate-600">
                                <span class="font-medium text-navy-700">{{ $cpmk->kode_cpmk }}</span>
                                &mdash; {{ $cpmk->deskripsi_cpmk }}
                            </span>
                            <form
                                action="{{ route('cpmk.destroy', $cpmk->id) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus {{ $cpmk->kode_cpmk }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="shrink-0 text-xs text-red-600 hover:underline">Hapus</button>
                            </form>
                        </div>
                        @empty
                        <span class="text-xs text-slate-400">Belum ada turunan CPMK.</span>
                        @endforelse
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-5 py-10 text-center text-slate-400">
                        Belum ada data CPL.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah CPMK -->
    <div
        x-show="showModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;">
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

        <div
            x-show="showModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative w-full max-w-xl rounded-xl bg-white shadow-xl"
            x-data="cpmkForm({{ old('cpmk') ? json_encode(old('cpmk')) : '[]' }})">
            <form action="{{ route('cpmk.store') }}" method="POST">
                @csrf

                <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                    <h3 class="font-serif text-lg font-semibold text-navy-900">Tambah CPMK</h3>
                    <button
                        type="button"
                        @click="showModal = false"
                        class="rounded-md p-1 text-slate-400 hover:bg-slate-100 hover:text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="max-h-[70vh] space-y-5 overflow-y-auto px-6 py-5">
                    <!-- Pilih CPL -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Pilih CPL</label>
                        <p class="mt-0.5 text-xs text-slate-400">Satu CPMK hanya diturunkan dari satu CPL.</p>
                        <div class="mt-1.5 max-h-40 space-y-1 overflow-y-auto rounded-lg border border-slate-300 p-3 @error('id_cpl') border-red-400 @enderror">
                            @forelse ($cplOptions as $pl)
                            <label class="flex cursor-pointer items-start gap-2 rounded-md p-1.5 hover:bg-slate-50">
                                <input
                                    type="radio"
                                    name="id_cpl"
                                    value="{{ $pl->id_cpl }}"
                                    {{ (string) old('id_cpl') === (string) $pl->id_cpl ? 'checked' : '' }}
                                    class="mt-0.5 h-4 w-4 border-slate-300 text-navy-700 focus:ring-navy-500">
                                <span class="text-sm text-slate-700">
                                    <span class="font-medium">{{ $pl->kode_cpl }}</span>
                                    &mdash; {{ \Illuminate\Support\Str::limit($pl->deskripsi_cpl, 50) }}
                                </span>
                            </label>
                            @empty
                            <p class="text-sm text-slate-400">Belum ada data CPL.</p>
                            @endforelse
                        </div>
                        @error('id_cpl')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Turunan CPMK -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-slate-700">Turunan CPMK</label>
                            <button type="button" @click="addRow()" class="text-sm font-medium text-navy-700 hover:underline">
                                + Tambah baris
                            </button>
                        </div>

                        <div class="mt-2 space-y-3">
                            <template x-for="(row, index) in rows" :key="index">
                                <div class="rounded-lg border border-slate-300 p-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-medium text-slate-500" x-text="`CPMK #${index + 1}`"></span>
                                        <button type="button" x-show="rows.length > 1" @click="removeRow(index)" class="text-xs text-red-600 hover:underline">
                                            Hapus baris
                                        </button>
                                    </div>
                                    <div class="mt-2 space-y-2">
                                        <input
                                            type="text"
                                            :name="`cpmk[${index}][kode_cpmk]`"
                                            x-model="row.kode_cpmk"
                                            maxlength="20"
                                            placeholder="cth. CPMK11"
                                            class="block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-navy-500 focus:ring-navy-500">
                                        <textarea
                                            :name="`cpmk[${index}][deskripsi_cpmk]`"
                                            x-model="row.deskripsi_cpmk"
                                            rows="2"
                                            placeholder="Deskripsi CPMK..."
                                            class="block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-navy-500 focus:ring-navy-500"></textarea>
                                    </div>
                                </div>
                            </template>
                        </div>

                        @error('cpmk')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        @error('cpmk.*.kode_cpmk')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        @error('cpmk.*.deskripsi_cpmk')
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

<script>
    function cpmkForm(oldRows) {
        return {
            rows: (oldRows && oldRows.length) ? oldRows : [{
                kode_cpmk: '',
                deskripsi_cpmk: ''
            }],
            addRow() {
                this.rows.push({
                    kode_cpmk: '',
                    deskripsi_cpmk: ''
                });
            },
            removeRow(index) {
                this.rows.splice(index, 1);
            }
        }
    }
</script>
@endsection
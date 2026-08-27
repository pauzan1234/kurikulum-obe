@extends('layouts.app')

@section('title', 'Mata Kuliah')
@section('page-title', 'Mata Kuliah')

@section('content')

<div class="mx-auto max-w-5xl space-y-6">

    {{-- Flash message --}}
    @if(session('success'))
    <div class="rounded-lg bg-green-100 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
    @endif

    {{-- Header + tombol tambah --}}
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Mata Kuliah</h2>
        <a href="{{ route('matakuliah.create') }}"
            class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
            + Tambah Mata Kuliah
        </a>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">No</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Kode MK</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Nama Mata Kuliah</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">SKS</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-600">Semester</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($mataKuliah as $index => $mk)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-700">{{ $index + 1 }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $mk->kode_mk }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $mk->nama_mk }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $mk->sks }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $mk->semester_id }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('matakuliah.edit', $mk->id) }}"
                                class="rounded-md bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700 hover:bg-yellow-200">
                                Edit
                            </a>

                            <form action="{{ route('matakuliah.destroy', $mk->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-md bg-red-100 px-3 py-1 text-xs font-medium text-red-700 hover:bg-red-200">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                        Belum ada data mata kuliah.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
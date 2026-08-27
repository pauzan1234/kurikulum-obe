@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')
@section('page-title', 'Edit Mata Kuliah')

@section('content')

<div class="mx-auto max-w-2xl space-y-6">

    <div class="rounded-lg bg-white p-6 shadow-sm border border-gray-200">

        <form action="{{ route('matakuliah.update', $mataKuliah->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="kode_mk" class="block text-sm font-medium text-gray-700">Kode MK</label>
                <input type="text" name="kode_mk" id="kode_mk" value="{{ old('kode_mk', $mataKuliah->kode_mk) }}"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('kode_mk') border-red-500 @enderror">
                @error('kode_mk')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nama_mk" class="block text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
                <input type="text" name="nama_mk" id="nama_mk" value="{{ old('nama_mk', $mataKuliah->nama_mk) }}"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nama_mk') border-red-500 @enderror">
                @error('nama_mk')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="sks" class="block text-sm font-medium text-gray-700">SKS</label>
                    <input type="number" name="sks" id="sks" value="{{ old('sks', $mataKuliah->sks) }}" min="1" max="6"
                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('sks') border-red-500 @enderror">
                    @error('sks')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                    <input type="number" name="semester" id="semester" value="{{ old('semester', $mataKuliah->semester) }}" min="1" max="14"
                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('semester') border-red-500 @enderror">
                    @error('semester')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="id_prodi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                <select name="id_prodi" id="id_prodi"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('id_prodi') border-red-500 @enderror">
                    <option value="">-- Pilih Prodi --</option>
                    @foreach($prodis as $prodi)
                    <option value="{{ $prodi->id }}" @selected(old('id_prodi', $mataKuliah->id_prodi) == $prodi->id)>
                        {{ $prodi->nama_prodi }}
                    </option>
                    @endforeach
                </select>
                @error('id_prodi')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <a href="{{ route('matakuliah.index') }}"
                    class="rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                    Update
                </button>
            </div>
        </form>

    </div>

</div>

@endsection
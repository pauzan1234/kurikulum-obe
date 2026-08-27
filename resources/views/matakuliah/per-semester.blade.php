@extends('layouts.app')

@section('title', 'Rekap Mata Kuliah per Semester')
@section('page-title', 'Rekap Mata Kuliah per Semester')

@section('content')
<div class="mx-auto max-w-5xl space-y-6">

    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-800">Rekap Mata Kuliah per Semester</h2>
        <a href="{{ route('matakuliah.index') }}"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50">
            &larr; Kembali
        </a>
    </div>

    @forelse ($grouped as $semesterId => $items)
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="flex items-center justify-between bg-gray-50 px-4 py-3">
            <h3 class="font-semibold text-gray-700">Semester {{ $semesterId }}</h3>
            <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-medium text-indigo-700">
                Total SKS: {{ $totalPerSemester[$semesterId] }}
            </span>
        </div>
        <table class="w-full table-fixed divide-y divide-gray-200 text-sm">
            <colgroup>
                <col class="w-12">
                <col class="w-32">
                <col>
                <col class="w-20">
            </colgroup>
            <thead class="bg-white">
                <tr>
                    <th class="px-4 py-2 text-left font-medium text-gray-500">No</th>
                    <th class="px-4 py-2 text-left font-medium text-gray-500">Kode MK</th>
                    <th class="px-4 py-2 text-left font-medium text-gray-500">Nama Mata Kuliah</th>
                    <th class="px-4 py-2 text-left font-medium text-gray-500">SKS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($items as $index => $mk)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 text-gray-700">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $mk->kode_mk }}</td>
                    <td class="px-4 py-2 text-gray-700 break-words">{{ $mk->nama_mk }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $mk->sks }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @empty
    <div class="rounded-lg border border-gray-200 bg-white px-4 py-10 text-center text-gray-500 shadow-sm">
        Belum ada data mata kuliah.
    </div>
    @endforelse

    @if ($grouped->isNotEmpty())
    <div class="flex items-center justify-end rounded-lg border border-gray-200 bg-white px-4 py-3 shadow-sm">
        <span class="text-sm font-semibold text-gray-700">
            Total Keseluruhan SKS: {{ $totalKeseluruhan }}
        </span>
    </div>
    @endif

</div>
@endsection
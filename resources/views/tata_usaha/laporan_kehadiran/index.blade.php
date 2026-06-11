@extends('layouts.app')

@section('content')

<div class="p-8">

    {{-- JUDUL --}}
    <h1 class="text-5xl font-bold text-slate-800 mb-2">
        Laporan Kehadiran
    </h1>

    {{-- JAM --}}
    <div class="flex items-center gap-3 mb-6">

        <div class="bg-slate-800 text-white px-3 py-1 rounded-lg font-bold">
            07:00
        </div>

        <p class="text-slate-700 font-semibold">
            - Jumat, 08 Agustus 2025
        </p>

    </div>

    {{-- CARD --}}
    <div class="w-56 bg-zinc-900 text-white rounded-2xl p-5 mb-6">

        <p class="text-sm text-slate-300">
            Kehadiran Terisi
        </p>

        <h1 class="text-4xl font-bold">
            {{ $gurus->count() }}
            <span class="text-sm font-normal">
                guru/staff
            </span>
        </h1>

    </div>

    {{-- SEARCH --}}
    <div class="mb-5">

        <input type="text"
               placeholder="Cari nama, jabatan..."
               class="w-72 px-4 py-3 rounded-xl border border-slate-300">

    </div>

    {{-- TABEL --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="p-5 text-left">Nama</th>
                    <th class="p-5 text-left">Jabatan</th>
                    <th class="p-5 text-left">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @foreach($gurus as $guru)

                <tr class="border-t">

                    <td class="p-5">

                        {{ $guru->name }}

                    </td>

                    <td class="p-5">

                        {{ $guru->jabatan }}

                    </td>

                    <td class="p-5">

                        <a href="{{ route('tata_usaha.kehadiran.detail', $guru->id) }}"
                           class="px-4 py-2 bg-black text-white rounded-xl">

                            Detail

                        </a>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
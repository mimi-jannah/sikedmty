@extends('layouts.app')

@section('content')

<div class="bg-white rounded-3xl shadow-md p-6 mb-6">

    <div class="flex items-center gap-5">

        <div class="w-20 h-20 rounded-2xl bg-green-100 flex items-center justify-center text-4xl">

            📚

        </div>

        <div>

            <h1 class="text-4xl font-bold text-slate-800">

                Pelatihan Guru & Staff

            </h1>

            <p class="text-gray-500 mt-1">

                Ringkasan pelatihan guru & staff

            </p>

        </div>

    </div>

</div>

{{-- CARD --}}

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    
    <div class="bg-white rounded-3xl shadow p-6">

    <p class="text-gray-500">

        Total Pelatihan

    </p>

    <h2 class="text-4xl font-bold text-green-700 mt-2">

        {{ $totalPelatihan }}

    </h2>

    <span class="text-gray-400">

        Kegiatan

    </span>

</div>

<div class="bg-white rounded-3xl shadow p-6">

    <p class="text-gray-500">

        Guru Mengikuti

    </p>

    <h2 class="text-4xl font-bold text-blue-700 mt-2">

        {{ $guruMengikuti }}

    </h2>

    <span class="text-gray-400">

        Orang

    </span>

</div>

<div class="bg-white rounded-3xl shadow p-6">

    <p class="text-gray-500">

        Staff Mengikuti

    </p>

    <h2 class="text-4xl font-bold text-violet-700 mt-2">

        {{ $staffMengikuti }}

    </h2>

    <span class="text-gray-400">

        Orang

    </span>

</div>

</div>

<div class="grid grid-cols-12 gap-8">

    {{-- KIRI --}}
    <div class="col-span-12 lg:col-span-8">
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-green-700 to-emerald-500 px-8 py-5">

                <h2 class="text-3xl font-bold text-white">

                    Data Pelatihan Guru & Staff

                </h2>

                <p class="text-green-100 mt-1">

                    Daftar pelatihan yang telah diikuti guru dan staff.

                </p>

            </div>

            <div class="p-6">
                <form method="GET" class="grid grid-cols-12 gap-4 mb-6">
                    {{-- Search --}}
                    <div class="col-span-12 md:col-span-5">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama guru..."
                            class="w-full rounded-xl border border-gray-300 px-4 py-3">
                    </div>

                    {{-- Jabatan --}}
                    <div class="col-span-12 md:col-span-3">
                        <select
                            name="jabatan"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3">

                            <option value="">Semua Jabatan</option>

                            <option value="Guru"
                                {{ request('jabatan')=='Guru'?'selected':'' }}>
                                Guru
                            </option>

                            <option value="Staff"
                                {{ request('jabatan')=='Staff'?'selected':'' }}>
                                Staff
                            </option>

                        </select>
                    </div>

                    {{-- Tombol --}}
                    <div class="col-span-12 md:col-span-4">

                        <button
                            class="w-full bg-green-600 hover:bg-green-700 text-white rounded-xl py-3 font-semibold">

                            Filter

                        </button>

                    </div>

                </form>

                <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="bg-gray-100">

                            <th class="px-5 py-4">No</th>

                            <th class="px-5 py-4 text-left">Nama Guru</th>

                            <th class="px-5 py-4">Jabatan</th>

                            <th class="px-5 py-4">Pelatihan</th>

                            <th class="px-5 py-4">Penyelenggara</th>

                            <th class="px-5 py-4">Tanggal</th>

                            <th class="px-5 py-4">Sertifikat</th>

                            <th class="px-5 py-4">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($pelatihans as $pelatihan)

                    <tr class="border-b hover:bg-green-50 transition">

                        {{-- No --}}
                        <td class="px-5 py-5 text-center">

                            {{ $loop->iteration }}

                        </td>

                        {{-- Nama --}}
                        <td class="px-5 py-5">

                            <div class="font-semibold">

                                {{ $pelatihan->user->name }}

                            </div>

                            <div class="text-sm text-gray-500">

                                {{ $pelatihan->user->nip }}

                            </div>

                        </td>

                        {{-- Jabatan --}}
                        <td class="px-5 py-5 text-center">

                            {{ $pelatihan->user->jabatan }}

                        </td>

                        {{-- Pelatihan --}}
                        <td class="px-5 py-5">

                            <div class="font-medium">

                                {{ $pelatihan->nama_pelatihan }}

                            </div>

                        </td>

                        {{-- Penyelenggara --}}
                        <td class="px-5 py-5">

                            {{ $pelatihan->penyelenggara }}

                        </td>

                        {{-- Tanggal --}}
                        <td class="px-5 py-5 whitespace-nowrap">

                            {{ \Carbon\Carbon::parse($pelatihan->tanggal_pelatihan)->translatedFormat('d M Y') }}

                        </td>

                        {{-- Sertifikat --}}
                        <td class="px-5 py-5 text-center">

                            @if($pelatihan->sertifikat)

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">

                                    Ada

                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-sm">

                                    Tidak Ada

                                </span>

                            @endif

                        </td>

                        {{-- Aksi --}}
                        <td class="px-5 py-5 text-center">

                            <a href="{{ route('pelatihan.index', ['detail' => $pelatihan->id]) }}"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                                
                                Detail

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center py-8 text-gray-500">

                            Belum ada data pelatihan.

                        </td>

                    </tr>

                    @endforelse

                    </tbody>

                </table>

                </div>

            </div>

        </div>

    </div>

    {{-- KANAN --}}
    {{-- ================= DETAIL ================= --}}
<div class="col-span-12 lg:col-span-4">

@if($detail)

<div class="bg-white rounded-3xl shadow-lg overflow-hidden">

    <div class="bg-gradient-to-r from-green-700 to-emerald-500 p-5">

        <h2 class="text-2xl font-bold text-white">

            Detail Pelatihan

        </h2>

        <p class="text-green-100 text-sm">

            Informasi pelatihan yang dipilih

        </p>

    </div>

    <div class="p-6">

        <div class="flex items-center gap-4 mb-6">

            <img
                src="https://ui-avatars.com/api/?name={{ urlencode($detail->user->name) }}&background=22c55e&color=fff"
                class="w-16 h-16 rounded-full">

            <div>

                <h3 class="font-bold text-xl">
                    {{ $detail->user->name }}
                </h3>

                <p class="text-gray-500 text-sm">
                    NIP. {{ $detail->user->nip }}
                </p>

                <span class="inline-block mt-2 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">

                    {{ $detail->user->jabatan }}

                </span>

            </div>

        </div>

        <div class="space-y-5">

    <div>

        <p class="text-gray-400 text-sm">

            Nama Pelatihan

        </p>

        <p class="font-semibold">

            {{ $detail->nama_pelatihan }}

        </p>

    </div>

    <div>

        <p class="text-gray-400 text-sm">

            Penyelenggara

        </p>

        <p>

            {{ $detail->penyelenggara }}

        </p>

    </div>

    <div>

        <p class="text-gray-400 text-sm">

            Lokasi

        </p>

        <p>

            {{ $detail->lokasi }}

        </p>

    </div>

    <div>

        <p class="text-gray-400 text-sm">

            Tanggal

        </p>

        <p>

            {{ \Carbon\Carbon::parse($detail->tanggal_pelatihan)->translatedFormat('d F Y') }}

        </p>

    </div>

    <div>

        <p class="text-gray-400 text-sm">

            Deskripsi

        </p>

        <p class="leading-7">

            {{ $detail->deskripsi }}

        </p>

    </div>

</div>

            @if($detail->sertifikat)

            <a href="{{ asset('storage/'.$detail->sertifikat) }}"
            target="_blank"
            class="mt-6 block w-full text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl">

                📄 Lihat Sertifikat

            </a>

        @endif

            </div>

        </div>

        @endif

</div> {{-- col kanan --}}

</div> {{-- grid --}}

@endsection
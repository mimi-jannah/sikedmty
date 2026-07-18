@extends('layouts.app')

@section('content')

<div class="p-8">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row justify-between lg:items-center mb-8">

        <div>

            <h1 class="text-4xl font-bold text-slate-800">
                Laporan Kehadiran
            </h1>

            <p class="text-gray-500 mt-2">
                Data Kehadiran Guru & Staff MTSS Thamrin Yahya
            </p>

        </div>

        <form method="GET" class="mt-5 lg:mt-0">

            <input
                type="date"
                name="tanggal"
                value="{{ $tanggal }}"
                onchange="this.form.submit()"
                class="border rounded-xl px-4 py-3 shadow-sm">

        </form>

    </div>

    {{-- CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-8">

        {{-- TOTAL --}}
        <div class="bg-white rounded-3xl shadow-lg p-6">

            <div class="text-4xl mb-3">
                👨‍🏫
            </div>

            <p class="text-gray-500">
                Total Guru/Staff
            </p>

            <h2 class="text-4xl font-bold text-slate-800 mt-2">
                {{ $totalGuru }}
            </h2>

        </div>

        {{-- BERHASIL --}}
        <div class="bg-green-600 rounded-3xl shadow-lg p-6 text-white">

            <div class="text-4xl mb-3">
                ✅
            </div>

            <p>
                Berhasil
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $berhasil }}
            </h2>

        </div>

        {{-- TERLAMBAT --}}
        <div class="bg-yellow-500 rounded-3xl shadow-lg p-6 text-white">

            <div class="text-4xl mb-3">
                ⏰
            </div>

            <p>
                Terlambat
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $terlambat }}
            </h2>

        </div>

        {{-- CUTI --}}
        <div class="bg-blue-600 rounded-3xl shadow-lg p-6 text-white">

            <div class="text-4xl mb-3">
                🌴
            </div>

            <p>
                Cuti
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $cuti }}
            </h2>

        </div>

        {{-- TANGGAL --}}
        <div class="bg-slate-800 rounded-3xl shadow-lg p-6 text-white">

            <div class="text-4xl mb-3">
                📅
            </div>

            <p>
                Tanggal
            </p>

            <h2 class="text-xl font-bold mt-2">
                {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
            </h2>

        </div>

    </div>

    {{-- FILTER --}}
    <div class="bg-white rounded-3xl shadow-lg p-6 mb-8">

        <form method="GET">

            <div class="grid md:grid-cols-3 gap-5">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau jabatan..."
                    class="border rounded-xl px-4 py-3">

                <input
                    type="date"
                    name="tanggal"
                    value="{{ $tanggal }}"
                    class="border rounded-xl px-4 py-3">

                <button
                    class="bg-green-600 hover:bg-green-700 text-white rounded-xl">

                    Cari Data

                </button>

            </div>

        </form>

    </div>


    {{-- EXPORT EXCEL --}}
<div class="bg-white rounded-3xl shadow-lg p-6 mb-8 max-w-md">

    <h3 class="text-green-700 font-bold text-lg mb-4">
        Ekspor Kehadiran (Excel)
    </h3>

    <form>

        <div class="space-y-4">

            <select
                class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500">

                <option selected disabled>
                    Pilih Jenis Export
                </option>

                <option>
                    Semua Guru
                </option>

                <option>
                    Per Guru
                </option>

            </select>

            <button
                type="button"
                class="w-full bg-green-600 hover:bg-green-700 text-white rounded-xl py-3 transition">

                ▼ Lanjutkan

            </button>

        </div>

    </form>

</div>

        {{-- TABEL --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-green-600 text-white">

                    <tr>

                        <th class="px-6 py-4 text-left">Foto</th>
                        <th class="px-6 py-4 text-left">Nama</th>
                        <th class="px-6 py-4 text-left">Jabatan</th>
                        <th class="px-6 py-4 text-left">Jam Masuk</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-center">Lokasi</th>
                        <th class="px-6 py-4 text-center">Bukti</th>
                        <th class="px-6 py-4 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($gurus as $guru)

                    @php
                        $absen = $guru->kehadirans->first();
                    @endphp

                    <tr class="border-t hover:bg-slate-50 transition">

                        {{-- FOTO --}}
                        <td class="px-6 py-4">

                            @if($guru->foto)

                               <img
                                    src="{{ asset('images/'.$guru->foto) }}"
                                    class="w-14 h-14 rounded-full object-cover ring-2 ring-green-200 shadow-sm">

                            @else

                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($guru->name) }}&background=16a34a&color=ffffff"
                                    class="w-14 h-14 rounded-full ring-2 ring-green-200 shadow-sm">

                            @endif

                        </td>

                        {{-- NAMA --}}
                        <td class="px-6 py-4 font-semibold">

                            {{ $guru->name }}

                        </td>

                        {{-- JABATAN --}}
                        <td class="px-6 py-4">

                            {{ $guru->jabatan }}

                        </td>

                        {{-- JAM --}}
                        <td class="px-6 py-4">

                            {{ $absen->jam_masuk ?? '-' }}

                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4">

                            @if($absen)

                                @if($absen->status == 'Berhasil')

                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">

                                        Berhasil

                                    </span>

                                @elseif($absen->status == 'Terlambat')

                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">

                                        Terlambat

                                    </span>

                                @else

                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-sm font-medium">

                                        {{ $absen->status }}

                                    </span>

                                @endif

                            @else

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-600 text-sm font-semibold">

                                    Belum Absen

                                </span>

                            @endif

                        </td>

                        {{-- LOKASI --}}
                        <td class="px-6 py-4 text-center">

                            @if($absen && $absen->lokasi)

                                <a
                                    href="https://www.google.com/maps?q={{ urlencode($absen->lokasi) }}"
                                    target="_blank"
                                    class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-sm transition duration-200 shadow-sm hover:shadow-md">

                                    Lokasi

                                </a>

                            @else

                                -

                            @endif

                        </td>

                        {{-- FOTO ABSEN --}}
                        <td class="px-6 py-4 text-center">

                            @if($absen && $absen->bukti)

                               <a
                                    href="{{ asset('storage/'.$absen->bukti) }}"
                                    target="_blank"
                                    class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm transition duration-200 shadow-sm hover:shadow-md">

                                    Bukti

                                </a>

                            @else

                                -

                            @endif

                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4 text-center">

                            <a
                                href="{{ route('tata_usaha.kehadiran.detail', $guru->id) }}"
                                class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl transition duration-200 shadow-sm hover:shadow-md">

                                Lihat Riwayat

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center py-8 text-gray-500">

                            Tidak ada data.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
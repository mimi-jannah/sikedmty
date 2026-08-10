@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="mb-10">

    <h1 class="text-5xl font-bold text-slate-800">
        Dasbor Kepala Sekolah
    </h1>

    <p class="text-slate-500 mt-3 text-lg">
        Monitoring Kehadiran Guru & Staff
        MTSS Thamrin Yahya
    </p>

</div>


{{-- CARD --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-10">

    {{-- TOTAL GURU --}}
    <div class="bg-gradient-to-r
                from-green-700
                to-emerald-500
                text-white
                p-6
                rounded-3xl
                shadow-xl">

        <p class="text-lg">
            Total Guru
        </p>

        <h2 class="text-4xl font-bold mt-2">
            {{ $totalGuru }}
        </h2>

        <p class="text-sm mt-1 opacity-80">
            Orang
        </p>

    </div>


    {{-- HADIR --}}
    <div class="bg-gradient-to-r
                from-blue-700
                to-cyan-500
                text-white
                p-6
                rounded-3xl
                shadow-xl">

        <p class="text-lg">
            Kehadiran Hari Ini
        </p>

        <h2 class="text-4xl font-bold mt-2">
            {{ $totalHadir }}
        </h2>

        <p class="text-sm mt-1 opacity-80">
            Orang
        </p>

    </div>


    {{-- TERLAMBAT --}}
    <div class="bg-gradient-to-r
                from-yellow-500
                to-amber-400
                text-white
                p-6
                rounded-3xl
                shadow-xl">

        <p class="text-lg">
            Terlambat
        </p>

        <h2 class="text-4xl font-bold mt-2">
            {{ $totalTerlambat }}
        </h2>

        <p class="text-sm mt-1 opacity-80">
            Orang
        </p>

    </div>


    {{-- KETIDAKHADIRAN --}}
    <div class="bg-gradient-to-r
                from-red-600
                to-rose-500
                text-white
                p-6
                rounded-3xl
                shadow-xl">

        <p class="text-lg">
            Ketidakhadiran
        </p>

        <h2 class="text-4xl font-bold mt-2">
            {{ $totalTidakHadir }}
        </h2>

        <p class="text-sm mt-1 opacity-80">
            Orang
        </p>

    </div>


    {{-- CUTI --}}
    <div class="bg-gradient-to-r
                from-purple-700
                to-indigo-500
                text-white
                p-6
                rounded-3xl
                shadow-xl">

        <p class="text-lg">
            Data Cuti
        </p>

        <h2 class="text-4xl font-bold mt-2">
            {{ $totalCuti }}
        </h2>

        <p class="text-sm mt-1 opacity-80">
            Pengajuan
        </p>

    </div>

</div>


{{-- MONITORING --}}
<div class="bg-white
            rounded-3xl
            shadow-xl
            overflow-hidden">

    <div class="bg-green-50 p-6">

        <h2 class="text-2xl font-bold text-slate-800">
            Monitoring Kehadiran Terbaru
        </h2>

        <p class="text-slate-500 mt-1">
            Informasi kehadiran guru/staff termasuk status dan lokasi.
        </p>

    </div>


    {{-- TABEL RESPONSIVE --}}
    <div class="overflow-x-auto">

        <table class="w-full min-w-[800px]">

            <thead>

                <tr class="border-b bg-slate-50">

                    <th class="p-5 text-left">
                        Nama
                    </th>

                    <th class="p-5 text-left">
                        Tanggal
                    </th>

                    <th class="p-5 text-left">
                        Jam Masuk
                    </th>

                    <th class="p-5 text-left">
                        Status
                    </th>

                    <th class="p-5 text-left">
                        Lokasi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($monitoring as $item)

                <tr class="border-t hover:bg-slate-50">

                    {{-- NAMA --}}
                    <td class="p-5 font-semibold">

                        {{ $item->user->name ?? '-' }}

                    </td>


                    {{-- TANGGAL --}}
                    <td class="p-5">

                        {{ $item->tanggal }}

                    </td>


                    {{-- JAM --}}
                    <td class="p-5">

                        {{ $item->jam_masuk ?? '-' }}

                    </td>


                    {{-- STATUS --}}
                    <td class="p-5">

                        @if($item->status == 'Berhasil')

                            <span class="bg-green-100
                                         text-green-700
                                         px-4 py-2
                                         rounded-xl
                                         font-semibold">

                                {{ $item->status }}

                            </span>

                        @elseif($item->status == 'Terlambat')

                            <span class="bg-yellow-100
                                         text-yellow-700
                                         px-4 py-2
                                         rounded-xl
                                         font-semibold">

                                {{ $item->status }}

                            </span>

                        @else

                            <span class="bg-red-100
                                         text-red-700
                                         px-4 py-2
                                         rounded-xl
                                         font-semibold">

                                {{ $item->status ?? '-' }}

                            </span>

                        @endif

                    </td>


                    {{-- LOKASI --}}
                    <td class="p-5">

                        @if($item->lokasi)

                            <span class="text-sm text-slate-600">
                                📍 {{ $item->lokasi }}
                            </span>

                        @else

                            <span class="text-gray-400">
                                -
                            </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5"
                        class="text-center py-10 text-gray-400">

                        Belum ada data kehadiran

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
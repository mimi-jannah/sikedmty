@extends('layouts.app')

@section('content')

<div class="p-8">

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
    <div class="grid md:grid-cols-4 gap-6 mb-10">

        {{-- GURU --}}
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

        </div>

        {{-- CUTI --}}
        <div class="bg-gradient-to-r
                    from-yellow-500
                    to-amber-400
                    text-white
                    p-6
                    rounded-3xl
                    shadow-xl">

            <p class="text-lg">
                Data Perizinan
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $totalCuti }}
            </h2>

        </div>

        {{-- PELATIHAN --}}
        <div class="bg-gradient-to-r
                    from-slate-700
                    to-slate-500
                    text-white
                    p-6
                    rounded-3xl
                    shadow-xl">

            <p class="text-lg">
                Pelatihan
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $totalPelatihan }}
            </h2>

        </div>

    </div>

    {{-- TABEL --}}
    <div class="bg-white
                rounded-3xl
                shadow-xl
                overflow-hidden">

        <div class="bg-green-50 p-6">

            <h2 class="text-2xl font-bold text-slate-800">
                Monitoring Kehadiran Terbaru
            </h2>

        </div>

        <table class="w-full">

            <thead>

                <tr class="border-b">

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

                    <td class="p-5">
                        {{ $item->tanggal }}
                    </td>

                    <td class="p-5">
                        {{ $item->jam_masuk }}
                    </td>

                    <td class="p-5">

                        @if($item->status == 'Berhasil')

                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-xl">

                                {{ $item->status }}

                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-xl">

                                {{ $item->status }}

                            </span>

                        @endif

                    </td>

                    <td class="p-5">

                        {{ $item->lokasi ?? '-' }}

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4"
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
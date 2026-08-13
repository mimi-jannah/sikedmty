@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-10">

        <h1 class="text-5xl font-bold text-gray-800 mb-3">
            Validasi Cuti
        </h1>

        <p class="text-gray-500 text-lg">
            Persetujuan cuti guru dan staff
        </p>

    </div>


    {{-- TABLE --}}
    <div class="bg-white
                rounded-3xl
                shadow-2xl
                overflow-hidden">

        {{-- HEADER TABLE --}}
        <div class="bg-gradient-to-r
                    from-green-700
                    to-emerald-500
                    px-8 py-6">

            <h2 class="text-3xl font-bold text-white">
                Data Pengajuan Cuti
            </h2>

        </div>


        {{-- TABLE RESPONSIVE --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-green-50">

                    <tr>

                        <th class="p-5 text-left">
                            Nama
                        </th>

                        <th class="p-5 text-left">
                            Jenis
                        </th>

                        <th class="p-5 text-left">
                            Tanggal
                        </th>

                        <th class="p-5 text-left">
                            Lama
                        </th>

                        <th class="p-5 text-left">
                            Kuota
                        </th>

                        <th class="p-5 text-left">
                            Alasan
                        </th>

                        <th class="p-5 text-left">
                            Surat
                        </th>

                        <th class="p-5 text-left">
                            Status
                        </th>

                        <th class="p-5 text-left">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($cutis as $cuti)

                    @php

                        /*
                        |--------------------------------------------------------------------------
                        | HITUNG LAMA PENGAJUAN
                        |--------------------------------------------------------------------------
                        */

                        $tanggalMulai = \Carbon\Carbon::parse(
                            $cuti->tanggal_mulai
                        );

                        $tanggalSelesai = \Carbon\Carbon::parse(
                            $cuti->tanggal_selesai
                        );

                        $lamaPengajuan =
                            $tanggalMulai->diffInDays(
                                $tanggalSelesai
                            ) + 1;


                        /*
                        |--------------------------------------------------------------------------
                        | HITUNG CUTI YANG SUDAH DIGUNAKAN
                        |--------------------------------------------------------------------------
                        */

                        $kuotaTahunan = 12;

                        $tahunCuti = $tanggalMulai->year;

                        $cutiTerpakai = \App\Models\Cuti::where(
                            'user_id',
                            $cuti->user_id
                        )
                        ->where('jenis', 'Cuti')
                        ->where('status', 'Disetujui')
                        ->whereYear('tanggal_mulai', $tahunCuti)
                        ->get()
                        ->sum(function ($data) {

                            return \Carbon\Carbon::parse(
                                $data->tanggal_mulai
                            )->diffInDays(
                                \Carbon\Carbon::parse(
                                    $data->tanggal_selesai
                                )
                            ) + 1;

                        });


                        /*
                        |--------------------------------------------------------------------------
                        | SISA CUTI
                        |--------------------------------------------------------------------------
                        */

                        $sisaCuti = max(
                            0,
                            $kuotaTahunan - $cutiTerpakai
                        );


                        /*
                        |--------------------------------------------------------------------------
                        | SISA SETELAH PENGAJUAN
                        |--------------------------------------------------------------------------
                        */

                        $sisaSetelahPengajuan = max(
                            0,
                            $sisaCuti - $lamaPengajuan
                        );

                    @endphp


                    <tr class="border-t hover:bg-slate-50">


                        {{-- NAMA --}}
                        <td class="p-5 font-semibold">

                            {{ $cuti->user->name }}

                        </td>


                        {{-- JENIS --}}
                        <td class="p-5">

                            <span class="bg-green-100
                                         text-green-700
                                         px-4 py-2
                                         rounded-2xl
                                         font-semibold">

                                {{ $cuti->jenis }}

                            </span>

                        </td>


                        {{-- TANGGAL --}}
                        <td class="p-5">

                            {{ $tanggalMulai->translatedFormat('d F Y') }}

                            -

                            {{ $tanggalSelesai->translatedFormat('d F Y') }}

                        </td>


                        {{-- LAMA --}}
                        <td class="p-5">

                            <span class="font-semibold">

                                {{ $lamaPengajuan }} hari

                            </span>

                        </td>


                        {{-- KUOTA --}}
                        <td class="p-5">

                            @if($cuti->jenis === 'Cuti')

                                <div class="space-y-2">

                                    <div class="text-sm">

                                        <span class="text-gray-500">
                                            Terpakai:
                                        </span>

                                        <strong>
                                            {{ $cutiTerpakai }} hari
                                        </strong>

                                    </div>


                                    @if($sisaCuti > 0)

                                        <span class="inline-block
                                                     bg-green-100
                                                     text-green-700
                                                     px-3 py-2
                                                     rounded-xl
                                                     text-sm
                                                     font-semibold">

                                            Sisa {{ $sisaCuti }} hari

                                        </span>

                                    @else

                                        <span class="inline-block
                                                     bg-red-100
                                                     text-red-700
                                                     px-3 py-2
                                                     rounded-xl
                                                     text-sm
                                                     font-semibold">

                                            Kuota Habis

                                        </span>

                                    @endif

                                </div>

                            @else

                                <span class="text-gray-400">
                                    Tidak menggunakan kuota
                                </span>

                            @endif

                        </td>


                        {{-- ALASAN --}}
                        <td class="p-5">

                            {{ $cuti->alasan }}

                        </td>


                        {{-- SURAT --}}
                        <td class="p-5">

                            @if($cuti->surat)

                                <a href="{{ asset('surat-cuti/'.$cuti->surat) }}"
                                   target="_blank"
                                   class="bg-green-100
                                          hover:bg-green-200
                                          text-green-700
                                          px-4 py-2
                                          rounded-2xl
                                          font-semibold">

                                    Lihat Surat

                                </a>

                            @else

                                <span class="text-gray-400">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- STATUS --}}
                        <td class="p-5">

                            @if($cuti->status == 'Menunggu')

                                <span class="bg-yellow-100
                                             text-yellow-700
                                             px-4 py-2
                                             rounded-2xl
                                             font-semibold">

                                    Menunggu

                                </span>

                            @elseif($cuti->status == 'Disetujui')

                                <span class="bg-green-100
                                             text-green-700
                                             px-4 py-2
                                             rounded-2xl
                                             font-semibold">

                                    Disetujui

                                </span>

                            @else

                                <span class="bg-red-100
                                             text-red-700
                                             px-4 py-2
                                             rounded-2xl
                                             font-semibold">

                                    Ditolak

                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td class="p-5">

                            @if($cuti->status == 'Menunggu')

                                {{-- JIKA CUTI TAHUNAN --}}
                                @if($cuti->jenis === 'Cuti')

                                    @if(
                                        $sisaCuti > 0 &&
                                        $lamaPengajuan <= $sisaCuti
                                    )

                                        <div class="flex gap-3">

                                            {{-- SETUJUI --}}
                                            <form
                                                action="{{ route(
                                                    'kepala.cuti_kepsek.setujui',
                                                    $cuti->id
                                                ) }}"
                                                method="POST">

                                                @csrf

                                                @method('PUT')

                                                <button
                                                    type="submit"
                                                    class="bg-green-600
                                                           hover:bg-green-700
                                                           text-white
                                                           px-4 py-2
                                                           rounded-xl
                                                           font-semibold">

                                                    Setujui

                                                </button>

                                            </form>


                                            {{-- TOLAK --}}
                                            <form
                                                action="{{ route(
                                                    'kepala.cuti_kepsek.tolak',
                                                    $cuti->id
                                                ) }}"
                                                method="POST">

                                                @csrf

                                                @method('PUT')

                                                <button
                                                    type="submit"
                                                    class="bg-red-600
                                                           hover:bg-red-700
                                                           text-white
                                                           px-4 py-2
                                                           rounded-xl
                                                           font-semibold">

                                                    Tolak

                                                </button>

                                            </form>

                                        </div>

                                    @else

                                        <div class="space-y-2">

                                            <span class="block
                                                         bg-red-100
                                                         text-red-700
                                                         px-4 py-2
                                                         rounded-xl
                                                         text-sm
                                                         font-semibold">

                                                Tidak dapat disetujui

                                            </span>

                                            <small class="block
                                                          text-red-500">

                                                @if($sisaCuti <= 0)

                                                    Kuota cuti sudah habis.

                                                @else

                                                    Sisa kuota hanya
                                                    {{ $sisaCuti }} hari.

                                                @endif

                                            </small>

                                        </div>

                                    @endif


                                {{-- IZIN / SAKIT --}}
                                @else

                                    <div class="flex gap-3">

                                        {{-- SETUJUI --}}
                                        <form
                                            action="{{ route(
                                                'kepala.cuti_kepsek.setujui',
                                                $cuti->id
                                            ) }}"
                                            method="POST">

                                            @csrf

                                            @method('PUT')

                                            <button
                                                type="submit"
                                                class="bg-green-600
                                                       hover:bg-green-700
                                                       text-white
                                                       px-4 py-2
                                                       rounded-xl
                                                       font-semibold">

                                                Setujui

                                            </button>

                                        </form>


                                        {{-- TOLAK --}}
                                        <form
                                            action="{{ route(
                                                'kepala.cuti_kepsek.tolak',
                                                $cuti->id
                                            ) }}"
                                            method="POST">

                                            @csrf

                                            @method('PUT')

                                            <button
                                                type="submit"
                                                class="bg-red-600
                                                       hover:bg-red-700
                                                       text-white
                                                       px-4 py-2
                                                       rounded-xl
                                                       font-semibold">

                                                Tolak

                                            </button>

                                        </form>

                                    </div>

                                @endif

                            @else

                                <span class="text-gray-400">
                                    Selesai
                                </span>

                            @endif

                        </td>

                    </tr>


                    @empty

                    <tr>

                        <td colspan="9"
                            class="text-center
                                   p-10
                                   text-gray-500">

                            Belum ada pengajuan

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
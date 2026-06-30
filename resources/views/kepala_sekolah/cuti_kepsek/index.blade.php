@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <h1 class="text-5xl
               font-bold
               text-gray-800
               mb-3">

        Validasi Cuti

    </h1>

    <p class="text-gray-500
              text-lg
              mb-10">

        Persetujuan izin/cuti guru dan staff

    </p>

    <div class="bg-white
                rounded-3xl
                shadow-2xl
                overflow-hidden">

        {{-- HEADER --}}
        <div class="bg-gradient-to-r
                    from-green-700
                    to-emerald-500
                    px-8 py-6">

            <h2 class="text-3xl
                       font-bold
                       text-white">

                Data Pengajuan Cuti

            </h2>

        </div>

        {{-- TABLE --}}
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

                    <tr class="border-t">

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

                            {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->translatedFormat('d F Y') }}
                            -
                            {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->translatedFormat('d F Y') }}

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
                                          text-green-700
                                          px-4 py-2
                                          rounded-2xl
                                          font-semibold">

                                    Lihat Surat

                                </a>

                            @else

                                -

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

        <div class="flex gap-3">

            {{-- SETUJUI --}}
            <form action="{{ route('kepala.cuti_kepsek.setujui', $cuti->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <button
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
            <form action="{{ route('kepala.cuti_kepsek.tolak', $cuti->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <button
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

        {{-- JIKA SUDAH DISETUJUI / DITOLAK --}}
        <a href="{{ asset('surat-cuti/'.$cuti->surat) }}"
           target="_blank"
           class="bg-slate-700
                  hover:bg-slate-800
                  text-white
                  px-4 py-2
                  rounded-xl
                  font-semibold">

            Detail

        </a>

    @endif

</td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7"
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
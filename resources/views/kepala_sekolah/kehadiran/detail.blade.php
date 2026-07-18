@extends('layouts.app')

@section('content')

<div class="p-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-5xl font-bold text-slate-800">

                Monitoring Kehadiran Guru

            </h1>

            <p class="text-blue-600 mt-2 text-lg font-semibold">

                {{ $guru->name }} • {{ $guru->jabatan }}

            </p>

        </div>

        {{-- BUTTON --}}
        <div class="bg-blue-100
                    text-blue-700
                    px-6 py-3
                    rounded-2xl
                    font-bold">

            Kepala Sekolah

        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">

        <table class="w-full">

            {{-- HEAD --}}
            <thead class="bg-blue-50">

                <tr>

                    <th class="p-5 text-left text-slate-700">
                        Tanggal
                    </th>

                    <th class="p-5 text-left text-slate-700">
                        Jam Masuk
                    </th>

                    <th class="p-5 text-left text-slate-700">
                        Lokasi
                    </th>

                    <th class="p-5 text-left text-slate-700">
                        Status Kehadiran
                    </th>

                    <th class="p-5 text-left text-slate-700">
                        Bukti Kehadiran
                    </th>

                </tr>

            </thead>

            {{-- BODY --}}
            <tbody>

                @foreach($riwayat as $item)

                <tr class="border-t hover:bg-slate-50 transition">

                    {{-- TANGGAL --}}
                    <td class="p-5 font-medium text-slate-700">

                        {{ $item->tanggal }}

                    </td>

                    {{-- JAM --}}
                    <td class="p-5 font-semibold text-slate-700">

                        {{ $item->jam_masuk }}

                    </td>

                    {{-- LOKASI --}}
<td class="p-5">

    @if($item->lokasi)

        <a href="https://www.google.com/maps?q={{ $item->lokasi }}"
           target="_blank"
           class="bg-blue-100
                  text-blue-700
                  px-4 py-2
                  rounded-2xl
                  font-semibold
                  hover:bg-blue-200
                  transition">

            📍 {{ $item->lokasi }}

        </a>

    @else

        <span class="bg-gray-100
                     text-gray-500
                     px-4 py-2
                     rounded-2xl
                     font-semibold">

            📍 Lokasi tidak tersedia

        </span>

    @endif

</td>

                    {{-- STATUS --}}
<td class="p-5">

    @if($item->status == 'Berhasil')

        <span class="bg-green-100
                     text-green-700
                     px-5 py-2
                     rounded-2xl
                     font-semibold">

            {{ $item->status }}

        </span>

    @elseif($item->status == 'Terlambat')

        <span class="bg-red-100
                     text-red-700
                     px-5 py-2
                     rounded-2xl
                     font-semibold">

            {{ $item->status }}

        </span>

    @else

        <span class="bg-gray-100
                     text-gray-700
                     px-5 py-2
                     rounded-2xl
                     font-semibold">

            {{ $item->status }}

        </span>

    @endif

</td>

                    {{-- FOTO --}}
                    <td class="p-5">

                        @if($item->bukti)

                            <a href="{{ asset('storage/'.$item->bukti) }}"
                               target="_blank"
                               class="bg-blue-600
                                      hover:bg-blue-700
                                      transition
                                      text-white
                                      px-5 py-2
                                      rounded-xl
                                      font-semibold">

                                Lihat Foto

                            </a>

                        @else

                            <span class="text-gray-400">

                                Tidak ada foto

                            </span>

                        @endif

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
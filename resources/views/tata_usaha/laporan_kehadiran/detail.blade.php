@extends('layouts.app')

@section('content')

<div class="p-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-5xl font-bold text-slate-800">

                Riwayat Kehadiran {{ $guru->name }}

            </h1>

            <p class="text-gray-500 mt-2">

                {{ $guru->jabatan }}

            </p>

        </div>

        {{-- EXPORT --}}
        <a href="{{ route('tata_usaha.kehadiran.export', $guru->id) }}"
           class="bg-black
                  text-white
                  px-6 py-3
                  rounded-2xl
                  font-bold
                  hover:bg-gray-800
                  transition">

            ⬇ Ekspor Excel

        </a>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <table class="w-full">

            {{-- HEAD --}}
            <thead class="bg-slate-100">

                <tr>

                    <th class="p-5 text-left">
                        Tanggal
                    </th>

                    <th class="p-5 text-left">
                        Jam Masuk
                    </th>

                    <th class="p-5 text-left">
                        Lokasi
                    </th>

                    <th class="p-5 text-left">
                        Keterangan
                    </th>

                    <th class="p-5 text-left">
                        Bukti Kehadiran
                    </th>

                </tr>

            </thead>

            {{-- BODY --}}
            <tbody>

                @foreach($riwayat as $item)

                <tr class="border-t">

                    {{-- TANGGAL --}}
                    <td class="p-5">

                        {{ $item->tanggal }}

                    </td>

                    {{-- JAM --}}
                    <td class="p-5">

                        {{ $item->jam_masuk }}

                    </td>

                    {{-- LOKASI --}}
                    <td class="p-5 text-green-700 font-semibold">

                        📍 {{ $item->lokasi ?? '-' }}

                    </td>

                    {{-- STATUS --}}
                    <td class="p-5">

                        @if($item->status == 'Berhasil')

                            <span class="bg-green-100
                                         text-green-700
                                         px-4 py-2
                                         rounded-xl
                                         font-bold">

                                Hadir

                            </span>

                        @elseif($item->status == 'Terlambat')

                            <span class="bg-yellow-100
                                         text-yellow-700
                                         px-4 py-2
                                         rounded-xl
                                         font-bold">

                                Terlambat

                            </span>

                        @else

                            <span class="bg-red-100
                                         text-red-700
                                         px-4 py-2
                                         rounded-xl
                                         font-bold">

                                Tidak Hadir

                            </span>

                        @endif

                    </td>

                    {{-- FOTO --}}
                    <td class="p-5">

                        @if($item->bukti)

                            <a href="{{ asset('storage/'.$item->bukti) }}"
                               target="_blank"
                               class="bg-black
                                      text-white
                                      px-4 py-2
                                      rounded-xl
                                      font-semibold">

                                Foto

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
@extends('layouts.app')

@section('content')

<div class="p-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-5xl font-bold text-slate-800">
                Mata Pelajaran
            </h1>

            <p class="text-gray-500 mt-2">
                Daftar Mata Pelajaran MTSS Thamrin Yahya
            </p>

        </div>

        {{-- SEARCH --}}
        <div>

            <input type="text"
                   placeholder="🔍 Cari kelas, nama mata pelajaran..."
                   class="w-80
                          px-5 py-3
                          rounded-xl
                          border
                          border-gray-300">

        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-green-50">

                <tr>

                    <th class="p-5 text-left">
                        No
                    </th>

                    <th class="p-5 text-left">
                        Kelas
                    </th>

                    <th class="p-5 text-left">
                        Nama Mata Pelajaran
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($mapels as $item)

                <tr class="border-t hover:bg-slate-50">

                    <td class="p-5">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-5">

                        <span class="bg-blue-100
                                     text-blue-700
                                     px-4 py-2
                                     rounded-xl
                                     font-semibold">

                            {{ $item->kelas }}

                        </span>

                    </td>

                    <td class="p-5 font-medium text-slate-700">

                        {{ $item->nama_mapel }}

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="3"
                        class="text-center py-10 text-gray-400">

                        Belum ada data mata pelajaran

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
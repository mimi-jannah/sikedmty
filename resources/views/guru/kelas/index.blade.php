@extends('layouts.app')

@section('content')

<div class="p-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-5xl font-bold text-slate-800">
                Daftar Kelas
            </h1>

            

        </div>

        {{-- SEARCH --}}
        <div class="relative">

            <input type="text"
                   placeholder="🔍 Cari kelas, wali kelas, guru..."
                   class="w-80
                          px-5 py-3
                          rounded-2xl
                          border
                          border-slate-300
                          focus:outline-none">

        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <table class="w-full">

            {{-- HEAD --}}
            <thead class="bg-slate-100">

                <tr>

                    <th class="p-5 text-left">No</th>
                    <th class="p-5 text-left">Kelas</th>
                    <th class="p-5 text-left">Total Siswa</th>
                    <th class="p-5 text-left">Wali Kelas</th>
                    <th class="p-5 text-left">Guru</th>
                    <th class="p-5 text-left">Jam Mengajar</th>
                    <th class="p-5 text-left">Hari Mengajar</th>

                </tr>

            </thead>

            {{-- BODY --}}
            <tbody>

                @foreach($kelas as $item)

                <tr class="border-t hover:bg-slate-50 transition">

                    <td class="p-5">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-5 font-semibold">
                        {{ $item->nama_kelas }}
                    </td>

                    <td class="p-5">
                        {{ $item->total_siswa }}
                    </td>

                    <td class="p-5">
                        {{ $item->wali_kelas }}
                    </td>

                    <td class="p-5">
                        {{ $item->guru }}
                    </td>

                    <td class="p-5">
                        {{ $item->jam_mengajar }}
                    </td>

                    <td class="p-5">
                        {{ $item->hari_mengajar }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
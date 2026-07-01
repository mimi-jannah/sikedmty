@extends('layouts.app')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="bg-white rounded-3xl shadow-md p-8 mb-6">

        <div class="flex items-center gap-4">

            <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center">

                <i class="fa-solid fa-file-lines text-3xl text-green-600"></i>

            </div>

            <div>

                <h1 class="text-4xl font-bold text-slate-800">
                    Hasil Penilaian Kinerja
                </h1>

                <p class="text-gray-500 mt-1">
                    Dashboard >
                    <span class="text-green-600 font-medium">
                        Hasil Penilaian
                    </span>
                </p>

            </div>

        </div>

    </div>

    {{-- Informasi Penilaian --}}
    <div class="bg-gradient-to-r from-green-50 to-emerald-50
                border border-green-200
                rounded-2xl
                p-6
                mb-8">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="text-2xl font-bold text-green-800">

                    Penilaian Kinerja Guru Semester Ganjil 2026/2027

                </h2>

                <div class="flex flex-wrap gap-8 mt-5 text-gray-700">

                    <div>

                        <span class="text-gray-500">
                            Tahun Ajaran
                        </span>

                        <br>

                        <strong>
                            2026/2027
                        </strong>

                    </div>

                    <div>

                        <span class="text-gray-500">
                            Semester
                        </span>

                        <br>

                        <strong>
                            Ganjil
                        </strong>

                    </div>

                    <div>

                        <span class="text-gray-500">
                            Tanggal Penilaian
                        </span>

                        <br>

                        <strong>
                            30 Juni 2026
                        </strong>

                    </div>

                    <div>

                        <span class="text-gray-500">
                            Dinilai Oleh
                        </span>

                        <br>

                        <strong>
                            Kepala Sekolah
                        </strong>

                    </div>

                </div>

            </div>

            <div>

                <select
                    class="rounded-xl border-gray-300">

                    <option>
                        2025/2026
                    </option>

                    <option>
                        2026/2027
                    </option>

                </select>

            </div>

        </div>

    </div>

    {{-- Statistik --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    {{-- Total Skor --}}
    <div class="bg-white rounded-2xl shadow-md p-6 flex justify-between items-center">

        <div>

            <p class="text-gray-500 text-sm">
                Total Skor
            </p>

            <h2 class="text-4xl font-bold text-slate-800 mt-2">
                90
            </h2>

            <p class="text-green-600 font-semibold mt-1">
                (90%)
            </p>

        </div>

        

    </div>

    {{-- Predikat --}}
    <div class="bg-white rounded-2xl shadow-md p-6 flex justify-between items-center">

        <div>

            <p class="text-gray-500 text-sm">
                Predikat
            </p>

            <h2 class="text-3xl font-bold text-blue-600 mt-2">
                Sangat Baik
            </h2>

            <p class="text-gray-500">
                Kinerja Anda
            </p>

        </div>

    </div>

    {{-- Ranking --}}
    <div class="bg-white rounded-2xl shadow-md p-6 flex justify-between items-center">

        <div>

            <p class="text-gray-500 text-sm">
                Ranking
            </p>

            <h2 class="text-3xl font-bold text-purple-600 mt-2">
                1
            </h2>

            <p class="text-gray-500">
                Dari Semua Guru
            </p>

        </div>

    </div>

    {{-- Tanggal --}}
    <div class="bg-white rounded-2xl shadow-md p-6 flex justify-between items-center">

        <div>

            <p class="text-gray-500 text-sm">
                Tanggal Penilaian
            </p>

            <h2 class="text-2xl font-bold text-orange-600 mt-2">
                30 Juni 2026
            </h2>

            <p class="text-gray-500">
                07.16 WIB
            </p>

        </div>

    </div>

</div>

{{-- ================= RINCIAN PENILAIAN ================= --}}
<div class="bg-white rounded-3xl shadow-lg overflow-hidden">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-green-700 to-emerald-500 px-8 py-5">

        <h2 class="text-2xl font-bold text-white">

            Rincian Penilaian

        </h2>

        <p class="text-green-100 mt-1">

            Detail hasil penilaian kinerja dari Kepala Sekolah

        </p>

    </div>

    <div class="p-6">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead>

                    <tr class="bg-green-50 text-green-700">

                        <th class="px-5 py-4 text-left">No</th>

                        <th class="px-5 py-4 text-left">Indikator</th>

                        <th class="px-5 py-4 text-center">Nilai</th>

                        <th class="px-5 py-4 text-center">Kategori</th>

                        <th class="px-5 py-4 text-left">Keterangan</th>

                    </tr>

                </thead>

                <tbody>

                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-5 py-4">
                            1
                        </td>

                        <td class="px-5 py-4 font-medium">
                            Penilaian Kinerja
                        </td>

                        <td class="px-5 py-4 text-center">

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-lg font-semibold">

                                90

                            </span>

                        </td>

                        <td class="px-5 py-4 text-center">

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg font-semibold">

                                Sangat Baik

                            </span>

                        </td>

                        <td class="px-5 py-4">

                            Guru menunjukkan kinerja yang sangat baik.

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
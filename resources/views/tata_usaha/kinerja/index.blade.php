@extends('layouts.app')

@section('content')

<div class="bg-white rounded-3xl shadow-md p-6 mb-6">

    <div class="flex items-center justify-between">

        <div class="flex items-center gap-5">

            <div class="w-20 h-20 rounded-2xl bg-green-100 flex items-center justify-center text-4xl">

                📋

            </div>

            <div>

                <h1 class="text-4xl font-bold text-slate-800">

                    Data Penilaian Kinerja

                </h1>

                <p class="text-gray-500 mt-1">

                    Kelola seluruh data penilaian guru & staff

                </p>

            </div>

        </div>

        {{-- Breadcrumb --}}
        <div class="hidden lg:flex items-center gap-3 bg-white border rounded-xl px-6 py-3">

            <span class="text-gray-500">Dashboard</span>

            <span>›</span>

            <span class="text-gray-500">Penilaian Kinerja</span>

            <span>›</span>

            <span class="text-green-700 font-semibold">

                Data Penilaian

            </span>

        </div>

    </div>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

    <div class="bg-white rounded-3xl shadow p-6">

        <p class="text-gray-500">
            Total Penilaian
        </p>

        <h2 class="text-4xl font-bold text-green-700 mt-2">

            {{ $totalPenilaian }}

        </h2>

        <span class="text-gray-400">
            Penilaian
        </span>

    </div>

    <div class="bg-white rounded-3xl shadow p-6">

        <p class="text-gray-500">

            Guru Sudah Dinilai

        </p>

        <h2 class="text-4xl font-bold text-blue-700 mt-2">

            {{ $guruSudahDinilai }}

        </h2>

        <span class="text-gray-400">

            Orang

        </span>

    </div>



    <div class="bg-white rounded-3xl shadow p-6">

        <p class="text-gray-500">

            Nilai Rata-rata

        </p>

        <h2 class="text-4xl font-bold text-green-700 mt-2">

            {{ $rataRata }}

        </h2>

        <span class="text-gray-400">

            Poin

        </span>

    </div>

</div>

<div class="bg-white rounded-2xl shadow p-6 mb-6">

    <form method="GET">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5">

            {{-- Tahun Ajaran --}}
            <div>

                <label class="block text-sm font-semibold mb-2">

                    Tahun Ajaran

                </label>

                <select
                    name="tahun"
                    class="w-full border rounded-xl px-4 py-3">

                    <option>2025/2026</option>

                </select>

            </div>

            {{-- Semester --}}
            <div>

                <label class="block text-sm font-semibold mb-2">

                    Semester

                </label>

                <select
                    name="semester"
                    class="w-full border rounded-xl px-4 py-3">

                    <option>Ganjil</option>
                    <option>Genap</option>

                </select>

            </div>

            {{-- Predikat --}}
            <div>

                <label class="block text-sm font-semibold mb-2">

                    Predikat

                </label>

                <select
                    name="kategori"
                    class="w-full border rounded-xl px-4 py-3">

                    <option value="">

                        Semua Predikat

                    </option>

                    <option>Sangat Baik</option>

                    <option>Baik</option>

                    <option>Cukup</option>

                    <option>Kurang</option>

                </select>

            </div>

            {{-- Cari Guru --}}
            <div>

                <label class="block text-sm font-semibold mb-2">

                    Cari Nama Guru

                </label>

                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama guru..."
                    class="w-full border rounded-xl px-4 py-3">

            </div>

            {{-- Tombol --}}
            <div class="flex items-end gap-3">

                <button
                    class="flex-1 bg-green-600 hover:bg-green-700 text-white rounded-xl py-3">

                    🔍 Cari

                </button>

                <a href="{{ route('tata_usaha.kinerja.index') }}"
                   class="px-5 py-3 rounded-xl bg-gray-200 hover:bg-gray-300">

                    Reset

                </a>

            </div>

        </div>

    </form>

</div>

<div class="grid grid-cols-12 gap-6">

    {{-- KIRI --}}
    <div class="col-span-12 lg:col-span-8">

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4">

            <h2 class="text-xl font-bold text-white">

                Daftar Penilaian Kinerja

            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-5 py-4 text-left">No</th>
                        <th class="px-5 py-4 text-left">Nama Guru / Staff</th>
                        <th class="px-5 py-4 text-left">Jabatan</th>
                        <th class="px-5 py-4 text-center">Nilai</th>
                        <th class="px-5 py-4 text-center">Predikat</th>
                        <th class="px-5 py-4 text-center">Tanggal</th>
                        <th class="px-5 py-4 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($penilaians as $index => $penilaian)

                <tr class="border-b hover:bg-green-50 transition">

                    <td class="px-5 py-5">

    {{ $penilaians->firstItem() + $index }}

</td>

<td class="px-5 py-5">

    <div class="flex items-center gap-3">

        <img

        src="https://ui-avatars.com/api/?name={{ urlencode($penilaian->user->name) }}&background=22c55e&color=fff"

        class="w-10 h-10 rounded-full">

        <div>

            <p class="font-semibold">

                {{ $penilaian->user->name }}

            </p>

            <p class="text-xs text-gray-500">

                {{ $penilaian->user->nip }}

            </p>

        </div>

    </div>

</td>

<td class="px-5 py-5">

    {{ $penilaian->user->jabatan }}

</td>

<td class="px-5 py-5 text-center">

    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-lg font-bold">

        {{ $penilaian->nilai }}

    </span>

</td>

<td class="px-5 py-5 text-center">

    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

        {{ $penilaian->kategori }}

    </span>

</td>

<td class="px-5 py-5 text-center">

    {{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->translatedFormat('d M Y') }}

</td>

<td class="px-5 py-5">

    <div class="flex justify-center gap-2">

        <a href="{{ route('tata_usaha.kinerja.index', ['detail' => $penilaian->id]) }}"

        class="bg-green-600 text-white px-3 py-2 rounded-lg">

            Detail

        </a>

        <a href="{{ route('tata_usaha.kinerja.pdf', $penilaian->id) }}"
            target="_blank"
            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg">

                Ekspor

            </a>


    </div>

</td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="py-10 text-center text-gray-500">

                        Belum ada data penilaian.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

            <div class="px-6 py-4">

                {{ $penilaians->links() }}

            </div>

        </div>

    </div>

</div>

    {{-- KANAN --}}
    <div class="col-span-12 lg:col-span-4">

    @if($detail)

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <div class="bg-gradient-to-r from-green-700 to-green-600 px-6 py-4">

            <h2 class="text-xl font-bold text-white">
                Detail Penilaian
            </h2>

            <p class="text-green-100 text-sm">
                Informasi penilaian yang dipilih
            </p>

        </div>

        <div class="p-6">
            <div class="flex items-center gap-4 mb-6">

    <img
        src="https://ui-avatars.com/api/?name={{ urlencode($detail->user->name) }}&background=22c55e&color=fff&size=150"
        class="w-16 h-16 rounded-full shadow">

    <div>

        <h3 class="text-xl font-bold">

            {{ $detail->user->name }}

        </h3>

        <p class="text-gray-500 text-sm">

            NIP. {{ $detail->user->nip }}

        </p>

        <span class="inline-block mt-1 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">

            {{ $detail->user->jabatan }}

        </span>

    </div>


    
</div>
<div class="space-y-4">

    <div class="flex justify-between">

        <span class="text-gray-500">Tanggal Penilaian</span>

        <span class="font-semibold">

            {{ \Carbon\Carbon::parse($detail->tanggal_penilaian)->translatedFormat('d F Y') }}

        </span>

    </div>

    <div class="flex justify-between">

        <span class="text-gray-500">

            Nilai

        </span>

        <span class="font-bold text-green-700">

            {{ $detail->nilai }}

        </span>

    </div>

    <div class="flex justify-between">

        <span class="text-gray-500">

            Predikat

        </span>

        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">

            {{ $detail->kategori }}

        </span>

    </div>

</div>

<hr class="my-6">

<h4 class="font-bold mb-3">

    Catatan Kepala Sekolah

</h4>

<div class="bg-green-50 border border-green-200 rounded-xl p-4 leading-7 text-gray-700">

    {{ $detail->deskripsi }}

</div>

<div class="grid grid-cols-2 gap-3 mt-6">

</div>

</div> {{-- p-6 --}}

</div> {{-- card --}}

@endif

</div> {{-- col-span-4 --}}

@endsection
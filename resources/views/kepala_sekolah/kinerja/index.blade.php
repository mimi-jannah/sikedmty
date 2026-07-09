@extends('layouts.app')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <div class="flex justify-between items-center">

            <div class="flex items-center gap-6">

                <div class="w-24 h-24 rounded-2xl bg-green-100 flex items-center justify-center">

                    <span class="text-5xl">

                        📋

                    </span>

                </div>

                <div>

                    <h1 class="text-4xl font-extrabold text-slate-800">

                        Penilaian Kinerja

                    </h1>

                    <p class="text-lg text-gray-500 mt-1">

                        Monitoring penilaian guru & staff MTSS Thamrin Yahya

                    </p>

                </div>

            </div>


        </div>

    </div>

 {{-- ================= CARD ================= --}}

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        {{-- TOTAL --}}
        <div class="bg-white rounded-3xl shadow-md p-6">

            <div class="flex justify-between">

                <div>

                    <p class="text-gray-500">

                        Total Penilaian

                    </p>

                    <h1 class="text-5xl font-bold text-green-700 mt-3">

                        {{ $penilaians->count() }}

                    </h1>

                    <p class="text-gray-400">

                        Penilaian

                    </p>

                </div>

                <div
                    class="w-20
                           h-20
                           rounded-2xl
                           bg-green-100
                           flex
                           items-center
                           justify-center
                           text-4xl">

                    📋

                </div>

            </div>

        </div>

        {{-- GURU --}}
        <div class="bg-white rounded-3xl shadow-md p-6">

            <div class="flex justify-between">

                <div>

                    <p class="text-gray-500">

                        Guru Dinilai

                    </p>

                    <h1 class="text-5xl font-bold text-green-700 mt-3">

                        {{ $gurus->count() }}

                    </h1>

                    <p class="text-gray-400">

                        Orang

                    </p>

                </div>

                <div
                    class="w-20
                           h-20
                           rounded-2xl
                           bg-green-100
                           flex
                           items-center
                           justify-center
                           text-4xl">

                    👨‍🏫

                </div>

            </div>

        </div>

        {{-- RATA-RATA --}}
        <div class="bg-white rounded-3xl shadow-md p-6">

            <div class="flex justify-between">

                <div>

                    <p class="text-gray-500">

                        Nilai Rata-rata

                    </p>

                    <h1 class="text-5xl font-bold text-green-700 mt-3">

                        {{ $penilaians->count() ? round($penilaians->avg('nilai')) : 0 }}

                    </h1>

                    <p class="text-gray-400">

                        Poin

                    </p>

                </div>

                <div
                    class="w-20
                           h-20
                           rounded-2xl
                           bg-green-100
                           flex
                           items-center
                           justify-center
                           text-4xl">

                    ⭐

                </div>

            </div>

        </div>

        {{-- STATUS --}}
        <div class="bg-white rounded-3xl shadow-md p-6">

            <div class="flex justify-between">

                <div>

                    <p class="text-gray-500">

                        Sangat Baik

                    </p>

                    <h1 class="text-5xl font-bold text-green-700 mt-3">

                        {{ $penilaians->where('kategori','Sangat Baik')->count() }}

                    </h1>

                    <p class="text-gray-400">

                        Guru

                    </p>

                </div>

                <div
                    class="w-20
                           h-20
                           rounded-2xl
                           bg-green-100
                           flex
                           items-center
                           justify-center
                           text-4xl">

                    ✅

                </div>

            </div>

        </div>

    </div>

    {{-- ================= GRID ================= --}}

    <div class="grid grid-cols-12 gap-8">

        {{-- KIRI --}}
        <div class="col-span-12 lg:col-span-8">
    
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-green-700 to-emerald-500 px-8 py-5">

        <h2 class="text-3xl font-bold text-white">

            Penilaian Kinerja Guru/Staff

        </h2>

        <p class="text-green-100 mt-1">

            Daftar penilaian yang telah diberikan

        </p>

    </div>

    {{-- SEARCH --}}
    <div class="p-6">

        <form
            method="GET"
            class="grid grid-cols-12 gap-4 mb-8">

            {{-- Cari --}}
            <div class="col-span-12 md:col-span-5">

               <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama guru/staff..."
                class="w-full
                rounded-xl
                border
                border-gray-300
                px-5
                py-3
                focus:ring-2
                focus:ring-green-500">

            </div>

            {{-- Jabatan --}}
            <div class="col-span-6 md:col-span-3">

                <select
                    name="jabatan"
                    class="w-full
                        rounded-xl
                        border
                        border-gray-300
                        px-4
                        py-3">

                    <option value="">Semua Jabatan</option>

                    <option value="Guru"
                        {{ request('jabatan') == 'Guru' ? 'selected' : '' }}>
                        Guru
                    </option>

                    <option value="Staff TU"
                        {{ request('jabatan') == 'Staff TU' ? 'selected' : '' }}>
                        Staff TU
                    </option>

                </select>

            </div>

            {{-- Tanggal --}}
            <div class="col-span-6 md:col-span-3">

                <input
                    type="date"
                    name="tanggal_penilaian"
                    value="{{ request('tanggal_penilaian') }}"
                    class="w-full
                        rounded-xl
                        border
                        border-gray-300
                        px-4
                        py-3">

            </div>

            {{-- Sorting --}}
                <div class="col-span-12 md:col-span-3">

                    <select
                        name="sort"
                        class="w-full
                            rounded-xl
                            border
                            border-gray-300
                            px-4
                            py-3">

                        <option value="">Urutkan</option>

                        <option value="terbaru"
                            {{ request('sort')=='terbaru' ? 'selected' : '' }}>
                            Tanggal Terbaru
                        </option>

                        <option value="terlama"
                            {{ request('sort')=='terlama' ? 'selected' : '' }}>
                            Tanggal Terlama
                        </option>

                        <option value="nama_asc"
                            {{ request('sort')=='nama_asc' ? 'selected' : '' }}>
                            Nama A-Z
                        </option>

                        <option value="nama_desc"
                            {{ request('sort')=='nama_desc' ? 'selected' : '' }}>
                            Nama Z-A
                        </option>

                        <option value="nilai_desc"
                            {{ request('sort')=='nilai_desc' ? 'selected' : '' }}>
                            Nilai Tertinggi
                        </option>

                        <option value="nilai_asc"
                            {{ request('sort')=='nilai_asc' ? 'selected' : '' }}>
                            Nilai Terendah
                        </option>

                    </select>

                </div>

            {{-- Tombol --}}
            <div class="col-span-6 md:col-span-1">

                <button
                    type="submit"
                    class="w-full
                        h-full
                        rounded-xl
                        bg-green-600
                        hover:bg-green-700
                        text-white
                        transition">

                    🔍

                </button>

            </div>

            <div class="col-span-6 md:col-span-1">

                <a href="{{ route('kinerja.index') }}"
                class="w-full
                        h-full
                        flex
                        items-center
                        justify-center
                        rounded-xl
                        bg-gray-300
                        hover:bg-gray-400
                        text-gray-700
                        transition">

                    Reset

                </a>

            </div>

        </form>

        {{-- TABEL --}}
        <div class="overflow-x-auto rounded-xl">

            <table class="min-w-full">

                <thead>

                    <tr class="bg-gray-100 text-gray-700">

                        <th class="w-16 py-4 text-center">No</th>

                        <th class="px-6 py-4 text-left">Nama Guru</th>

                        <th class="px-6 py-4 text-left">Jabatan</th>

                        <th class="px-6 py-4 text-left">Tanggal</th>

                        <th class="text-left">Deskripsi</th>

                        <th class="px-6 py-4 text-left">Nilai</th>

                        <th class="px-6 py-4 text-left">Aksi</th>

                    </tr>

                    </thead>

                <tbody>

                    @forelse($penilaians as $item)

                    <tr
                        class="border-b
                               hover:bg-green-50">

                        <td class="px-6 py-5 text-center align-top">

                            {{ $loop->iteration }}

                        </td>

                       <td class="px-6 py-5">

                            <a href="{{ route('kepala-sekolah.kinerja.show', $item->id) }}"
                            class="font-semibold text-slate-800 hover:text-green-600 transition">

                                {{ $item->user->name }}

                            </a>

                            <p class="text-sm text-gray-500 mt-1">

                                {{ $item->user->nip }}

                            </p>

                        </td>

                        <td class="px-6 py-5 align-top">

                            {{ $item->user->jabatan }}

                        </td>

                        <td class="px-6 py-5 text-center align-top whitespace-nowrap">

                            {{ \Carbon\Carbon::parse($item->tanggal_penilaian)->format('d-m-Y') }}

                        </td>

                        <td class="py-5 align-top">

                            <div class="leading-6">

                                {{ $item->deskripsi }}

                            </div>

                        </td>

                        <td class="px-6 py-5 text-center align-top">

                            <span class="inline-flex items-center justify-center
                                min-w-[60px]
                                h-10
                                rounded-xl
                                bg-green-100
                                text-green-700
                                font-bold">

                                {{ $item->nilai }}

                            </span>

                        </td>

    <td class="px-6 py-5 align-top">

    <div class="flex flex-wrap justify-center gap-2">

        {{-- Tombol Edit --}}
        <a href="{{ route('kinerja.edit', $item->id) }}"
           class="inline-flex
                  items-center
                  justify-center
                  px-5
                  py-2.5
                  rounded-xl
                  bg-blue-600
                  hover:bg-blue-700
                  text-white
                  font-medium
                  shadow
                  transition">

            Edit

        </a>

        {{-- Tombol Hapus --}}
        <form action="{{ route('kinerja.destroy', $item->id) }}" method="POST">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                onclick="return confirm('Yakin ingin menghapus data ini?')"
                class="inline-flex
                       items-center
                       justify-center
                       px-5
                       py-2.5
                       rounded-xl
                       bg-red-500
                       hover:bg-red-600
                       text-white
                       font-medium
                       shadow
                       transition">

                Hapus

            </button>

        </form>

    </div>

</td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="7"
                            class="text-center py-16 text-gray-400">

                            Belum ada data penilaian.

                        </td>


                    </tr>

                    @endforelse

                </tbody>

            </table> {{-- tutup overflow-x-auto --}}

            <div class="mt-6">

                {{ $penilaians->links() }}

            </div>

        </div> {{-- tutup p-6 --}}

    </div> {{-- tutup card putih --}}

</div> {{-- tutup col-span-8 --}}

</div>

{{-- ================= KANAN ================= --}}
<div class="col-span-12 lg:col-span-4">

    <div class="bg-white rounded-3xl shadow-lg p-6 sticky top-6">

        <h2 class="text-2xl font-bold text-slate-800 mb-6">

            Tambah Penilaian Kinerja

        </h2>

                {{-- ERROR VALIDASI --}}
        @if ($errors->any())

        <div class="mb-5 bg-red-100 border border-red-300 rounded-xl p-4">

            <ul class="list-disc ml-5 text-red-700">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

                    @if(isset($penilaian))

            <form
                action="{{ route('kinerja.update', $penilaian->id) }}"
                method="POST"
                class="space-y-5">

                @csrf
                @method('PUT')

            @else

            <form
                action="{{ route('kinerja.store') }}"
                method="POST"
                class="space-y-5">

                @csrf

            @endif

            {{-- Guru --}}
            <div>

                <label class="font-semibold text-gray-700">

                    Guru / Staff

                </label>

                <select
                    name="user_id"
                    class="w-full mt-2 rounded-xl border-gray-300">

                    <option value="">

                        Pilih Guru / Staff

                    </option>

                    @foreach($gurus as $guru)

                        <option
                            value="{{ $guru->id }}"
                            {{ isset($penilaian) && $penilaian->user_id == $guru->id ? 'selected' : '' }}>

                            {{ $guru->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Tanggal --}}
            <div>

                <label class="font-semibold text-gray-700">

                    Tanggal Penilaian

                </label>

                <input
                    type="date"
                    name="tanggal_penilaian"
                    value="{{ isset($penilaian) ? $penilaian->tanggal_penilaian : '' }}"
                    class="w-full mt-2 rounded-xl border-gray-300">
            </div>

            {{-- Deskripsi --}}
            <div>

                <label class="font-semibold text-gray-700">

                    Deskripsi Kinerja

                </label>

                <textarea
                    rows="5"
                    name="deskripsi"
                    placeholder="Masukkan deskripsi penilaian..."
                    class="w-full mt-2 rounded-xl border-gray-300">{{ isset($penilaian) ? $penilaian->deskripsi : '' }}
                </textarea>

            </div>

            {{-- Nilai --}}
            <div>

                <label class="font-semibold text-gray-700">

                    Nilai (0-100)

                </label>

                <input
                    type="number"
                    name="nilai"
                    min="0"
                    max="100"
                    value="{{ isset($penilaian) ? $penilaian->nilai : '' }}"
                    class="w-full mt-2 rounded-xl border-gray-300">
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3 pt-3">

                <button
                    type="submit"
                    class="flex-1
                        bg-green-600
                        hover:bg-green-700
                        text-white
                        py-3
                        rounded-xl
                        font-semibold">

                    {{ isset($penilaian) ? 'Update' : 'Simpan' }}

                </button>

                <button
                    type="reset"
                    class="flex-1
                           bg-gray-200
                           hover:bg-gray-300
                           py-3
                           rounded-xl
                           font-semibold">

                    Batal

                </button>

            </div>

        </form>

    </div>

</div>

</div> {{-- tutup grid --}}

</div>

@endsection
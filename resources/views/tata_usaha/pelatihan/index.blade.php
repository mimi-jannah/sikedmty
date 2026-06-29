@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-100 p-8">

    {{-- HEADER --}}
<div class="bg-white rounded-3xl shadow-md p-8 mb-8">

    <div class="flex justify-between items-center">

        <div class="flex items-center gap-5">

            <div
                class="w-20
                       h-20
                       rounded-2xl
                       bg-green-100
                       flex
                       items-center
                       justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-10 h-10 text-green-700"
                     fill="currentColor"
                     viewBox="0 0 24 24">

                    <path d="M3 5h18v2H3zm2 4h14v10H5z"/>

                </svg>

            </div>

            <div>

                <h1 class="text-4xl font-bold text-slate-800">

                    Data Pelatihan

                </h1>

                <p class="text-gray-500 mt-1">

                    Ringkasan pelatihan guru & staff
                    MTSS Thamrin Yahya

                </p>

            </div>

        </div>

        <button
            onclick="document.getElementById('modalTambahPelatihan').classList.remove('hidden')"
            class="bg-gradient-to-r
                   from-green-700
                   to-emerald-500
                   hover:scale-105
                   duration-300
                   text-white
                   px-8
                   py-4
                   rounded-xl
                   shadow-lg
                   font-semibold">

            + Tambah Pelatihan

        </button>

    </div>

</div>

        <div class="grid grid-cols-4 gap-6 mb-8">

    <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-gray-500 text-sm">

            Total Pelatihan

        </p>

        <h2 class="text-4xl font-bold text-green-700 mt-2">

            {{ $pelatihans->count() }}

        </h2>

        <p class="text-gray-400">

            Kegiatan

        </p>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-gray-500 text-sm">

            Guru Mengikuti

        </p>

        <h2 class="text-4xl font-bold text-green-700 mt-2">

            {{ $pelatihans->groupBy('user_id')->count() }}

        </h2>

        <p class="text-gray-400">

            Orang

        </p>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-gray-500 text-sm">

            Tahun Ini

        </p>

        <h2 class="text-4xl font-bold text-green-700 mt-2">

            {{ $pelatihans->where('tanggal_pelatihan','>=',now()->startOfYear())->count() }}

        </h2>

        <p class="text-gray-400">

            Kegiatan

        </p>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-gray-500 text-sm">

            Sertifikat

        </p>

        <h2 class="text-4xl font-bold text-green-700 mt-2">

            {{ $pelatihans->whereNotNull('sertifikat')->count() }}

        </h2>

        <p class="text-gray-400">

            File

        </p>

    </div>

</div>

<div class="bg-white rounded-3xl shadow mb-6">

    <div
        class="bg-gradient-to-r
               from-green-700
               to-emerald-500
               text-white
               px-6
               py-4
               rounded-t-3xl">

        <h2 class="font-bold">

            Daftar Pelatihan

        </h2>

    </div>

    <div class="p-5">

        <div class="grid grid-cols-4 gap-4">

            <input
                id="searchPelatihan"
                type="text"
                placeholder="Cari nama pelatihan..."
                class="rounded-xl border-gray-300">

            <select
                id="filterGuru"
                class="rounded-xl border-gray-300">

                <option>

                    Semua Guru

                </option>

                @foreach($gurus as $guru)

                    <option>

                        {{ $guru->name }}

                    </option>

                @endforeach

            </select>

            <select
                class="rounded-xl border-gray-300">

                <option>

                    Semua Lokasi

                </option>

                <option>

                    Sekolah

                </option>

                <option>

                    Luar Sekolah

                </option>

            </select>

            <button
                id="btnFilter"
                class="bg-green-700 text-white rounded-xl">

                Filter

            </button>

        </div>

    </div>

</div>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-green-50">

                <tr>

                    <th class="p-5 text-left w-20">
                        #
                    </th>

                    <th class="p-5 text-left w-20">
                        Guru
                    </th>

                    <th class="p-5 text-left">
                        Tanggal Pelatihan
                    </th>

                    <th class="p-5 text-left">
                        Nama Pelatihan
                    </th>

                    <th class="p-5 text-left">
                        Deskripsi
                    </th>

                    <th class="p-5 text-left">
                        Penyelenggara
                    </th>

                    <th class="p-5 text-left">
                        Sertifikat
                    </th>

                    <th class="p-5 text-left">
                        Lokasi
                    </th>

                    <th class="p-5 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody id="tablePelatihan">

                @forelse($pelatihans as $item)

                <tr class="border-b hover:bg-green-50 duration-200 pelatihan-row">

                    {{-- NO --}}
                    <td class="p-5">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-5">

    <div class="flex items-center gap-3">

        <div
            class="w-11
                   h-11
                   rounded-full
                   bg-green-100
                   flex
                   items-center
                   justify-center
                   text-green-700
                   font-bold">

            {{ strtoupper(substr($item->user->name,0,1)) }}

        </div>

        <div>

            <p class="font-semibold text-slate-700">

                {{ $item->user->name }}

            </p>

        </div>

    </div>

</td>

                    {{-- TANGGAL --}}
                    <td class="p-5">

                        {{ \Carbon\Carbon::parse($item->tanggal_pelatihan)->locale('id')->translatedFormat('d F Y') }}

                    </td>

                    {{-- NAMA --}}
                    <td class="p-5">
                        <p class="nama-pelatihan font-semibold text-slate-700">

                            {{ $item->nama_pelatihan }}

                        </p>

                    </td>

                    {{-- DESKRIPSI --}}
                    <td class="p-5 text-slate-600">

                        {{ $item->deskripsi }}

                    </td>

                    {{-- PENYELENGGARA --}}
                    <td class="p-5">

                        {{ $item->penyelenggara }}

                    </td>

                    {{-- SERTIFIKAT --}}
                    <td class="p-5">

                        @if($item->sertifikat)

                            <a href="{{ asset('storage/'.$item->sertifikat) }}"
                               target="_blank"
                               class="bg-green-100
                                      text-green-700
                                      px-4 py-2
                                      rounded-xl
                                      font-semibold
                                      hover:bg-green-200">

                                Lihat Sertifikat

                            </a>

                        @else

                            <span class="text-gray-400">

                                Tidak Ada

                            </span>

                        @endif

                    </td>

                    {{-- LOKASI --}}
                    <td class="p-5">

                        @if($item->lokasi=="Sekolah")

                        <span
                            class="bg-green-100
                            text-green-700
                            px-3
                            py-1
                            rounded-full
                            text-sm
                            font-semibold">

                            Sekolah

                        </span>

                        @else

                        <span
                            class="bg-blue-100
                            text-blue-700
                            px-3
                            py-1
                            rounded-full
                            text-sm
                            font-semibold">

                            Luar Sekolah

                        </span>

                        @endif

                    </td>

                    {{-- AKSI --}}
                    <td class="p-5">

    <div class="flex justify-center gap-2">

        {{-- EDIT --}}
        <button
            onclick="document.getElementById('editPelatihan{{ $item->id }}').classList.remove('hidden')"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl font-semibold">

            Edit

        </button>

        {{-- HAPUS --}}
        <form
            action="{{ route('tata_usaha.pelatihan.destroy',$item->id) }}"
            method="POST"
            onsubmit="return confirm('Yakin ingin menghapus data pelatihan ini?')">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl font-semibold">

                Hapus

            </button>

        </form>

    </div>

</td>

                </tr>

                @empty

                <tr>

                    <td colspan="8"
                        class="text-center
                               py-12
                               text-gray-400">

                        Belum ada data pelatihan

                    </td>

                </tr>

                @endforelse

            <script>

            document.getElementById("btnFilter").addEventListener("click", function(){

                let keyword = document
                    .getElementById("searchPelatihan")
                    .value
                    .trim()
                    .toLowerCase();

                let rows = document.querySelectorAll(".pelatihan-row");

                rows.forEach(function(row){

                    let namaElement = row.querySelector(".nama-pelatihan");

                    if(!namaElement){
                        return;
                    }

                    let nama = namaElement.innerText.toLowerCase();

                    if(nama.includes(keyword))
                    {
                        row.style.display = "";
                    }
                    else
                    {
                        row.style.display = "none";
                    }

                });

            });

    </script>

            </tbody>

        </table>

                <div
                class="flex
                justify-between
                items-center
                px-6
                py-4
                bg-gray-50">

                <p class="text-gray-500">

                Menampilkan

                <b>

                {{ $pelatihans->count() }}

                </b>

                data pelatihan

                </p>

                <div class="flex gap-2">

        <button
                class="w-10
                h-10
                rounded-lg
                border">

                <

        </button>

        <button
                class="w-10
                h-10
                rounded-lg
                bg-green-700
                text-white">

                1

        </button>

                <button
                    class="w-10
                    h-10
                    rounded-lg
                    border">

                    >

                </button>

            </div>

        </div>

    </div>

</div>

{{-- MODAL TAMBAH --}}
<div id="modalTambahPelatihan"
     class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-white
            rounded-3xl
            p-8
            w-[700px]
            max-h-screen
            overflow-y-auto
            shadow-2xl">

        <h2 class="text-3xl font-bold text-green-700 mb-6">

            Tambah Data Pelatihan

        </h2>

        <form action="{{ route('tata_usaha.pelatihan.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

            {{-- GURU --}}
        <div class="mb-5">

            <label class="block mb-2 font-semibold">

                Guru

            </label>

            <select
                name="user_id"
                required
                class="w-full rounded-2xl border-gray-300">

                <option value="">
                    -- Pilih Guru --
                </option>

                @foreach($gurus as $guru)

                    <option value="{{ $guru->id }}">

                        {{ $guru->name }}

                    </option>

                @endforeach

            </select>

        </div>

            {{-- TANGGAL --}}
            <div class="mb-5">

                <label class="block mb-2 font-semibold">

                    Tanggal Pelatihan

                </label>

                <input type="date"
                       name="tanggal_pelatihan"
                       required
                       class="w-full rounded-2xl border-gray-300">

            </div>

            {{-- NAMA --}}
            <div class="mb-5">

                <label class="block mb-2 font-semibold">

                    Nama Pelatihan

                </label>

                <input type="text"
                       name="nama_pelatihan"
                       required
                       class="w-full rounded-2xl border-gray-300">

            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-5">

                <label class="block mb-2 font-semibold">

                    Deskripsi Pelatihan

                </label>

                <textarea
                    name="deskripsi"
                    rows="3"
                    required
                    class="w-full rounded-2xl border-gray-300"></textarea>

            </div>

            {{-- PENYELENGGARA --}}
            <div class="mb-5">

                <label class="block mb-2 font-semibold">

                    Penyelenggara

                </label>

                <input type="text"
                       name="penyelenggara"
                       required
                       class="w-full rounded-2xl border-gray-300">

            </div>

            {{-- LOKASI --}}
            <div class="mb-5">

                <label class="block mb-2 font-semibold">

                    Lokasi

                </label>

                <select name="lokasi"
                        required
                        class="w-full rounded-2xl border-gray-300">

                    <option value="">
                        Pilih Lokasi
                    </option>

                    <option value="Sekolah">
                        Sekolah
                    </option>

                    <option value="Luar Sekolah">
                        Luar Sekolah
                    </option>

                </select>

            </div>

            {{-- SERTIFIKAT --}}
            <div class="mb-6">

                <label class="block mb-2 font-semibold">

                    Upload Sertifikat

                </label>

                <input type="file"
                       name="sertifikat"
                       accept=".pdf,.jpg,.jpeg,.png"
                       class="w-full rounded-2xl border-gray-300">

                <small class="text-gray-500">

                    Format: PDF, JPG, JPEG, PNG

                </small>

            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end gap-3">

                <button
                    type="button"
                    onclick="document.getElementById('modalTambahPelatihan').classList.add('hidden')"
                    class="bg-gray-200 px-5 py-3 rounded-xl">

                    Batal

                </button>

                <button
                    type="submit"
                    class="bg-gradient-to-r
                           from-green-700
                           to-emerald-500
                           text-white
                           px-6 py-3
                           rounded-xl
                           font-semibold">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@foreach($pelatihans as $item)

<div id="editPelatihan{{ $item->id }}"
     class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-white rounded-3xl p-8 w-[700px] max-h-screen overflow-y-auto shadow-2xl">

        <h2 class="text-3xl font-bold text-yellow-500 mb-6">

            Edit Data Pelatihan

        </h2>

        <form
            action="{{ route('guru.pelatihan.update',$item->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- TANGGAL --}}
            <div class="mb-5">

                <label class="block mb-2 font-semibold">

                    Tanggal Pelatihan

                </label>

                <input
                    type="date"
                    name="tanggal_pelatihan"
                    value="{{ $item->tanggal_pelatihan }}"
                    class="w-full rounded-2xl border-gray-300">

            </div>

            {{-- NAMA --}}
            <div class="mb-5">

                <label class="block mb-2 font-semibold">

                    Nama Pelatihan

                </label>

                <input
                    type="text"
                    name="nama_pelatihan"
                    value="{{ $item->nama_pelatihan }}"
                    class="w-full rounded-2xl border-gray-300">

            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-5">

                <label class="block mb-2 font-semibold">

                    Deskripsi

                </label>

                <textarea
                    name="deskripsi"
                    rows="3"
                    class="w-full rounded-2xl border-gray-300">{{ $item->deskripsi }}</textarea>

            </div>

            {{-- PENYELENGGARA --}}
            <div class="mb-5">

                <label class="block mb-2 font-semibold">

                    Penyelenggara

                </label>

                <input
                    type="text"
                    name="penyelenggara"
                    value="{{ $item->penyelenggara }}"
                    class="w-full rounded-2xl border-gray-300">

            </div>

            {{-- LOKASI --}}
            <div class="mb-5">

                <label class="block mb-2 font-semibold">

                    Lokasi

                </label>

                <select
                    name="lokasi"
                    class="w-full rounded-2xl border-gray-300">

                    <option
                        value="Sekolah"
                        {{ $item->lokasi=='Sekolah' ? 'selected':'' }}>

                        Sekolah

                    </option>

                    <option
                        value="Luar Sekolah"
                        {{ $item->lokasi=='Luar Sekolah' ? 'selected':'' }}>

                        Luar Sekolah

                    </option>

                </select>

            </div>

            {{-- SERTIFIKAT --}}
            <div class="mb-6">

                <label class="block mb-2 font-semibold">

                    Upload Sertifikat Baru

                </label>

                <input
                    type="file"
                    name="sertifikat"
                    accept=".pdf,.jpg,.jpeg,.png">

                @if($item->sertifikat)

                    <div class="mt-3">

                        <a href="{{ asset('storage/'.$item->sertifikat) }}"
                           target="_blank"
                           class="text-green-600 font-semibold">

                            Lihat Sertifikat Lama

                        </a>

                    </div>

                @endif

            </div>

            <div class="flex justify-end gap-3">

                <button
                    type="button"
                    onclick="document.getElementById('editPelatihan{{ $item->id }}').classList.add('hidden')"
                    class="bg-gray-200 px-5 py-3 rounded-xl">

                    Batal

                </button>

                <button
                    type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl">

                    Update

                </button>

            </div>

        </form>

    </div>

</div>

@endforeach

@endsection
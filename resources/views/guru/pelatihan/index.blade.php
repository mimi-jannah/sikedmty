@extends('layouts.app')

@php
    \Carbon\Carbon::setLocale('id');
@endphp

@section('content')

<div class="p-8">

    {{-- HEADER --}}
    <div class="bg-white rounded-3xl shadow-lg p-8 mb-6">

    <div class="flex justify-between items-center">

        <div class="flex items-center gap-5">

            <div class="w-20 h-20 rounded-2xl bg-green-100 flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-10 h-10 text-green-700"
                     fill="currentColor"
                     viewBox="0 0 24 24">

                    <path d="M4 6.5C4 5.12 5.12 4 6.5 4H20v14H6.5A2.5 2.5 0 014 15.5v-9zM6.5 6A.5.5 0 006 6.5v9a.5.5 0 00.5.5H18V6H6.5z"/>

                </svg>

            </div>

            

            <div>

                <h1 class="text-5xl font-bold text-slate-800">

                    Pelatihan Saya

                </h1>

                <p class="text-gray-500 mt-2">

                    Riwayat pelatihan yang Anda ikuti

                </p>

            </div>

        </div>

        <button
            onclick="document.getElementById('modalTambahPelatihan').classList.remove('hidden')"
            class="bg-gradient-to-r from-green-700 to-emerald-500
                   hover:scale-105 transition
                   text-white
                   px-8 py-4
                   rounded-xl
                   shadow-xl
                   font-semibold">

            + Tambah Pelatihan

        </button>

    </div>

</div>

<div class="bg-green-50 border border-green-200 rounded-2xl p-4 mb-6">

    <div class="flex items-center gap-3">

        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">

            ℹ️

        </div>

        <span class="text-green-700">

            Data berikut hanya menampilkan pelatihan yang pernah Anda ikuti.

        </span>

    </div>

</div>


    {{-- TABLE --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

    <div class="bg-gradient-to-r
                from-green-700
                to-emerald-500
                text-white
                px-8
                py-4">

        <h2 class="font-bold text-lg">

            Riwayat Pelatihan Saya

        </h2>

    </div>


    <div class="flex justify-between items-center px-8 py-5 bg-white border-b">

    <div class="text-gray-600">

        Total Pelatihan :
        <span class="font-bold text-green-700">

            {{ $pelatihans->count() }}

        </span>

    </div>

    <div class="relative">

        <input
            type="text"
            id="searchPelatihan"
            placeholder="Cari nama pelatihan..."
            class="w-80 rounded-xl border border-gray-300
                   pl-11 pr-4 py-3
                   focus:ring-2
                   focus:ring-green-500
                   focus:border-green-500">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5 absolute left-3 top-3.5 text-gray-400"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M21 21l-5-5m2-5a7 7 0 11-14 0a7 7 0 0114 0z"/>

        </svg>

    </div>

</div>

        <table class="w-full">

            <thead class="bg-white">

                <tr>

                    <th class="p-5 text-left w-20">
                        #
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

                <tr class="data-pelatihan border-b hover:bg-green-50 duration-200">

                    {{-- NO --}}
                    <td class="p-5">
                        {{ $loop->iteration }}
                    </td>

                    {{-- TANGGAL --}}
                    <td class="p-5">

                        {{ \Carbon\Carbon::parse($item->tanggal_pelatihan)->locale('id')->translatedFormat('d F Y') }}

                    </td>

                    {{-- NAMA --}}
                    <td class="nama-pelatihan p-5 font-medium text-slate-700">

                        {{ $item->nama_pelatihan }}

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
                               class="inline-flex
                                    items-center
                                    bg-green-100
                                    text-green-700
                                    px-4
                                    py-2
                                    rounded-lg
                                    font-semibold
                                    hover:bg-green-200"
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

                        {{ $item->lokasi }}

                    </td>

                    {{-- AKSI --}}
                    <td class="p-5">

                        <div class="flex justify-center">

                            <button
                                onclick="document.getElementById('editPelatihan{{ $item->id }}').classList.remove('hidden')"
                                class="bg-yellow-500
                                       hover:bg-yellow-600
                                       text-white
                                       px-4 py-2
                                       rounded-xl
                                       font-semibold">

                                Edit

                            </button>

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

            </tbody>

        </table>

            <div class="px-8 py-4 text-gray-500 text-sm">

                Menampilkan

                {{ $pelatihans->count() }}

                data pelatihan.

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

        <form action="{{ route('guru.pelatihan.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

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

<script>

document.getElementById('searchPelatihan').addEventListener('keyup', function(){

    let keyword = this.value.toLowerCase();

    let rows = document.querySelectorAll('.data-pelatihan');

    rows.forEach(function(row){

        let nama = row.querySelector('.nama-pelatihan').innerText.toLowerCase();

        if(nama.includes(keyword)){

            row.style.display='';

        }else{

            row.style.display='none';

        }

    });

});

</script>

@endsection
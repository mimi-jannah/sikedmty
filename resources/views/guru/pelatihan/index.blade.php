@extends('layouts.app')

@section('content')

<div class="p-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-5xl font-bold text-slate-800">
                Data Pelatihan
            </h1>

            <p class="text-gray-500 mt-2">
                Riwayat pelatihan guru & staff
            </p>

        </div>

        {{-- TOMBOL TAMBAH --}}
        <button
            onclick="document.getElementById('modalTambahPelatihan').classList.remove('hidden')"
            class="bg-gradient-to-r
                   from-green-700
                   to-emerald-500
                   text-white
                   px-6 py-3
                   rounded-xl
                   font-semibold
                   shadow-lg">

            Tambah Pelatihan +

        </button>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-green-50">

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

            <tbody>

                @forelse($pelatihans as $item)

                <tr class="border-t hover:bg-slate-50 transition">

                    {{-- NO --}}
                    <td class="p-5">
                        {{ $loop->iteration }}
                    </td>

                    {{-- TANGGAL --}}
                    <td class="p-5">

                        {{ \Carbon\Carbon::parse($item->tanggal_pelatihan)->locale('id')->translatedFormat('d F Y') }}

                    </td>

                    {{-- NAMA --}}
                    <td class="p-5 font-medium text-slate-700">

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

@endsection
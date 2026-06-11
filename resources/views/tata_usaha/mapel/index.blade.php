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
                Data mata pelajaran MTSS Thamrin Yahya
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
                          border-gray-300
                          focus:outline-none
                          focus:ring-2
                          focus:ring-green-500">
        </div>

    </div>

    {{-- TOOLBAR --}}
    <div class="flex items-center gap-3 mb-6">

        {{-- TAMBAH --}}
        <button
            onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="bg-gradient-to-r
                   from-green-700
                   to-emerald-500
                   text-white
                   px-5 py-3
                   rounded-xl
                   font-semibold
                   shadow">

            Tambah Mata Pelajaran +

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
                        Kelas
                    </th>

                    <th class="p-5 text-left">
                        Nama Mata Pelajaran
                    </th>

                    <th class="p-5 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($mapels as $item)

                <tr class="border-t hover:bg-slate-50 transition">

                    {{-- MODAL EDIT --}}
<div id="editModal{{ $item->id }}"
     class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-white rounded-3xl p-8 w-[600px] shadow-2xl">

        <h2 class="text-3xl font-bold text-yellow-600 mb-6">

            Edit Mata Pelajaran

        </h2>

        <form action="{{ route('tata-usaha.mapel.update', $item->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            {{-- KELAS --}}
            <div class="mb-5">

                <label class="font-semibold block mb-2">
                    Kelas
                </label>

                <select name="kelas"
                        required
                        class="w-full rounded-2xl border-gray-300">

                    @foreach($kelas as $kelasItem)

                        <option value="{{ $kelasItem->nama_kelas }}"
                            {{ $item->kelas == $kelasItem->nama_kelas ? 'selected' : '' }}>

                            {{ $kelasItem->nama_kelas }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- MAPEL --}}
            <div class="mb-6">

    <label class="font-semibold block mb-2">
        Nama Mata Pelajaran
    </label>

    <select name="nama_mapel"
            required
            class="w-full rounded-2xl border-gray-300">

        <optgroup label="Pendidikan Agama Islam">

            <option value="Al-Qur'an Hadis"
                {{ $item->nama_mapel == "Al-Qur'an Hadis" ? 'selected' : '' }}>
                Al-Qur'an Hadis
            </option>

            <option value="Akidah Akhlak"
                {{ $item->nama_mapel == "Akidah Akhlak" ? 'selected' : '' }}>
                Akidah Akhlak
            </option>

            <option value="Fikih"
                {{ $item->nama_mapel == "Fikih" ? 'selected' : '' }}>
                Fikih
            </option>

            <option value="Sejarah Kebudayaan Islam (SKI)"
                {{ $item->nama_mapel == "Sejarah Kebudayaan Islam (SKI)" ? 'selected' : '' }}>
                Sejarah Kebudayaan Islam (SKI)
            </option>

            <option value="Bahasa Arab"
                {{ $item->nama_mapel == "Bahasa Arab" ? 'selected' : '' }}>
                Bahasa Arab
            </option>

        </optgroup>

        <optgroup label="Mata Pelajaran Umum">

            <option value="Pendidikan Pancasila dan Kewarganegaraan (PPKn)"
                {{ $item->nama_mapel == "Pendidikan Pancasila dan Kewarganegaraan (PPKn)" ? 'selected' : '' }}>
                Pendidikan Pancasila dan Kewarganegaraan (PPKn)
            </option>

            <option value="Bahasa Indonesia"
                {{ $item->nama_mapel == "Bahasa Indonesia" ? 'selected' : '' }}>
                Bahasa Indonesia
            </option>

            <option value="Matematika"
                {{ $item->nama_mapel == "Matematika" ? 'selected' : '' }}>
                Matematika
            </option>

            <option value="Ilmu Pengetahuan Alam (IPA)"
                {{ $item->nama_mapel == "Ilmu Pengetahuan Alam (IPA)" ? 'selected' : '' }}>
                Ilmu Pengetahuan Alam (IPA)
            </option>

            <option value="Ilmu Pengetahuan Sosial (IPS)"
                {{ $item->nama_mapel == "Ilmu Pengetahuan Sosial (IPS)" ? 'selected' : '' }}>
                Ilmu Pengetahuan Sosial (IPS)
            </option>

            <option value="Bahasa Inggris"
                {{ $item->nama_mapel == "Bahasa Inggris" ? 'selected' : '' }}>
                Bahasa Inggris
            </option>

            <option value="Pendidikan Jasmani, Olahraga, dan Kesehatan (PJOK)"
                {{ $item->nama_mapel == "Pendidikan Jasmani, Olahraga, dan Kesehatan (PJOK)" ? 'selected' : '' }}>
                Pendidikan Jasmani, Olahraga, dan Kesehatan (PJOK)
            </option>

            <option value="Seni Budaya"
                {{ $item->nama_mapel == "Seni Budaya" ? 'selected' : '' }}>
                Seni Budaya
            </option>

            <option value="Informatika"
                {{ $item->nama_mapel == "Informatika" ? 'selected' : '' }}>
                Informatika
            </option>

            <option value="Prakarya"
                {{ $item->nama_mapel == "Prakarya" ? 'selected' : '' }}>
                Prakarya
            </option>

        </optgroup>

        <optgroup label="Muatan Lokal">

            <option value="Bahasa Melayu"
                {{ $item->nama_mapel == "Bahasa Melayu" ? 'selected' : '' }}>
                Bahasa Melayu
            </option>

            <option value="Baca Tulis Al-Qur'an (BTQ)"
                {{ $item->nama_mapel == "Baca Tulis Al-Qur'an (BTQ)" ? 'selected' : '' }}>
                Baca Tulis Al-Qur'an (BTQ)
            </option>

        </optgroup>

    </select>

</div>

            <div class="flex justify-end gap-3">

                <button type="button"
                        onclick="document.getElementById('editModal{{ $item->id }}').classList.add('hidden')"
                        class="bg-gray-200 px-5 py-3 rounded-xl">

                    Batal

                </button>

                <button type="submit"
                        class="bg-yellow-500
                               hover:bg-yellow-600
                               text-white
                               px-6 py-3
                               rounded-xl
                               font-semibold">

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>


                    {{-- NO --}}
                    <td class="p-5">

                        {{ $loop->iteration }}

                    </td>

                    {{-- KELAS --}}
                    <td class="p-5">

                        <span class="bg-blue-100
                                     text-blue-700
                                     px-4 py-2
                                     rounded-xl
                                     font-semibold">

                            {{ $item->kelas }}

                        </span>

                    </td>

                    {{-- MAPEL --}}
                    <td class="p-5 font-medium text-slate-700">

                        {{ $item->nama_mapel }}

                    </td>

                    {{-- AKSI --}}
                    <td class="p-5">

                        <div class="flex justify-center gap-2">

                            <button
                                onclick="document.getElementById('editModal{{ $item->id }}').classList.remove('hidden')"
    class="bg-yellow-500
           hover:bg-yellow-600
           text-white
           px-4 py-2
           rounded-xl
           font-semibold">

                                Edit

                            </button>

                            <form
                                action="{{ route('tata-usaha.mapel.destroy', $item->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin hapus data?')"
                                    class="bg-red-500
                                           hover:bg-red-600
                                           text-white
                                           px-4 py-2
                                           rounded-xl
                                           font-semibold">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4"
                        class="text-center
                               py-10
                               text-gray-400">

                        Belum ada data mata pelajaran

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- MODAL TAMBAH --}}
<div id="modalTambah"
     class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-white rounded-3xl p-8 w-[600px] shadow-2xl">

        <h2 class="text-3xl font-bold text-green-700 mb-6">

            Tambah Mata Pelajaran

        </h2>

        <form action="{{ route('tata-usaha.mapel.store') }}"
              method="POST">

            @csrf

            <div class="mb-5">

                <label class="font-semibold block mb-2">
                    Kelas
                </label>

                <select name="kelas"
        required
        class="w-full rounded-2xl border-gray-300">

    <option value="">
        Pilih Kelas
    </option>

    @foreach($kelas as $item)

        <option value="{{ $item->nama_kelas }}">

            {{ $item->nama_kelas }}

        </option>

    @endforeach

</select>

                       

            </div>

            <div class="mb-6">

                <label class="font-semibold block mb-2">
                    Nama Mata Pelajaran
                </label>

                <select name="nama_mapel"
        required
        class="w-full rounded-2xl border-gray-300">

    <option value="">
        Pilih Mata Pelajaran
    </option>

    <optgroup label="Pendidikan Agama Islam">

        <option>Al-Qur'an Hadis</option>
        <option>Akidah Akhlak</option>
        <option>Fikih</option>
        <option>Sejarah Kebudayaan Islam (SKI)</option>
        <option>Bahasa Arab</option>

    </optgroup>

    <optgroup label="Mata Pelajaran Umum">

        <option>Pendidikan Pancasila dan Kewarganegaraan (PPKn)</option>
        <option>Bahasa Indonesia</option>
        <option>Matematika</option>
        <option>Ilmu Pengetahuan Alam (IPA)</option>
        <option>Ilmu Pengetahuan Sosial (IPS)</option>
        <option>Bahasa Inggris</option>
        <option>Pendidikan Jasmani, Olahraga, dan Kesehatan (PJOK)</option>
        <option>Seni Budaya</option>
        <option>Informatika</option>
        <option>Prakarya</option>

    </optgroup>

    <optgroup label="Muatan Lokal">

        <option>Bahasa Melayu</option>
        <option>Baca Tulis Al-Qur'an (BTQ)</option>

    </optgroup>

</select>
            </div>

            <div class="flex justify-end gap-3">

                <button
                    type="button"
                    onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="bg-gray-200
                           px-5 py-3
                           rounded-xl">

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

@endsection
@extends('layouts.app')

@section('content')

<div class="max-w-[97%] mx-auto py-6">

    {{-- HEADER --}}
    <div class="flex
                flex-col lg:flex-row
                lg:items-start
                lg:justify-between
                gap-6
                mb-8">

        {{-- TITLE --}}
        <div>

            <h1 class="text-3xl
                       font-bold
                       text-gray-900
                       mb-2">

                Data Kinerja

            </h1>

            <p class="text-lg text-gray-500">

                Monitoring aktivitas guru/staff

            </p>

        </div>

        {{-- JAM --}}
        <div class="bg-white
                    rounded-2xl
                    shadow-lg
                    px-5 py-4
                    min-w-[220px]">

            <div class="flex items-center gap-3 mb-2">

                <div class="w-10
                            h-10
                            rounded-full
                            border-4
                            border-green-600
                            flex
                            items-center
                            justify-center">

                    <span class="text-green-600 text-xl">

                        🕒

                    </span>

                </div>

                <h1 class="text-3xl
                           font-bold
                           text-green-700">

                    {{ now()->translatedFormat('H:i') }}

                </h1>

            </div>

            <p class="text-gray-700 text-sm">

                {{ now()->translatedFormat('l, d F Y') }}

            </p>

        </div>

    </div>

    {{-- CARD --}}
    <div class="grid
            grid-cols-1
            lg:grid-cols-2
            gap-4
            mb-6">

    {{-- PELATIHAN --}}
    <div class="bg-gradient-to-r
                from-black
                to-gray-900
                rounded-2xl
                shadow-xl
                p-4
                text-white
                h-[150px]
                flex
                items-center">

        <div class="flex items-center gap-4">

            <div class="w-16
                        h-16
                        bg-gray-800
                        rounded-2xl
                        flex
                        items-center
                        justify-center
                        text-3xl">

                📖

            </div>

            <div>

                <p class="text-xl font-semibold mb-1">

                    Pelatihan

                </p>

                <div class="flex items-end gap-2">

                    <h1 class="text-4xl font-bold leading-none">

                        04 / 22

                    </h1>

                    <span class="text-base text-gray-300 mb-1">

                        guru/staff

                    </span>

                </div>

            </div>

        </div>

    </div>

    {{-- KINERJA --}}
    <div class="bg-white
                rounded-2xl
                shadow-xl
                p-4
                h-[150px]
                flex
                items-center">

        <div class="flex items-center gap-4">

            <div class="w-16
                        h-16
                        bg-green-100
                        rounded-2xl
                        flex
                        items-center
                        justify-center
                        text-3xl">

                📊

            </div>

            <div>

                <p class="text-xl
                          font-semibold
                          text-gray-800
                          mb-1">

                    Kinerja

                </p>

                <div class="flex items-end gap-2">

                    <h1 class="text-4xl
                               font-bold
                               text-green-700
                               leading-none">

                        {{ $kinerjas->count() }}/22

                    </h1>

                    <span class="text-base
                                 text-gray-500
                                 mb-1">

                        guru/staff

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

    {{-- TOOLBAR --}}
    <div class="flex
                flex-col lg:flex-row
                lg:items-center
                lg:justify-between
                gap-5
                mb-5">

        {{-- BUTTON --}}
        <div class="flex flex-wrap gap-3">

            {{-- EXPORT --}}
            <button class="bg-gradient-to-r
                           from-green-700
                           to-emerald-500
                           text-white
                           px-5 py-2.5
                           rounded-xl
                           font-bold
                           text-sm
                           shadow-lg
                           hover:scale-105
                           transition">

                ⬇ Ekspor

            </button>

            {{-- TAMBAH --}}
<button onclick="toggleForm()"
        class="bg-gradient-to-r
               from-green-700
               to-emerald-500
               text-white
               px-5 py-2.5
               rounded-xl
               font-bold
               text-sm
               shadow-lg
               hover:scale-105
               transition">

    Tambah Data Pelatihan +

</button>

            {{-- EDIT --}}
            <button class="bg-gray-200
                           text-gray-400
                           px-5 py-2.5
                           rounded-xl
                           font-bold
                           text-sm">

                Edit

            </button>

            {{-- HAPUS --}}
            <button class="bg-gray-200
                           text-gray-400
                           px-5 py-2.5
                           rounded-xl
                           font-bold
                           text-sm">

                Hapus

            </button>

        </div>

        {{-- SEARCH --}}
        <div>

            <input type="text"
                   placeholder="Cari tanggal pelatihan..."
                   class="w-full lg:w-80
                          rounded-xl
                          border-gray-300
                          px-5 py-3
                          text-sm
                          shadow-sm">

        </div>

    </div>

    {{-- FORM TAMBAH --}}
<div id="formTambah"
     class="hidden
            bg-white
            rounded-3xl
            shadow-xl
            p-6
            mb-8">

    <h1 class="text-2xl
               font-bold
               text-gray-800
               mb-6">

        Tambah Data Pelatihan

    </h1>

    <form action="{{ route('tata-usaha.kinerja.store') }}"
      method="POST">

    @csrf

        <div class="grid
                    grid-cols-1
                    md:grid-cols-2
                    gap-5">

            {{-- TANGGAL --}}
            <div>

                <label class="font-semibold">

                    Tanggal Pelatihan

                </label>

                <input type="date"
                        name="tanggal"
                       class="w-full
                              mt-2
                              rounded-xl
                              border-gray-300">

            </div>

            {{-- GURU --}}
            <div>

                <label class="font-semibold">

                    Guru/Staff

                </label>

                <input type="text"
                        name="guru_staff"
                       placeholder="Nama guru/staff"
                       class="w-full
                              mt-2
                              rounded-xl
                              border-gray-300">

            </div>

            {{-- NAMA --}}
            <div class="md:col-span-2">

                <label class="font-semibold">

                    Nama Pelatihan

                </label>

                <input type="text"
                        name="nama_pelatihan"
                       placeholder="Masukkan nama pelatihan"
                       class="w-full
                              mt-2
                              rounded-xl
                              border-gray-300">

            </div>

            {{-- DESKRIPSI --}}
            <div class="md:col-span-2">

                <label class="font-semibold">

                    Deskripsi Pelatihan

                </label>

                <textarea name="deskripsi"
                          placeholder="Masukkan deskripsi pelatihan"
                          class="w-full
                                 mt-2
                                 rounded-xl
                                 border-gray-300"></textarea>

            </div>

            {{-- PENYELENGGARA --}}
            <div>

                <label class="font-semibold">

                    Penyelenggara

                </label>

                <input type="text"
                        name="penyelenggara"
                       placeholder="Masukkan penyelenggara"
                       class="w-full
                              mt-2
                              rounded-xl
                              border-gray-300">

            </div>

            {{-- LOKASI --}}
            <div>

                <label class="font-semibold">

                    Lokasi

                </label>

                <div class="flex gap-5 mt-4">

                    <label>

                        <input type="radio"
                            name="lokasi"
                            value="Sekolah">

                        Sekolah

                    </label>

                    <label>

                        <input type="radio"
                            name="lokasi"
                            value="Luar Sekolah">

                        Luar Sekolah

                    </label>

                </div>

            </div>

        </div>

        {{-- BUTTON --}}
        <button type="submit"
                class="w-full
                       mt-8
                       bg-gradient-to-r
                       from-black
                       to-gray-900
                       text-white
                       py-4
                       rounded-2xl
                       font-bold">

            Tambah

        </button>

    </form>

</div>




    {{-- TABLE --}}
    <div class="bg-white
                rounded-3xl
                shadow-xl
                overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                {{-- HEAD --}}
                <thead class="bg-white">

<tr class="border-b border-gray-200">

    <th class="p-4">
        <input type="checkbox">
    </th>

    <th class="p-4 text-left">Tanggal Pelatihan</th>

    <th class="p-4 text-left">Guru/Staff</th>

    <th class="p-4 text-left">Nama Pelatihan</th>

    <th class="p-4 text-left">Deskripsi Pelatihan</th>

    <th class="p-4 text-left">Penyelenggara</th>

    <th class="p-4 text-left">Lokasi</th>

</tr>

</thead>

                {{-- BODY --}}
                <tbody>

@if($kinerjas->count() > 0)

    @foreach($kinerjas as $kinerja)

    <tr class="border-b border-gray-200 hover:bg-gray-50">

        {{-- CHECKBOX --}}
        <td class="p-4">

            <input type="checkbox"
                   class="w-4 h-4 rounded border-gray-300">

        </td>

        {{-- TANGGAL --}}
        <td class="p-4 font-semibold text-gray-700">

            {{ \Carbon\Carbon::parse($kinerja->tanggal)->format('d-m-Y') }}

        </td>

        {{-- GURU STAFF --}}
        <td class="p-4 text-gray-700">

            {{ $kinerja->user->name ?? '-' }}

        </td>

        {{-- NAMA PELATIHAN --}}
        <td class="p-4 text-gray-700">

            {{ $kinerja->judul }}

        </td>

        {{-- DESKRIPSI --}}
        <td class="p-4 text-gray-600">

            {{ $kinerja->deskripsi }}

        </td>

        {{-- PENYELENGGARA --}}
        <td class="p-4 text-gray-700">

            Perpustakaan Nasional

        </td>

        {{-- LOKASI --}}
        <td class="p-4 text-gray-700">

            Sekolah

        </td>

    </tr>

    @endforeach

@else

<tr>

    <td colspan="7"
        class="text-center py-16 text-gray-400 text-2xl">

        Belum ada data kinerja

    </td>

</tr>

@endif

</tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="flex items-center gap-2 p-4">

            <button class="w-10
                           h-10
                           rounded-xl
                           border">

                <

            </button>

            <button class="w-10
                           h-10
                           rounded-xl
                           bg-green-700
                           text-white
                           font-bold">

                1

            </button>

            <button class="w-10
                           h-10
                           rounded-xl
                           border">

                2

            </button>

            <button class="w-10
                           h-10
                           rounded-xl
                           border">

                3

            </button>

            <button class="w-10
                           h-10
                           rounded-xl
                           border">

                >

            </button>

        </div>

    </div>

</div>

<script>

function toggleForm() {

    const form = document.getElementById('formTambah');

    form.classList.toggle('hidden');

}

</script>

@endsection
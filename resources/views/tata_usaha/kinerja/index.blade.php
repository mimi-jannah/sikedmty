@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-6">

    {{-- HEADER --}}
    <div class="bg-white rounded-3xl shadow-lg p-8 mb-8">

        <div class="flex flex-col lg:flex-row justify-between items-center gap-6">

            {{-- ICON + TITLE --}}
            <div class="flex items-center gap-5">

                <div class="w-24 h-24 rounded-3xl
                            bg-green-100
                            flex items-center justify-center
                            shadow-inner">

                    <span class="text-5xl">

                        📋

                    </span>

                </div>

                <div>

                    <h1 class="text-5xl font-bold text-slate-800">

                        Data Kinerja

                    </h1>

                    <p class="text-slate-500 text-lg mt-2">

                        Monitoring penilaian kinerja guru & staff
                        MTSS Thamrin Yahya

                    </p>

                </div>

            </div>

            {{-- BUTTON --}}
            <button
                onclick="toggleForm()"
                class="px-8 py-4
                       rounded-2xl
                       bg-gradient-to-r
                       from-green-700
                       to-emerald-500
                       text-white
                       font-semibold
                       shadow-lg
                       hover:scale-105
                       transition">

                + Tambah Form Penilaian

            </button>

        </div>

    </div>


    {{-- CARD STATISTIK --}}
    <div class="grid
                grid-cols-1
                md:grid-cols-2
                xl:grid-cols-4
                gap-6
                mb-8">

        {{-- TOTAL FORM --}}
        <div class="bg-white
                    rounded-2xl
                    shadow-md
                    p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500">

                        Total Form

                    </p>

                    <h1 class="text-4xl
                               font-bold
                               text-green-700
                               mt-2">

                        {{ $kinerjas->count() }}

                    </h1>

                    <span class="text-gray-400">

                        Form

                    </span>

                </div>

                <div class="w-16 h-16
                            rounded-2xl
                            bg-green-100
                            flex items-center justify-center
                            text-3xl">

                    📄

                </div>

            </div>

        </div>



        {{-- GURU --}}
        <div class="bg-white
                    rounded-2xl
                    shadow-md
                    p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500">

                        Guru Dinilai

                    </p>

                    <h1 class="text-4xl
                               font-bold
                               text-green-700
                               mt-2">

                        {{ $kinerjas->pluck('user_id')->unique()->count() }}

                    </h1>

                    <span class="text-gray-400">

                        Guru

                    </span>

                </div>

                <div class="w-16 h-16
                            rounded-2xl
                            bg-green-100
                            flex items-center justify-center
                            text-3xl">

                    👨‍🏫

                </div>

            </div>

        </div>

        {{-- TAHUN --}}
        <div class="bg-white
                    rounded-2xl
                    shadow-md
                    p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500">

                        Tahun

                    </p>

                    <h1 class="text-4xl
                               font-bold
                               text-green-700
                               mt-2">

                        {{ now()->year }}

                    </h1>

                    <span class="text-gray-400">

                        Aktif

                    </span>

                </div>

                <div class="w-16 h-16
                            rounded-2xl
                            bg-green-100
                            flex items-center justify-center
                            text-3xl">

                    📅

                </div>

            </div>

        </div>



        {{-- STATUS --}}
        <div class="bg-white
                    rounded-2xl
                    shadow-md
                    p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-500">

                        Status

                    </p>

                    <h1 class="text-4xl
                               font-bold
                               text-green-700
                               mt-2">

                        Aktif

                    </h1>

                    <span class="text-gray-400">

                        Penilaian

                    </span>

                </div>

                <div class="w-16 h-16
                            rounded-2xl
                            bg-green-100
                            flex items-center justify-center
                            text-3xl">

                    ✅

                </div>

            </div>

        </div>

    </div>

{{-- ========================= --}}
{{-- FORM TAMBAH PENILAIAN --}}
{{-- ========================= --}}

<div id="formTambah"
     class="hidden
            bg-white
            rounded-3xl
            shadow-xl
            p-8
            mb-8">

    <h2 class="text-3xl font-bold text-slate-800 mb-8">

        Tambah Form Penilaian Kinerja

    </h2>

    <form action="{{ route('tu.kinerja.store') }}" method="POST">

    @csrf

        {{-- INFORMASI FORM --}}
        <div class="bg-slate-50 rounded-2xl p-6 mb-8">

            <h3 class="font-bold text-lg mb-5">

                Informasi Form

            </h3>

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <label class="font-semibold">

                        Nama Form

                    </label>

                    <input
                        type="text"
                        name="nama_form"
                        class="w-full rounded-xl border-gray-300"
                        placeholder="Masukkan nama form penilaian"
                        required>

                </div>

                <div>

                    <label class="font-semibold">

                        Semester

                    </label>

                   <select
                        name="semester"
                        class="w-full rounded-xl border-gray-300"
                        required>

                        <option value="">-- Pilih Semester --</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>

                    </select>

                </div>

                <div>

                    <label class="font-semibold">

                        Tahun Ajaran

                    </label>

                    <select
                        name="tahun_ajaran"
                        class="w-full rounded-xl border-gray-300"
                        required>

                        <option value="">-- Pilih Tahun Ajaran --</option>
                        <option value="2025/2026">2025/2026</option>
                        <option value="2026/2027">2026/2027</option>

                    </select>

                </div>

                <div>

                    <label class="font-semibold">

                        Keterangan

                    </label>

                    <textarea
                        name="keterangan"
                        rows="3"
                        class="w-full rounded-xl border-gray-300"
                        placeholder="Masukkan keterangan (opsional)">
                    </textarea>
                </div>

            </div>

        </div>

        {{-- INDIKATOR --}}
        <div class="bg-slate-50 rounded-2xl p-6">

            <div class="flex justify-between items-center mb-5">

                <h3 class="font-bold text-lg">

                    Indikator Penilaian

                </h3>

                <button
                    type="button"
                    onclick="tambahBaris()"
                    class="bg-green-600
                           hover:bg-green-700
                           text-white
                           px-4
                           py-2
                           rounded-lg">

                    + Tambah Indikator

                </button>

            </div>

            <table class="w-full">

                <thead class="bg-green-100">

                    <tr>

                        <th class="py-3">No</th>

                        <th>Nama Indikator</th>

                        <th>Bobot (%)</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody id="indikatorBody">

                    <tr>

                        <td class="text-center">1</td>

                        <td>

                            <input
                                type="text"
                                name="nama_form"
                                class="w-full rounded-xl border-gray-300">

                        </td>

                        <td>

                            <input
                                type="number"
                                class="w-full rounded-lg border-gray-300">

                        </td>

                        <td class="text-center">

    <button
        type="button"
        onclick="hapusBaris(this)"
        class="bg-red-500
               hover:bg-red-600
               text-white
               px-4
               py-2
               rounded-xl
               font-medium
               shadow
               transition">

        Hapus

    </button>

</td>

                    </tr>

                </tbody>

            </table>

        </div>

        <div class="flex justify-end gap-3 mt-8">

            <button
                type="button"
                onclick="toggleForm()"
                class="px-6 py-3 bg-gray-300 rounded-xl">

                Batal

            </button>

            <button
                class="px-6 py-3
                       bg-gradient-to-r
                       from-green-700
                       to-emerald-500
                       text-white
                       rounded-xl">

                Simpan Form

            </button>

        </div>

    </form>

</div>





  {{-- ========================= --}}
{{-- TOOLBAR --}}
{{-- ========================= --}}

<div class="bg-white
            rounded-3xl
            shadow-lg
            overflow-hidden
            mb-8">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r
                from-green-700
                to-emerald-500
                px-8
                py-5">

        <h2 class="text-2xl
                   font-bold
                   text-white">

            Daftar Form Penilaian

        </h2>

    </div>

    {{-- FILTER --}}
    <div class="p-6">

        <div class="grid
                    grid-cols-1
                    md:grid-cols-2
                    lg:grid-cols-4
                    gap-4">

            {{-- SEARCH --}}
            <div>

                <input
                    id="searchKinerja"
                    type="text"
                    placeholder="Cari nama pelatihan..."
                    class="w-full
                            rounded-xl
                            border-gray-300
                            px-5
                            py-3">

            </div>

            {{-- SEMESTER --}}
            <div>

                <select
                    id="filterSemester"
                    class="w-full
                           rounded-xl
                           border-gray-300
                           px-4
                           py-3
                           focus:ring-green-600
                           focus:border-green-600">

                    <option>Semua Semester</option>

                    <option>Ganjil</option>

                    <option>Genap</option>

                </select>

            </div>

            {{-- STATUS --}}
            <div>

                <select
                    id="filterStatus"
                    class="w-full
                           rounded-xl
                           border-gray-300
                           px-4
                           py-3
                           focus:ring-green-600
                           focus:border-green-600">

                    <option>Semua Status</option>

                    <option>Aktif</option>

                    <option>Draft</option>

                    <option>Nonaktif</option>

                </select>

            </div>

            {{-- BUTTON --}}
            <div>

                <button
                    id="btnFilter"
                    class="w-full
                           bg-green-700
                           hover:bg-green-800
                           text-white
                           rounded-xl
                           py-3
                           font-semibold
                           transition">

                    Filter

                </button>

            </div>

        </div>

    </div>

</div>




    {{-- TABLE --}}
    <div class="bg-white
                rounded-3xl
                shadow-xl
                overflow-hidden">

        <div
class="overflow-x-auto
rounded-b-3xl">

            <table class="w-full">

    {{-- HEADER --}}
    <thead
        class="bg-gradient-to-r
               from-green-700
               to-emerald-500
               text-white">

        <tr>

            <th class="px-6 py-4 text-center w-16">

                No

            </th>

            <th class="px-6 py-4 text-left">

                Guru / Staff

            </th>

            <th class="px-6 py-4 text-left">

                Nama Pelatihan

            </th>

            <th class="px-6 py-4 text-left">

                Tanggal

            </th>

            <th class="px-6 py-4 text-left">

                Penyelenggara

            </th>

            <th class="px-6 py-4 text-center">

                Lokasi

            </th>

            <th class="px-6 py-4 text-center">

                Status

            </th>

            <th class="px-6 py-4 text-center">

                Aksi

            </th>

        </tr>

    </thead>



    {{-- BODY --}}
    <tbody>

@forelse($kinerjas as $item)

        <tr
        class="kinerja-row
        border-b
       hover:bg-green-50">

    {{-- NO --}}
    <td class="px-6 py-5 text-center">

        {{ $loop->iteration }}

    </td>



    {{-- GURU --}}
    <td class="px-6 py-5">

        <div class="flex items-center gap-3">

            <div
            class="w-11
                   h-11
                   rounded-full
                   bg-green-100
                   flex
                   items-center
                   justify-center
                   font-bold
                   text-green-700">

                {{ strtoupper(substr($item->user->name ?? '-',0,1)) }}

            </div>

            <div>

                <p class="font-semibold text-slate-700">

                    {{ $item->user->name ?? '-' }}

                </p>

            </div>

        </div>

    </td>



    {{-- PELATIHAN --}}
    <td class="px-6 py-5">

        <div class="nama-pelatihan font-semibold text-slate-700">

            {{ $item->judul }}

        </div>

        <div class="text-sm text-gray-400">

            {{ Str::limit($item->deskripsi,40) }}

        </div>

    </td>



    {{-- TANGGAL --}}
    <td class="px-6 py-5">

        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}

    </td>



    {{-- PENYELENGGARA --}}
    <td class="px-6 py-5">

        Perpustakaan Nasional

    </td>



    {{-- LOKASI --}}
    <td class="px-6 py-5 text-center">

        <span
        class="bg-green-100
               text-green-700
               px-4
               py-2
               rounded-full
               text-sm
               font-semibold">

            Sekolah

        </span>

    </td>



    {{-- STATUS --}}
    <td class="px-6 py-5 text-center">

        <span
        class="bg-green-100
               text-green-700
               px-4
               py-2
               rounded-full
               text-sm
               font-semibold">

            Aktif

        </span>

    </td>



    {{-- AKSI --}}
    <td class="px-6 py-5">

        <div class="flex justify-center gap-2">

            {{-- DETAIL --}}
            <button
            class="w-10
                   h-10
                   rounded-xl
                   bg-blue-500
                   hover:bg-blue-600
                   text-white">

                👁

            </button>

            {{-- EDIT --}}
            <button
            class="w-10
                   h-10
                   rounded-xl
                   bg-yellow-400
                   hover:bg-yellow-500
                   text-white">

                ✏

            </button>

            {{-- HAPUS --}}
            <button
            class="w-10
                   h-10
                   rounded-xl
                   bg-red-500
                   hover:bg-red-600
                   text-white">

                🗑

            </button>

        </div>

    </td>

</tr>

@empty

<tr>

<td
colspan="8"
class="text-center
       py-20">

    <div
    class="flex
           flex-col
           items-center">

        <div
        class="w-24
               h-24
               rounded-full
               bg-green-100
               flex
               items-center
               justify-center
               text-5xl">

            📋

        </div>

        <h2
        class="text-2xl
               font-bold
               text-slate-700
               mt-5">

            Belum Ada Data

        </h2>

        <p
        class="text-gray-500
               mt-2">

            Data kinerja belum tersedia.

        </p>

    </div>

</td>

</tr>

@endforelse

</tbody>

</table>

        {{-- PAGINATION --}}
        <div class="flex
            justify-between
            items-center
            px-8
            py-5
            bg-slate-50
            border-t">

    <div class="text-gray-500">

        Menampilkan

        <span class="font-semibold">

            {{ $kinerjas->count() }}

        </span>

        data kinerja

    </div>

    <div class="flex gap-2">

        <button
        class="w-10
               h-10
               rounded-xl
               border
               hover:bg-gray-100">

            <

        </button>

        <button
        class="w-10
               h-10
               rounded-xl
               bg-green-700
               text-white">

            1

        </button>

        <button
        class="w-10
               h-10
               rounded-xl
               border
               hover:bg-gray-100">

            >

        </button>

    </div>

</div>

<script>

function toggleForm() {

    const form = document.getElementById('formTambah');

    form.classList.toggle('hidden');

}

</script>

<script>

let nomor = 1;

function tambahBaris(){

    nomor++;

    let tbody = document.getElementById("indikatorBody");

    tbody.innerHTML += `
        <tr class="border-b hover:bg-gray-50">

            <td class="text-center py-4 font-semibold">

                ${nomor}

            </td>

            <td class="px-3 py-3">

                <input
                    type="text"
                    placeholder="Masukkan nama indikator"
                    class="w-full rounded-xl border-gray-300">

            </td>

            <td class="px-3 py-3">

                <input
                    type="number"
                    value="20"
                    class="w-full rounded-xl border-gray-300">

            </td>

            <td class="text-center">

                <button
                    type="button"
                    onclick="hapusBaris(this)"
                    class="bg-red-500
                           hover:bg-red-600
                           text-white
                           px-4
                           py-2
                           rounded-xl
                           font-medium
                           shadow
                           transition">

                    Hapus

                </button>

            </td>

        </tr>
    `;

function hapusBaris(button){

    button.closest("tr").remove();

    updateNomor();

}

function updateNomor(){

    let rows = document.querySelectorAll("#indikatorBody tr");

    nomor = rows.length;

    rows.forEach(function(row,index){

        row.cells[0].innerHTML = index + 1;

    });

}

}
</script>

<script>

document.getElementById("searchKinerja")
.addEventListener("keyup",function(){

    let keyword=this.value.toLowerCase();

    let rows=document.querySelectorAll(".kinerja-row");

    rows.forEach(function(row){

        let nama=row
        .querySelector(".nama-pelatihan")
        .innerText
        .toLowerCase();

        let guru=row
        .querySelector(".nama-guru")
        .innerText
        .toLowerCase();

        if(
            nama.includes(keyword) ||
            guru.includes(keyword)
        ){

            row.style.display="";

        }else{

            row.style.display="none";

        }

    });

});

</script>



@endsection
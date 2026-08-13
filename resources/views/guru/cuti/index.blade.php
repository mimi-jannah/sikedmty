@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-10">

        <h1 class="text-5xl font-bold text-gray-800 mb-3">
            Data Cuti
        </h1>

        <p class="text-gray-500 text-lg">
            Pengajuan Cuti Guru/Staff
        </p>

    </div>


    {{-- ========================================= --}}
    {{-- INFORMASI SISA CUTI --}}
    {{-- ========================================= --}}

    <div class="bg-white rounded-3xl shadow-xl p-8 mb-10">

        <h2 class="text-3xl font-bold text-green-700 mb-6">
            Informasi Cuti Tahunan
        </h2>

        <div class="grid md:grid-cols-3 gap-6">

            {{-- JATAH --}}
            <div class="bg-green-50 rounded-2xl p-6">

                <p class="text-gray-500 mb-2">
                    Jatah Cuti Tahunan
                </p>

                <p class="text-4xl font-bold text-green-700">
                    {{ $jatahCuti ?? 12 }}
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    Hari
                </p>

            </div>


            {{-- TERPAKAI --}}
            <div class="bg-yellow-50 rounded-2xl p-6">

                <p class="text-gray-500 mb-2">
                    Cuti Terpakai
                </p>

                <p class="text-4xl font-bold text-yellow-600">
                    {{ $cutiTerpakai ?? 0 }}
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    Hari
                </p>

            </div>


            {{-- SISA --}}
            <div class="bg-blue-50 rounded-2xl p-6">

                <p class="text-gray-500 mb-2">
                    Sisa Cuti
                </p>

                <p class="text-4xl font-bold text-blue-600">
                    {{ $sisaCuti ?? 12 }}
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    Hari
                </p>

            </div>

        </div>


        {{-- INFORMASI --}}
        @if(($sisaCuti ?? 12) <= 0)

            <div class="mt-6 bg-red-50 border border-red-200 rounded-2xl p-5">

                <div class="flex items-start gap-4">

                    <div class="text-red-600 text-2xl">
                        ⚠️
                    </div>

                    <div>

                        <h3 class="font-bold text-red-700 text-lg">
                            Jatah Cuti Tahunan Sudah Habis
                        </h3>

                        <p class="text-red-600 mt-1">
                            Anda sudah menggunakan seluruh jatah cuti tahunan
                            sebanyak {{ $jatahCuti ?? 12 }} hari.
                            Pengajuan cuti tahunan tidak dapat dilakukan lagi.
                        </p>

                    </div>

                </div>

            </div>

        @else

            <div class="mt-6 bg-green-50 border border-green-200 rounded-2xl p-5">

                <p class="text-green-700">

                    <strong>Informasi:</strong>
                    Anda masih memiliki
                    <strong>{{ $sisaCuti ?? 12 }} hari</strong>
                    sisa cuti tahunan.

                </p>

            </div>

        @endif

    </div>



    {{-- ========================================= --}}
    {{-- FORM PENGAJUAN --}}
    {{-- ========================================= --}}

    <div class="bg-white rounded-3xl shadow-xl p-8 mb-10">

        <h2 class="text-3xl font-bold text-green-700 mb-8">
            Ajukan Cuti
        </h2>


        {{-- ERROR --}}
        @if(session('error'))

            <div class="bg-red-50
                        border
                        border-red-200
                        text-red-700
                        rounded-2xl
                        p-5
                        mb-6">

                {{ session('error') }}

            </div>

        @endif


        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="bg-green-50
                        border
                        border-green-200
                        text-green-700
                        rounded-2xl
                        p-5
                        mb-6">

                {{ session('success') }}

            </div>

        @endif


        @if(($sisaCuti ?? 12) <= 0)

            {{-- FORM DINONAKTIFKAN --}}
            <div class="bg-gray-50
                        border
                        border-gray-200
                        rounded-2xl
                        p-8
                        text-center">

                <div class="text-4xl mb-4">
                    🔒
                </div>

                <h3 class="text-xl font-bold text-gray-700 mb-2">
                    Pengajuan Cuti Tidak Tersedia
                </h3>

                <p class="text-gray-500">
                    Jatah cuti tahunan Anda sudah habis.
                    Silakan mengajukan kembali apabila telah memperoleh
                    jatah cuti pada periode berikutnya.
                </p>

            </div>

        @else

            {{-- FORM NORMAL --}}
            <form action="{{ route('guru.cuti.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                {{-- JENIS + TANGGAL MULAI --}}
                <div class="grid md:grid-cols-2 gap-6 mb-6">

                    <div>

                        <label class="font-semibold block mb-2">
                            Jenis Cuti
                        </label>

                        <select name="jenis"
                                id="jenis"
                                required
                                class="w-full rounded-2xl border-gray-300">

                            <option value="">
                                Pilih Jenis
                            </option>

                            <option value="Izin">
                                Izin
                            </option>

                            <option value="Sakit">
                                Sakit
                            </option>

                            <option value="Cuti">
                                Cuti
                            </option>

                        </select>

                    </div>


                    <div>

                        <label class="font-semibold block mb-2">
                            Tanggal Mulai
                        </label>

                        <input type="date"
                               name="tanggal_mulai"
                               id="tanggal_mulai"
                               required
                               class="w-full rounded-2xl border-gray-300">

                    </div>

                </div>


                {{-- TANGGAL SELESAI --}}
                <div class="mb-6">

                    <label class="font-semibold block mb-2">
                        Tanggal Selesai
                    </label>

                    <input type="date"
                           name="tanggal_selesai"
                           id="tanggal_selesai"
                           required
                           class="w-full rounded-2xl border-gray-300">

                </div>


                {{-- ALASAN --}}
                <div class="mb-6">

                    <label class="font-semibold block mb-2">
                        Alasan
                    </label>

                    <textarea name="alasan"
                              rows="5"
                              required
                              class="w-full rounded-2xl border-gray-300"></textarea>

                </div>


                {{-- SURAT --}}
                <div class="mb-8">

                    <label class="font-semibold block mb-2">
                        Upload Surat
                    </label>

                    <input type="file"
                           name="surat"
                           accept=".pdf,.jpg,.jpeg,.png">

                    <p class="text-sm text-gray-400 mt-2">
                        Format yang diperbolehkan: PDF, JPG, JPEG, PNG.
                    </p>

                </div>


                {{-- TOMBOL --}}
                <button type="submit"
                        class="bg-gradient-to-r
                               from-green-700
                               to-emerald-500
                               text-white
                               px-8 py-4
                               rounded-2xl
                               font-bold
                               hover:opacity-90
                               transition">

                    Kirim Pengajuan

                </button>

            </form>

        @endif

    </div>



    {{-- ========================================= --}}
    {{-- RIWAYAT CUTI --}}
    {{-- ========================================= --}}

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <div class="bg-gradient-to-r
                    from-green-700
                    to-emerald-500
                    px-8 py-6">

            <h2 class="text-3xl font-bold text-white">
                Riwayat Cuti
            </h2>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-green-50">

                    <tr>

                        <th class="p-5 text-left">
                            Jenis
                        </th>

                        <th class="p-5 text-left">
                            Tanggal
                        </th>

                        <th class="p-5 text-left">
                            Alasan
                        </th>

                        <th class="p-5 text-left">
                            Surat
                        </th>

                        <th class="p-5 text-left">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($cutis as $cuti)

                        <tr class="border-t hover:bg-gray-50">


                            {{-- JENIS --}}
                            <td class="p-5">

                                <span class="bg-green-100
                                             text-green-700
                                             px-4 py-2
                                             rounded-2xl
                                             font-semibold">

                                    {{ $cuti->jenis }}

                                </span>

                            </td>


                            {{-- TANGGAL --}}
                            <td class="p-5 whitespace-nowrap">

                                {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->translatedFormat('d F Y') }}

                                -

                                {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->translatedFormat('d F Y') }}

                            </td>


                            {{-- ALASAN --}}
                            <td class="p-5">

                                {{ $cuti->alasan }}

                            </td>


                            {{-- SURAT --}}
                            <td class="p-5">

                                @if($cuti->surat)

                                    <a href="{{ asset('surat-cuti/'.$cuti->surat) }}"
                                       target="_blank"
                                       class="bg-yellow-500
                                              hover:bg-yellow-600
                                              text-white
                                              px-4 py-2
                                              rounded-2xl
                                              font-semibold
                                              transition">

                                        Lihat Surat

                                    </a>

                                @else

                                    <span class="text-gray-400">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- STATUS --}}
                            <td class="p-5">

                                @if($cuti->status == 'Menunggu')

                                    <span class="bg-yellow-100
                                                 text-yellow-700
                                                 px-6 py-3
                                                 rounded-full
                                                 font-semibold">

                                        Menunggu

                                    </span>


                                @elseif($cuti->status == 'Ditolak')

                                    <span class="bg-red-100
                                                 text-red-600
                                                 px-6 py-3
                                                 rounded-full
                                                 font-semibold">

                                        Ditolak

                                    </span>


                                @elseif($cuti->status == 'Disetujui')

                                    <span class="bg-green-100
                                                 text-green-700
                                                 px-6 py-3
                                                 rounded-full
                                                 font-semibold">

                                        Disetujui

                                    </span>


                                @else

                                    <span class="bg-gray-100
                                                 text-gray-700
                                                 px-6 py-3
                                                 rounded-full
                                                 font-semibold">

                                        {{ $cuti->status }}

                                    </span>

                                @endif

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="5"
                                class="text-center p-10 text-gray-500">

                                Belum ada pengajuan cuti.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
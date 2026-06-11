@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    <h1 class="text-5xl font-bold text-gray-800 mb-3">

        Data Perizinan

    </h1>

    <p class="text-gray-500 text-lg mb-10">

        Pengajuan Perizinan Guru/Staff

    </p>

    {{-- FORM --}}
    <div class="bg-white rounded-3xl shadow-xl p-8 mb-10">

        <h2 class="text-3xl font-bold text-green-700 mb-8">

            Ajukan Perizinan

        </h2>

        <form action="{{ route('guru.cuti.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="grid md:grid-cols-2 gap-6 mb-6">

                <div>

                    <label class="font-semibold block mb-2">

                        Jenis Perizinan

                    </label>

                    <select name="jenis"
                            required
                            class="w-full rounded-2xl border-gray-300">

                        <option value="">Pilih Jenis</option>

                        <option value="Izin">Izin</option>

                        <option value="Sakit">Sakit</option>

                        <option value="Cuti">Cuti</option>

                    </select>

                </div>

                <div>

                    <label class="font-semibold block mb-2">

                        Tanggal Mulai

                    </label>

                    <input type="date"
                           name="tanggal_mulai"
                           required
                           class="w-full rounded-2xl border-gray-300">

                </div>

            </div>

            <div class="mb-6">

                <label class="font-semibold block mb-2">

                    Tanggal Selesai

                </label>

                <input type="date"
                       name="tanggal_selesai"
                       required
                       class="w-full rounded-2xl border-gray-300">

            </div>

            <div class="mb-6">

                <label class="font-semibold block mb-2">

                    Alasan

                </label>

                <textarea name="alasan"
                          rows="5"
                          required
                          class="w-full rounded-2xl border-gray-300"></textarea>

            </div>

            <div class="mb-8">

                <label class="font-semibold block mb-2">

                    Upload Surat

                </label>

                <input type="file"
                       name="surat">

            </div>

            <button type="submit"
                    class="bg-gradient-to-r
                           from-green-700
                           to-emerald-500
                           text-white
                           px-8 py-4
                           rounded-2xl
                           font-bold">

                Kirim Pengajuan

            </button>

        </form>

    </div>

    {{-- TABEL --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <div class="bg-gradient-to-r
                    from-green-700
                    to-emerald-500
                    px-8 py-6">

            <h2 class="text-3xl font-bold text-white">

                Riwayat Perizinan

            </h2>

        </div>

        <table class="w-full">

            <thead class="bg-green-50">

                <tr>

                    <th class="p-5 text-left">Jenis</th>

                    <th class="p-5 text-left">Tanggal</th>

                    <th class="p-5 text-left">Alasan</th>

                    <th class="p-5 text-left">Surat</th>

                    <th class="p-5 text-left">Status</th>

                </tr>

            </thead>

            <tbody>

                @forelse($cutis as $cuti)

                <tr class="border-t">

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
                    <td class="p-5">

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

                                {{ $cuti->status }}

                            </span>

                        @elseif($cuti->status == 'Ditolak')

                            <span class="bg-red-100
                                         text-red-600
                                         px-6 py-3
                                         rounded-full
                                         font-semibold">

                                {{ $cuti->status }}

                            </span>

                        @elseif($cuti->status == 'Disetujui')

                            <span class="bg-green-100
                                         text-green-700
                                         px-6 py-3
                                         rounded-full
                                         font-semibold">

                                {{ $cuti->status }}

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

                        Belum ada pengajuan

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
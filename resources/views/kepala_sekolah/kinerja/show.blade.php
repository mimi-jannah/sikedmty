@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="mb-6">

        <a href="{{ route('kinerja.index') }}"
           class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg">

            ← Kembali

        </a>

    </div>

    <div class="mb-6 bg-gradient-to-r from-green-600 to-emerald-500 rounded-2xl py-5 px-7 text-white">

    <h2 class="text-3xl font-bold">
        Detail Penilaian Guru
    </h2>

    <p class="mt-2 text-green-100">
        Informasi hasil penilaian kinerja guru oleh Kepala Sekolah.
    </p>

</div>

            <div class="grid grid-cols-12 gap-6">

            {{-- ================= KIRI ================= --}}
            <div class="col-span-12 lg:col-span-3">

                <div class="bg-slate-50 rounded-xl border p-6">

                    <div class="flex flex-col items-center">

                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode($penilaian->user->name) }}&background=22c55e&color=fff&size=150"
                            class="w-28 h-28 rounded-full border-4 border-green-200 shadow">

                        <h2 class="text-2xl font-bold mt-4">
                            {{ $penilaian->user->name }}
                        </h2>

                        <p class="text-gray-500">
                            NIP. {{ $penilaian->user->nip }}
                        </p>

                        <span
                            class="mt-3 inline-block px-3 py-1 rounded-full
                            bg-green-100 text-green-700 text-sm font-semibold">

                            Guru

                        </span>

                    </div>

                    <hr class="my-6">

                    <div class="space-y-5">

                        <div>

                            <p class="text-gray-500 text-sm">
                                Jabatan
                            </p>

                            <p class="font-semibold">
                                {{ $penilaian->user->jabatan }}
                            </p>

                        </div>

                        <div>

                            <p class="text-gray-500 text-sm">
                                Tanggal Penilaian
                            </p>

                            <p class="font-semibold">
                                {{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->translatedFormat('d F Y') }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            {{-- ================= TENGAH ================= --}}
            <div class="col-span-12 lg:col-span-6">

                <div class="bg-slate-50 rounded-2xl border p-6 h-full">

                    <h3 class="text-xl font-bold mb-5">

                        Deskripsi Kinerja

                    </h3>

                    <p class="leading-8 text-gray-700 text-justify">

                        {{ $penilaian->deskripsi }}

                    </p>

                </div>

            </div>

            {{-- ================= KANAN ================= --}}
            <div class="col-span-12 lg:col-span-3">

                <div class="bg-gradient-to-b from-green-50 to-emerald-100 rounded-2xl border p-6 text-center">

                    <div class="w-16 h-16 mx-auto rounded-full bg-white shadow flex items-center justify-center text-2xl">

                        ⭐

                    </div>

                    <p class="text-gray-500 mt-4">

                        Hasil Penilaian

                    </p>

                    <h1 class="text-5xl font-bold text-green-700 mt-2">

                        {{ $penilaian->nilai }}

                    </h1>

                    <span class="inline-block mt-3 px-4 py-2 rounded-full bg-green-600 text-white font-semibold">

                        {{ $penilaian->kategori }}

                    </span>

                </div>

                <div class="bg-white border rounded-2xl p-5 mt-5">

                    <div class="flex justify-between">

                        <span class="text-gray-500">

                            Kategori

                        </span>

                        <span class="font-semibold">

                            {{ $penilaian->kategori }}

                        </span>

                    </div>

                    <hr class="my-4">

                    <div class="flex justify-between">

                        <span class="text-gray-500">

                            Skor

                        </span>

                        <span class="font-bold text-green-700">

                            {{ $penilaian->nilai }}/100

                        </span>

                    </div>

                </div>

            </div>

        </div>

        </div>

@endsection
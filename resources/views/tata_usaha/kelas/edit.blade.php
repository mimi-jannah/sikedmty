@extends('layouts.app')

@section('content')

<div class="p-8">

    {{-- HEADER --}}
    <div class="mb-8">

        <h1 class="text-4xl font-bold text-slate-800">
            Edit Daftar Kelas
        </h1>

        <p class="text-gray-500 mt-2">
            Perbarui data kelas
        </p>

    </div>

    {{-- FORM --}}
    <div class="bg-white rounded-3xl shadow-xl p-8">

        <form action="{{ route('tata_usaha.kelas.update', $kelas->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-8">

                {{-- KELAS --}}
                <div>

                    <label class="text-xl font-semibold text-slate-800 block mb-3">
                        Kelas
                    </label>

                    <select name="nama_kelas"
                            class="w-full
                                   border
                                   border-slate-300
                                   rounded-2xl
                                   px-5
                                   py-3
                                   text-base">

                        <option value="">-- Pilih Kelas --</option>

                        @foreach([
                            'VII1','VII2','VII3',
                            'VIII1','VIII2','VIII3',
                            'IX1','IX2','IX3','IX4'
                        ] as $kelasItem)

                            <option value="{{ $kelasItem }}"
                                {{ $kelas->nama_kelas == $kelasItem ? 'selected' : '' }}>

                                {{ $kelasItem }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- TOTAL SISWA --}}
                <div>

                    <label class="text-xl font-semibold text-slate-800 block mb-3">
                        Total Siswa
                    </label>

                    <input type="number"
                           name="total_siswa"
                           value="{{ $kelas->total_siswa }}"
                           class="w-full
                                  border
                                  border-slate-300
                                  rounded-2xl
                                  px-5
                                  py-3
                                  text-base">

                </div>

                {{-- WALI KELAS --}}
                <div>

                    <label class="text-xl font-semibold text-slate-800 block mb-3">
                        Wali Kelas
                    </label>

                    <input type="text"
                           name="wali_kelas"
                           value="{{ $kelas->wali_kelas }}"
                           class="w-full
                                  border
                                  border-slate-300
                                  rounded-2xl
                                  px-5
                                  py-3
                                  text-base">

                </div>

                {{-- GURU --}}
                <div>

                    <label class="text-xl font-semibold text-slate-800 block mb-3">
                        Guru
                    </label>

                    <input type="text"
                           name="guru"
                           value="{{ $kelas->guru }}"
                           class="w-full
                                  border
                                  border-slate-300
                                  rounded-2xl
                                  px-5
                                  py-3
                                  text-base">

                </div>

                {{-- JAM --}}
<div>

    <label class="text-xl font-semibold text-slate-800 block mb-3">
        Jam Mengajar
    </label>

    <select name="jam_mengajar"
            required
            class="w-full
                   border
                   border-slate-300
                   rounded-2xl
                   px-5
                   py-3
                   text-base">

        <option value="">-- Pilih Jam --</option>

        @foreach([
            '07.00 - 09.00',
            '09.00 - 11.00',
            '11.00 - 13.00',
            '13.00 - 15.00'
        ] as $jam)

            <option value="{{ $jam }}"
                {{ $kelas->jam_mengajar == $jam ? 'selected' : '' }}>

                {{ $jam }}

            </option>

        @endforeach

    </select>

</div>

                {{-- HARI --}}
                <div>

                    <label class="text-xl font-semibold text-slate-800 block mb-3">
                        Hari Mengajar
                    </label>

                    <select name="hari_mengajar"
                            required
                            class="w-full
                                   border
                                   border-slate-300
                                   rounded-2xl
                                   px-5
                                   py-3
                                   text-base">

                        <option value="">-- Pilih Hari --</option>

                        @foreach([
                            'Senin',
                            'Selasa',
                            'Rabu',
                            'Kamis',
                            'Jumat',
                            'Sabtu'
                        ] as $hari)

                            <option value="{{ $hari }}"
                                {{ $kelas->hari_mengajar == $hari ? 'selected' : '' }}>

                                {{ $hari }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end mt-8">

                <button type="submit"
                        class="bg-green-700
                               hover:bg-green-800
                               text-white
                               font-semibold
                               text-lg
                               px-8
                               py-3
                               rounded-2xl
                               transition">

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
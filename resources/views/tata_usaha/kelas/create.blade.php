@extends('layouts.app')

@section('content')

<div class="p-6 mb-10">

    {{-- HEADER --}}
    <div class="mb-6">

        <h1 class="text-4xl font-bold text-slate-800">
            Tambah Daftar Kelas
        </h1>

        <p class="text-gray-500 mt-2">
            Tambahkan data kelas baru
        </p>

    </div>

    {{-- CARD --}}
    <div class="bg-white
                rounded-3xl
                shadow-xl
                p-6
                max-w-6xl">

        <form action="{{ route('tata_usaha.kelas.store') }}"
              method="POST">

            @csrf

            <div class="grid grid-cols-2 gap-x-6 gap-y-5">

                {{-- KELAS --}}
                <div>

                    <label class="font-semibold text-base text-slate-700">

                        Kelas

                    </label>

                    <select name="nama_kelas"
                            class="w-full
                                   mt-2
                                   border
                                   border-gray-200
                                   rounded-2xl
                                   px-4 py-2
                                   text-base
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-green-500"
                            required>

                        <option value="">
                            -- Pilih Kelas --
                        </option>

                        <option value="VII1">VII1</option>
                        <option value="VII2">VII2</option>
                        <option value="VII3">VII3</option>

                        <option value="VIII1">VIII1</option>
                        <option value="VIII2">VIII2</option>
                        <option value="VIII3">VIII3</option>

                        <option value="IX1">IX1</option>
                        <option value="IX2">IX2</option>
                        <option value="IX3">IX3</option>
                        <option value="IX4">IX4</option>

                    </select>

                </div>

                {{-- TOTAL SISWA --}}
                <div>

                    <label class="font-semibold text-base text-slate-700">

                        Total Siswa

                    </label>

                    <input type="number"
                           name="total_siswa"
                           class="w-full
                                  mt-2
                                  border
                                  border-gray-200
                                  rounded-2xl
                                  px-4 py-2
                                  text-base
                                  focus:outline-none
                                  focus:ring-2
                                  focus:ring-green-500"
                           required>

                </div>

                {{-- WALI KELAS --}}
                <div>

                    <label class="font-semibold text-base text-slate-700">

                        Wali Kelas

                    </label>

                    <input type="text"
                           name="wali_kelas"
                           class="w-full
                                  mt-2
                                  border
                                  border-gray-200
                                  rounded-2xl
                                  px-4 py-2
                                  text-base
                                  focus:outline-none
                                  focus:ring-2
                                  focus:ring-green-500"
                           required>

                </div>

                {{-- GURU --}}
                <div>

                    <label class="font-semibold text-base text-slate-700">

                        Guru

                    </label>

                    <input type="text"
                           name="guru"
                           class="w-full
                                  mt-2
                                  border
                                  border-gray-200
                                  rounded-2xl
                                  px-4 py-2
                                  text-base
                                  focus:outline-none
                                  focus:ring-2
                                  focus:ring-green-500"
                           required>

                </div>

                {{-- JAM MENGAJAR --}}
                <div>

                    <label class="font-semibold text-base text-slate-700">

                        Jam Mengajar

                    </label>

                    <select name="jam_mengajar"
                            class="w-full
                                   mt-2
                                   border
                                   border-gray-200
                                   rounded-2xl
                                   px-4 py-2
                                   text-base
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-green-500"
                            required>

                        <option value="">
                            -- Pilih Jam --
                        </option>

                        <option value="07.00 - 09.00">
                            07.00 - 09.00
                        </option>

                        <option value="09.00 - 11.00">
                            09.00 - 11.00
                        </option>

                        <option value="11.00 - 13.00">
                            11.00 - 13.00
                        </option>

                        <option value="13.00 - 15.00">
                            13.00 - 15.00
                        </option>

                    </select>

                </div>

                {{-- HARI MENGAJAR --}}
                <div>

                    <label class="font-semibold text-base text-slate-700">

                        Hari Mengajar

                    </label>

                    <select name="hari_mengajar"
                            class="w-full
                                   mt-2
                                   border
                                   border-gray-200
                                   rounded-2xl
                                   px-4 py-2
                                   text-base
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-green-500"
                            required>

                        <option value="">
                            -- Pilih Hari --
                        </option>

                        <option value="Senin">
                            Senin
                        </option>

                        <option value="Selasa">
                            Selasa
                        </option>

                        <option value="Rabu">
                            Rabu
                        </option>

                        <option value="Kamis">
                            Kamis
                        </option>

                        <option value="Jumat">
                            Jumat
                        </option>

                        <option value="Sabtu">
                            Sabtu
                        </option>

                    </select>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end mt-8">

                <button type="submit"
                        class="bg-green-700
                               hover:bg-green-800
                               transition
                               text-white
                               text-base
                               font-semibold
                               px-6 py-3
                               rounded-2xl">

                    Simpan Data Kelas

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
@extends('layouts.app')

@section('content')

<div>

    {{-- TITLE --}}
    <div class="mb-10">

        <h1 class="text-5xl font-bold text-gray-800">

            Tambah Data Guru/Staff

        </h1>

        <p class="text-gray-500 mt-3">

            Silahkan isi data guru/staff dengan lengkap

        </p>

    </div>

    {{-- FORM --}}
    <div class="bg-white
                rounded-3xl
                shadow-xl
                p-10
                max-w-4xl">

        <form action="{{ route('tata_usaha.data_guru.store') }}"
        method="POST"
        enctype="multipart/form-data">

            @csrf

            {{-- NAMA --}}
            <div class="mb-6">

                <label class="block mb-3
                              font-semibold
                              text-gray-700">

                    Nama Lengkap

                </label>

                <input type="text"
                       name="name"
                       class="w-full
                              border border-gray-300
                              rounded-2xl
                              px-5 py-4
                              outline-none
                              focus:ring-2
                              focus:ring-green-500">

            </div>

            {{-- EMAIL --}}
            <div class="mb-6">

                <label class="block mb-3
                              font-semibold
                              text-gray-700">

                    Email

                </label>

                <input type="email"
                       name="email"
                       class="w-full
                              border border-gray-300
                              rounded-2xl
                              px-5 py-4
                              outline-none
                              focus:ring-2
                              focus:ring-green-500">

            </div>

            {{-- NIP --}}
            <div class="mb-6">

                <label class="block mb-3
                              font-semibold
                              text-gray-700">

                    NIP

                </label>

                <input type="text"
                       name="nip"
                       class="w-full
                              border border-gray-300
                              rounded-2xl
                              px-5 py-4
                              outline-none
                              focus:ring-2
                              focus:ring-green-500">

            </div>

            {{-- GOLONGAN --}}
            <div class="mb-6">

                <label class="block mb-3
                              font-semibold
                              text-gray-700">

                    Golongan

                </label>

                <select name="golongan"
        class="w-full
               border border-gray-300
               rounded-2xl
               px-5 py-4
               outline-none
               focus:ring-2
               focus:ring-green-500">

    <option value="">

        -- Pilih Golongan --

    </option>

    <option value="III/a">

        III/a

    </option>

    <option value="III/b">

        III/b

    </option>

    <option value="III/c">

        III/c

    </option>

    <option value="III/d">

        III/d

    </option>

    <option value="IV/a">

        IV/a

    </option>

    <option value="IV/b">

        IV/b

    </option>

    <option value="IV/c">

        IV/c

    </option>

    <option value="IV/d">

        IV/d

    </option>

    <option value="IV/e">

        IV/e

    </option>

</select>
                
                              

            </div>

            {{-- JABATAN --}}
            <div class="mb-6">

                <label class="block mb-3
                              font-semibold
                              text-gray-700">

                    Jabatan

                </label>

                <select name="jabatan"
                        class="w-full
                               border border-gray-300
                               rounded-2xl
                               px-5 py-4
                               outline-none
                               focus:ring-2
                               focus:ring-green-500">

                    <option value="Guru">

                        Guru

                    </option>

                    <option value="Staff TU">

                        Staff TU

                    </option>

                    <option value="Kepala Sekolah">

                        Kepala Sekolah

                    </option>

                </select>

            </div>

            {{-- FOTO --}}
<div class="mb-6">

    <label class="block mb-3
                  font-semibold
                  text-gray-700">

        Foto

    </label>

    <input type="file"
           name="foto"
           class="w-full
                  border border-gray-300
                  rounded-2xl
                  px-5 py-4
                  outline-none
                  focus:ring-2
                  focus:ring-green-500">

</div>

            {{-- PASSWORD --}}
            <div class="mb-8">

                <label class="block mb-3
                              font-semibold
                              text-gray-700">

                    Password

                </label>

                <input type="password"
                       name="password"
                       class="w-full
                              border border-gray-300
                              rounded-2xl
                              px-5 py-4
                              outline-none
                              focus:ring-2
                              focus:ring-green-500">

            </div>

            {{-- BUTTON --}}
            <div class="flex gap-4">

                <button type="submit"
                        class="bg-green-700
                               hover:bg-green-800
                               transition
                               text-white
                               px-8 py-4
                               rounded-2xl
                               font-semibold">

                    Simpan Data

                </button>

                <a href="{{ route('tata_usaha.data_guru') }}"
                   class="bg-gray-300
                          hover:bg-gray-400
                          transition
                          text-gray-800
                          px-8 py-4
                          rounded-2xl
                          font-semibold">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection
@extends('layouts.app')

@section('content')

<div>

    <h1 class="text-5xl
               font-bold
               text-gray-800
               mb-10">

        Detail Guru/Staff

    </h1>

    <div class="bg-white
                p-10
                rounded-3xl
                shadow-xl
                max-w-3xl">

    {{-- FOTO --}}
<div class="mb-8 flex justify-center">

    @if($guru->foto)

        <img src="{{ asset('images/'.$guru->foto) }}"
             alt="Foto Guru"
             class="w-32
                    h-32
                    rounded-full
                    object-cover
                    border-4
                    border-green-600
                    shadow-lg">

    @else

        <div class="w-32
                    h-32
                    rounded-full
                    bg-gray-300
                    flex
                    items-center
                    justify-center
                    text-gray-600">

            Tidak Ada Foto

        </div>

    @endif

</div>



        <div class="space-y-6">

            <div>

                <h3 class="font-bold text-gray-500">

                    Nama

                </h3>

                <p class="text-2xl">

                    {{ $guru->name }}

                </p>

            </div>

            <div>

                <h3 class="font-bold text-gray-500">

                    Email

                </h3>

                <p class="text-2xl">

                    {{ $guru->email }}

                </p>

            </div>

            <div>

                <h3 class="font-bold text-gray-500">

                    NIP

                </h3>

                <p class="text-2xl">

                    {{ $guru->nip ?? '-' }}

                </p>

            </div>

            <div>

                <h3 class="font-bold text-gray-500">

                    Golongan

                </h3>

                <p class="text-2xl">

                    {{ $guru->golongan ?? '-' }}

                </p>

            </div>

            <div>

                <h3 class="font-bold text-gray-500">

                    Jabatan

                </h3>

                <p class="text-2xl">

                    {{ $guru->jabatan ?? '-' }}

                </p>

            </div>

        </div>

        <div class="mt-10">

            <a href="{{ route('tata_usaha.data_guru') }}"
               class="bg-green-700
                      hover:bg-green-800
                      text-white
                      px-6 py-3
                      rounded-2xl">

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection
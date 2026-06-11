@extends('layouts.app')

@section('content')

<div>

    <h1 class="text-5xl font-bold text-gray-800 mb-10">

        Edit Data Guru/Staff

    </h1>

    <div class="bg-white
                p-10
                rounded-3xl
                shadow-xl
                max-w-4xl">

        <form action="{{ route('tata_usaha.data_guru.update', $guru->id) }}"
                method="POST"
                enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- NAMA --}}
            <div class="mb-6">

                <label class="block mb-3 font-semibold">

                    Nama

                </label>

                <input type="text"
                       name="name"
                       value="{{ $guru->name }}"
                       class="w-full
                              border
                              rounded-2xl
                              px-5 py-4">

            </div>

            {{-- EMAIL --}}
            <div class="mb-6">

                <label class="block mb-3 font-semibold">

                    Email

                </label>

                <input type="email"
                       name="email"
                       value="{{ $guru->email }}"
                       class="w-full
                              border
                              rounded-2xl
                              px-5 py-4">

            </div>

            {{-- NIP --}}
            <div class="mb-6">

                <label class="block mb-3 font-semibold">

                    NIP

                </label>

                <input type="text"
                       name="nip"
                       value="{{ $guru->nip }}"
                       class="w-full
                              border
                              rounded-2xl
                              px-5 py-4">

            </div>

            {{-- GOLONGAN --}}
<div class="mb-6">

    <label class="block mb-3 font-semibold">

        Golongan

    </label>

    <select name="golongan"
            class="w-full
                   border
                   rounded-2xl
                   px-5 py-4">

        <option value="III/a"
            {{ $guru->golongan == 'III/a' ? 'selected' : '' }}>

            III/a

        </option>

        <option value="III/b"
            {{ $guru->golongan == 'III/b' ? 'selected' : '' }}>

            III/b

        </option>

        <option value="III/c"
            {{ $guru->golongan == 'III/c' ? 'selected' : '' }}>

            III/c

        </option>

        <option value="III/d"
            {{ $guru->golongan == 'III/d' ? 'selected' : '' }}>

            III/d

        </option>

        <option value="IV/a"
            {{ $guru->golongan == 'IV/a' ? 'selected' : '' }}>

            IV/a

        </option>

        <option value="IV/b"
            {{ $guru->golongan == 'IV/b' ? 'selected' : '' }}>

            IV/b

        </option>

        <option value="IV/c"
            {{ $guru->golongan == 'IV/c' ? 'selected' : '' }}>

            IV/c

        </option>

        <option value="IV/d"
            {{ $guru->golongan == 'IV/d' ? 'selected' : '' }}>

            IV/d

        </option>

        <option value="IV/e"
            {{ $guru->golongan == 'IV/e' ? 'selected' : '' }}>

            IV/e

        </option>

    </select>

</div>

{{-- JABATAN --}}
<div class="mb-8">

    <label class="block mb-3 font-semibold">

        Jabatan

    </label>

    <select name="jabatan"
            class="w-full
                   border
                   rounded-2xl
                   px-5 py-4">

        <option value="Guru"
            {{ $guru->jabatan == 'Guru' ? 'selected' : '' }}>

            Guru

        </option>

        <option value="Staff TU"
            {{ $guru->jabatan == 'Staff TU' ? 'selected' : '' }}>

            Staff TU

        </option>

        <option value="Kepala Sekolah"
            {{ $guru->jabatan == 'Kepala Sekolah' ? 'selected' : '' }}>

            Kepala Sekolah

        </option>

    </select>

</div>

        {{-- FOTO --}}
<div class="mb-6">

    <label class="block mb-3 font-semibold">

        Foto

    </label>

    {{-- FOTO LAMA --}}
    @if($guru->foto)

        <img src="{{ asset('images/'.$guru->foto) }}"
             class="w-24
                    h-24
                    rounded-full
                    object-cover
                    mb-4
                    border-2
                    border-green-600">

    @endif

    {{-- INPUT FOTO --}}
    <input type="file"
           name="foto"
           class="w-full
                  border
                  rounded-2xl
                  px-5 py-4">

</div>

            <button type="submit"
                    class="bg-green-700
                           text-white
                           px-8 py-4
                           rounded-2xl">

                Update Data

            </button>

        </form>

    </div>

</div>

@endsection
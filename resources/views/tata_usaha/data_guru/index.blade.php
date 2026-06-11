@extends('layouts.app')

@section('content')

<div>

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <h1 class="text-5xl font-bold text-gray-800">

            Data Guru/Staff

        </h1>

        {{-- SEARCH --}}
        <div>

            <input type="text"
                   placeholder="Cari guru/staff..."
                   class="px-5 py-3
                          rounded-2xl
                          border border-gray-300
                          outline-none
                          w-80">

        </div>

    </div>

    {{-- BUTTON --}}
    <div class="mb-6">

        <a href="{{ route('tata_usaha.data_guru.create') }}"
           class="bg-green-700
                  hover:bg-green-800
                  transition
                  text-white
                  px-6 py-3
                  rounded-2xl
                  font-semibold
                  inline-block">

            + Tambah Data Guru/Staff

        </a>

    </div>

    {{-- TABLE --}}
    <div class="bg-white
                rounded-3xl
                shadow-xl
                overflow-hidden">

        <table class="w-full">

            {{-- HEAD --}}
            <thead class="bg-green-700 text-white">

                <tr>

                    <th class="p-5 text-left">

                        No

                    </th>

                    <th class="p-5 text-left">

                        Nama

                    </th>

                    <th class="p-5 text-left">

                        NIP

                    </th>

                    <th class="p-5 text-left">

                        Golongan

                    </th>

                    <th class="p-5 text-left">

                        Jabatan

                    </th>

                    <th class="p-5 text-left">

                        Aksi

                    </th>

                </tr>

            </thead>

            {{-- BODY --}}
            <tbody>

                @foreach($guruStaff as $item)

                <tr class="border-b hover:bg-gray-50">

                    {{-- NO --}}
                    <td class="p-5">

                        {{ $loop->iteration }}

                    </td>

                    {{-- NAMA --}}
                    <td class="p-5">

                        {{ $item->name }}

                    </td>

                    {{-- NIP --}}
                    <td class="p-5">

                        {{ $item->nip ?? '-' }}

                    </td>

                    {{-- GOLONGAN --}}
                    <td class="p-5">

                        {{ $item->golongan ?? '-' }}

                    </td>

                    {{-- JABATAN --}}
                    <td class="p-5">

                        {{ $item->jabatan ?? '-' }}

                    </td>

                    {{-- AKSI --}}
<td class="p-5">

    <div class="flex items-center gap-3">

        {{-- EDIT --}}
        <a href="{{ route('tata_usaha.data_guru.edit', $item->id) }}"
           class="bg-blue-500
                  hover:bg-blue-600
                  transition
                  text-white
                  px-4 py-2
                  rounded-xl">

            Edit

        </a>

        {{-- HAPUS --}}
        <form action="{{ route('tata_usaha.data_guru.destroy', $item->id) }}"
              method="POST"
              class="inline"
              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="bg-red-500
                           hover:bg-red-600
                           transition
                           text-white
                           px-4 py-2
                           rounded-xl">

                Hapus

            </button>

        </form>

        {{-- DETAIL --}}
        <a href="{{ route('tata_usaha.data_guru.show', $item->id) }}"
           class="bg-gray-700
                  hover:bg-gray-800
                  transition
                  text-white
                  px-4 py-2
                  rounded-xl">

            Detail

        </a>

    </div>

</td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
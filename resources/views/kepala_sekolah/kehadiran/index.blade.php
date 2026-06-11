@extends('layouts.app')

@section('content')

<div class="p-8">

    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-4xl font-bold text-slate-800">

                Laporan Kehadiran Guru

            </h1>

            <p class="text-slate-500 mt-2">

                Kepala Sekolah dapat memantau kehadiran seluruh guru/staff

            </p>

        </div>

    </div>

    <div class="grid grid-cols-3 gap-6">

        @foreach($guru as $item)

        <a href="{{ route('kepala.kehadiran.detail', $item->id) }}"
           class="bg-white
                  rounded-3xl
                  shadow-xl
                  p-6
                  hover:scale-105
                  transition">

            <div class="flex items-center gap-4">

                <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center text-2xl">

                    👨‍🏫

                </div>

                <div>

                    <h1 class="font-bold text-xl text-slate-800">

                        {{ $item->name }}

                    </h1>

                    <p class="text-slate-500">

                        {{ $item->jabatan }}

                    </p>

                </div>

            </div>

        </a>

        @endforeach

    </div>

</div>

@endsection
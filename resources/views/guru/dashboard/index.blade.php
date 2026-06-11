@extends('layouts.app')

@section('content')

<div class="p-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-5xl font-bold text-slate-800">
                Dasbor Kinerja
            </h1>

            <p class="text-gray-500 mt-2">
                Selamat datang kembali 👋
            </p>

        </div>

    </div>

    {{-- CARD --}}
    <div class="grid grid-cols-4 gap-6 mb-8">

        {{-- TOTAL KEHADIRAN --}}
        <div class="bg-gradient-to-br
                    from-green-600
                    to-green-800
                    rounded-3xl
                    p-6
                    text-white
                    shadow-xl">

            <div class="text-4xl mb-4">📋</div>

            <p class="opacity-80">
                Total Kehadiran
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $totalKehadiran }}
            </h2>

        </div>

        {{-- HADIR --}}
        <div class="bg-white
                    rounded-3xl
                    p-6
                    shadow-xl">

            <div class="text-4xl mb-4">✅</div>

            <p class="text-gray-500">
                Hadir Tepat Waktu
            </p>

            <h2 class="text-4xl font-bold text-green-700 mt-2">
                {{ $hadir }}
            </h2>

        </div>

        {{-- TERLAMBAT --}}
        <div class="bg-white
                    rounded-3xl
                    p-6
                    shadow-xl">

            <div class="text-4xl mb-4">⏰</div>

            <p class="text-gray-500">
                Terlambat
            </p>

            <h2 class="text-4xl font-bold text-yellow-500 mt-2">
                {{ $terlambat }}
            </h2>

        </div>

        {{-- KELAS --}}
        <div class="bg-white
                    rounded-3xl
                    p-6
                    shadow-xl">

            <div class="text-4xl mb-4">🏫</div>

            <p class="text-gray-500">
                Total Kelas
            </p>

            <h2 class="text-4xl font-bold text-slate-800 mt-2">
                {{ $totalKelas }}
            </h2>

        </div>

    </div>

    {{-- GRAFIK --}}
    <div class="grid grid-cols-2 gap-6">

        {{-- BAR CHART --}}
        <div class="bg-white
                    rounded-3xl
                    p-8
                    shadow-xl">

            <h2 class="text-2xl
                       font-bold
                       text-slate-800
                       mb-6">

                Statistik Kehadiran

            </h2>

            <canvas id="chartKehadiran"></canvas>

        </div>

        {{-- PIE CHART --}}
        <div class="bg-white
                    rounded-3xl
                    p-8
                    shadow-xl">

            <h2 class="text-2xl
                       font-bold
                       text-slate-800
                       mb-6">

                Rekap Kehadiran

            </h2>

            <canvas id="chartPie"></canvas>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('chartKehadiran');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: ['Hadir', 'Terlambat'],

        datasets: [{

            label: 'Statistik',

            data: [
                {{ $hadir }},
                {{ $terlambat }}
            ],

            backgroundColor: [
                '#15803d',
                '#eab308'
            ],

            borderRadius: 12
        }]
    }
});

const pie = document.getElementById('chartPie');

new Chart(pie, {

    type: 'doughnut',

    data: {

        labels: ['Hadir', 'Terlambat'],

        datasets: [{

            data: [
                {{ $hadir }},
                {{ $terlambat }}
            ],

            backgroundColor: [
                '#15803d',
                '#eab308'
            ]
        }]
    }
});

</script>

@endsection
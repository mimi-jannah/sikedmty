@extends('layouts.app')

@section('content')

<div class="p-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-5xl font-bold text-slate-800">
                Dasbor
            </h1>

            <p class="text-gray-500 mt-2">
                Selamat datang di sistem SIKED MTY
            </p>

        </div>

    </div>

    {{-- CARD --}}
    <div class="grid grid-cols-3 gap-6 mb-8">

        {{-- GURU --}}
        <div class="bg-gradient-to-br
                    from-green-600
                    to-green-800
                    rounded-3xl
                    p-6
                    text-white
                    shadow-xl">

            <div class="text-4xl mb-4">👨‍🏫</div>

            <p class="text-lg opacity-80">
                Total Guru/Staff
            </p>

            <h2 class="text-4xl font-bold mt-2">
                {{ $totalGuru }}
            </h2>

        </div>

        {{-- KEHADIRAN --}}
        <div class="bg-white
                    rounded-3xl
                    p-6
                    shadow-xl">

            <div class="text-4xl mb-4">📋</div>

            <p class="text-gray-500">
                Total Kehadiran
            </p>

            <h2 class="text-4xl font-bold text-slate-800 mt-2">
                {{ $totalKehadiran }}
            </h2>

        </div>

    </div>

    {{-- GRAFIK --}}
    <div class="grid grid-cols-2 gap-6">

        {{-- GRAFIK BAR --}}
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

        {{-- GRAFIK LINE --}}
        <div class="bg-white
                    rounded-3xl
                    p-8
                    shadow-xl">

            <h2 class="text-2xl
                       font-bold
                       text-slate-800
                       mb-6">

                Rekap Guru/Staff

            </h2>

            <canvas id="chartGuru"></canvas>

        </div>

    </div>

</div>

{{-- CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('chartKehadiran');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],

        datasets: [{

            label: 'Kehadiran',

            data: [12, 19, 15, 17, 20],

            backgroundColor: '#15803d',

            borderRadius: 10
        }]
    }
});

const guru = document.getElementById('chartGuru');

new Chart(guru, {

    type: 'line',

    data: {

        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],

        datasets: [{

            label: 'Guru Aktif',

            data: [5, 7, 8, 10, 12],

            borderColor: '#166534',

            backgroundColor: '#16a34a',

            tension: 0.4
        }]
    }
});

</script>

@endsection
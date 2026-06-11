@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-8">

        <h1 class="text-5xl font-bold text-gray-800">
            Kehadiran
        </h1>

        <p class="text-gray-500 mt-2 text-lg">
    {{ now()->locale('id')->translatedFormat('l, d F Y') }}
</p>

    </div>

    {{-- CARD ABSENSI --}}
    <div class="bg-white
                rounded-3xl
                shadow-xl
                overflow-hidden
                mb-10">

        {{-- TOP --}}
        <div class="bg-gradient-to-r
                    from-green-700
                    to-emerald-600
                    p-8 text-white">

            <h2 class="text-3xl font-bold">
                Absensi Guru/Staff
            </h2>

            <p class="text-green-100 mt-2">
                MTSS Thamrin Yahya
            </p>

        </div>

        {{-- CONTENT --}}
        <div class="p-10">

            {{-- STATUS --}}
            <div id="lokasi-status"
                 class="mb-6
                        bg-green-100
                        text-green-700
                        px-5 py-4
                        rounded-2xl">

                📍 Mendeteksi lokasi...

            </div>

            {{-- JAM --}}
            <div class="mb-8 text-center">

                <h1 id="jam"
                    class="text-6xl
                           font-bold
                           text-gray-800">
                </h1>

            </div>

            {{-- CAMERA --}}
            <div class="flex justify-center mb-8">

                <video id="camera"
                       autoplay
                       playsinline
                       muted
                       class="w-[450px]
                              h-[350px]
                              object-cover
                              rounded-3xl
                              border-4
                              border-green-500
                              shadow-xl
                              scale-x-[-1]">
                </video>

                <canvas id="canvas" class="hidden"></canvas>

            </div>

            {{-- FORM --}}
            <form id="formPresensi"
                  action="{{ route('guru.kehadiran.store') }}"
                  method="POST">

                @csrf

                <input type="hidden"
                       name="foto_camera"
                       id="foto_camera">

                <input type="hidden"
                       name="lokasi"
                       id="lokasi">

                <div class="text-center">

                    <button id="btnPresensi"
                            type="submit"
                            class="bg-gray-400
                                   text-white
                                   px-10 py-4
                                   rounded-2xl
                                   text-lg
                                   font-bold"
                            disabled>

                        Mengecek Waktu...

                    </button>

                </div>

            </form>

        </div>

    </div>

    {{-- RIWAYAT --}}
    <div class="bg-white
                rounded-3xl
                shadow-xl
                overflow-hidden">

        {{-- HEADER --}}
        <div class="px-8 py-6 border-b">

            <h1 class="text-2xl
                       font-bold
                       text-gray-800">

                Data Riwayat Kehadiran

            </h1>

        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left">
                            Tanggal & Jam
                        </th>

                        <th class="px-6 py-4 text-left">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left">
                            Lokasi
                        </th>

                        <th class="px-6 py-4 text-left">
                            Bukti Kehadiran
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($riwayat as $item)

                    <tr class="border-t">

                        {{-- TANGGAL --}}
                        <td class="px-6 py-5">

    <div class="flex flex-col">

        <span class="font-semibold text-gray-800">

            @php
                \Carbon\Carbon::setLocale('id');
            @endphp
            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}
        </span>

        <span class="text-green-600 font-medium text-sm">

            ⏰ {{ $item->jam_masuk }}

        </span>

    </div>

</td>

                        {{-- STATUS --}}
                        <td class="px-6 py-5">

                            @if($item->status == 'Berhasil')

                                <span class="bg-green-600
                                             text-white
                                             px-5 py-2
                                             rounded-2xl
                                             font-semibold
                                             shadow">

                                    {{ $item->status }}

                                </span>

                            @elseif($item->status == 'Terlambat')

                                <span class="bg-red-500
                                             text-white
                                             px-5 py-2
                                             rounded-2xl
                                             font-semibold
                                             shadow">

                                    {{ $item->status }}

                                </span>

                            @else

                                <span class="bg-gray-500
                                             text-white
                                             px-5 py-2
                                             rounded-2xl
                                             font-semibold
                                             shadow">

                                    {{ $item->status }}

                                </span>

                            @endif

                        </td>

                        {{-- LOKASI --}}
                        <td class="px-6 py-5">

                            <a href="https://www.google.com/maps/search/?api=1&query={{ $item->lokasi }}"
   target="_blank"
                               class="bg-blue-100
                                      text-blue-700
                                      px-4 py-2
                                      rounded-2xl
                                      text-sm
                                      font-semibold
                                      hover:bg-blue-200
                                      transition">

                                📍 Lihat Lokasi

                            </a>

                        </td>

                        {{-- FOTO --}}
                        <td class="px-6 py-5">

                            <a href="{{ asset('storage/' . $item->bukti) }}"
                               target="_blank"
                               class="bg-yellow-500
                                      hover:bg-yellow-600
                                      text-white
                                      px-5 py-2
                                      rounded-2xl
                                      font-semibold
                                      shadow
                                      transition">

                                Foto

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4"
                            class="text-center
                                   py-10
                                   text-gray-400">

                            Belum ada riwayat kehadiran

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- CAMERA --}}
<script>

navigator.mediaDevices.getUserMedia({

    video: true,
    audio: false

})

.then(function(stream) {

    document.getElementById('camera').srcObject = stream;

});

</script>

{{-- JAM --}}
<script>

function updateJam() {

    const now = new Date();

    document.getElementById('jam').innerHTML =
        now.toLocaleTimeString('id-ID');

}

setInterval(updateJam, 1000);

updateJam();

</script>

{{-- CHECK JAM --}}
<script>

function checkJamPresensi() {

    const now = new Date();

    const jam =
        String(now.getHours()).padStart(2,'0') + ':' +
        String(now.getMinutes()).padStart(2,'0');

    const btn = document.getElementById('btnPresensi');

    if (jam >= '07:00' && jam <= '07:30') {

        btn.disabled = false;

        btn.innerHTML = 'Hadir Sekarang';

        btn.className =
            'bg-green-600 text-white px-10 py-4 rounded-2xl text-lg font-bold';

    }

    else if (jam > '07:30' && jam <= '08:00') {

        btn.disabled = false;

        btn.innerHTML = 'Hadir Sekarang';

        btn.className =
            'bg-yellow-500 text-white px-10 py-4 rounded-2xl text-lg font-bold';

    }

    else {

        btn.disabled = true;

        btn.innerHTML = 'Kehadiran Ditutup';

        btn.className =
            'bg-gray-400 text-white px-10 py-4 rounded-2xl text-lg font-bold';

    }

}

setInterval(checkJamPresensi, 1000);

checkJamPresensi();

</script>

{{-- LOKASI --}}
<script>

navigator.geolocation.getCurrentPosition(

function(position){

    let lokasi =
        position.coords.latitude +
        ',' +
        position.coords.longitude;

    document.getElementById('lokasi').value = lokasi;

    document.getElementById('lokasi-status').innerHTML =
        '📍 Lokasi berhasil terdeteksi';

},

function(error){

    document.getElementById('lokasi-status').innerHTML =
        '❌ GPS tidak aktif atau izin lokasi ditolak';

},

{
    enableHighAccuracy: true,
    timeout: 10000,
    maximumAge: 0
}

);

</script>

{{-- FOTO --}}
<script>

document.getElementById('formPresensi')
.addEventListener('submit', function() {

    let canvas = document.getElementById('canvas');

    let video = document.getElementById('camera');

    canvas.width = video.videoWidth;

    canvas.height = video.videoHeight;

    let context = canvas.getContext('2d');

    // AGAR FOTO TIDAK MIRROR
    context.save();

    context.scale(-1, 1);

    context.drawImage(
        video,
        -canvas.width,
        0,
        canvas.width,
        canvas.height
    );

    context.restore();

    document.getElementById('foto_camera').value =
        canvas.toDataURL('image/png');

});

</script>

@endsection
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>SIKED MTY</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-gradient-to-br
             from-slate-100
             to-green-50">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        @if(auth()->user()->role->slug == 'guru')

            @include('partials.sidebar.guru')

        @elseif(auth()->user()->role->slug == 'tata_usaha')

            @include('partials.sidebar.tata_usaha')

        @elseif(auth()->user()->role->slug == 'kepala_sekolah')

            @include('partials.sidebar.kepala_sekolah')

        @endif

        <div class="flex-1 flex flex-col min-h-screen">

            {{-- CONTENT --}}
            <main class="p-6 flex-1">

                @yield('content')

            </main>

            {{-- FOOTER --}}
            @include('partials.footer')

        </div>

    </div>

    {{-- SWEET ALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- SUCCESS --}}
    @if(session('success'))

    <script>

        let pesan = @json(session('success'));

        let icon = 'success';
        let title = 'Berhasil';

        // KHUSUS TERLAMBAT
        if (pesan.includes('Terlambat')) {

            icon = 'error';
            title = 'Kehadiran Terlambat';

        }

        Swal.fire({

            icon: icon,

            title: title,

            text: pesan,

            confirmButtonText: 'OK',

            confirmButtonColor: '#16a34a'

        });

    </script>

    @endif

    {{-- ERROR --}}
    @if(session('error'))

    <script>

        Swal.fire({

            icon: 'error',

            title: 'Gagal',

            text: @json(session('error')),

            confirmButtonText: 'OK',

            confirmButtonColor: '#dc2626'

        });

    </script>

    @endif

</body>

</html>
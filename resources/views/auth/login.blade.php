<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>SIKED MTY</title>

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}"></script>

</head>

<body class="min-h-screen flex items-center justify-center
             bg-gradient-to-br
             from-green-700
             via-emerald-600
             to-blue-900">

    <div class="w-full max-w-md px-6">

        {{-- CARD --}}
        <div class="bg-white/95 backdrop-blur-md
                    rounded-3xl shadow-2xl
                    p-10">

            {{-- LOGO --}}
            <div class="flex justify-center mb-5">

                <img src="{{ asset('images/LogoSekolah.jpeg') }}"
                     alt="Logo Sekolah"
                     class="w-28 h-28 object-contain">

            </div>

            {{-- TITLE --}}
            <div class="text-center mb-8">

                <h1 class="text-3xl font-bold text-gray-800">

                    SIKED MTY

                </h1>

                <p class="text-gray-600 mt-2">

                    Sistem Informasi Kehadiran
                    Guru & Staff

                </p>

                <p class="text-sm text-gray-500 mt-1">

                    MTSS Thamrin Yahya
                    Rambah Hilir

                </p>

            </div>

            {{-- SESSION --}}
            <x-auth-session-status
                class="mb-4"
                :status="session('status')" />

            {{-- FORM --}}
            <form method="POST"
                  action="{{ route('login') }}">

                @csrf

                {{-- EMAIL --}}
                <div class="mb-5">

                    <label class="block mb-2
                                   text-sm font-medium text-gray-700">

                        Email

                    </label>

                    <input type="email"
                           name="email"
                           required
                           autofocus
                           placeholder="Masukkan email"
                           class="w-full px-4 py-3
                                  border border-gray-300
                                  rounded-xl
                                  focus:ring-2
                                  focus:ring-green-500
                                  outline-none">

                </div>

                {{-- PASSWORD --}}
                <div class="mb-6">

                    <label class="block mb-2
                                   text-sm font-medium text-gray-700">

                        Password

                    </label>

                    <input type="password"
                           name="password"
                           required
                           placeholder="Masukkan password"
                           class="w-full px-4 py-3
                                  border border-gray-300
                                  rounded-xl
                                  focus:ring-2
                                  focus:ring-blue-500
                                  outline-none">

                </div>

                {{-- BUTTON --}}
                <button type="submit"
                        class="w-full
                               bg-gradient-to-r
                               from-green-600
                               to-blue-700
                               hover:from-green-700
                               hover:to-blue-800
                               text-white
                               py-3
                               rounded-xl
                               font-semibold
                               shadow-lg
                               transition duration-300">

                    Login

                </button>

            </form>

        </div>

    </div>

</body>
</html>
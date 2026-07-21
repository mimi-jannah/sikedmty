<aside class="w-20 md:w-64 min-h-screen
              bg-gradient-to-b
              from-green-800
              to-emerald-700
              text-white
              relative shadow-2xl
              transition-all">

    {{-- LOGO --}}
    <div class="p-6 border-b border-green-600">

        <div class="flex flex-col md:flex-row items-center gap-2 md:gap-3 text-center md:text-left">

            <img src="{{ asset('images/LogoSekolah.jpeg') }}"
                 class="w-14 h-14 object-contain">

            <div class="hidden md:block">

                <h1 class="font-bold text-lg">

                    SIKED MTY

                </h1>

                <p class="text-xs text-green-100">

                    MTSS Thamrin Yahya

                </p>

            </div>

        </div>

    </div>

    {{-- MENU --}}
    <div class="p-4 space-y-3">

        <a href="{{ route('guru.dashboard') }}"
           class="flex justify-center md:justify-start items-center gap-3
                bg-white/10
                hover:bg-white/20
                transition
                px-2 md:px-4 py-3 rounded-xl
                text-sm md:text-base">

            Dasbor

        </a>

            <a href="{{ route('guru.kehadiran') }}"
            class="flex justify-center md:justify-start items-center gap-3
                    bg-white/10
                    hover:bg-white/20
                    transition
                    px-2 md:px-4 py-3 rounded-xl
                    text-sm md:text-base">

                ▣ Kehadiran

            </a>

            <a href="{{ route('guru.pelatihan.index') }}"
                class="flex justify-center md:justify-start items-center gap-3
                    bg-white/10
                    hover:bg-white/20
                    transition
                    px-2 md:px-4 py-3 rounded-xl
                    text-sm md:text-base">

            ▣ Pelatihan

        </a>
            <a href="{{ route('guru.cuti') }}"
                class="flex justify-center md:justify-start items-center gap-3
                    bg-white/10
                    hover:bg-white/20
                    transition
                    px-2 md:px-4 py-3 rounded-xl
                    text-sm md:text-base">

            ▣ Cuti

        </a>

        <a href="{{ route('guru.hasil_penilaian') }}"
                class="flex justify-center md:justify-start items-center gap-3
                bg-white/10
                hover:bg-white/20
                transition
                px-2 md:px-4 py-3 rounded-xl
                text-sm md:text-base">

            ▣ Hasil Penilaian Kinerja

        </a>

        
    </div>

    {{-- PROFILE --}}
    <div class="absolute bottom-0 left-0 w-20 md:w-64
                p-5 border-t border-green-600">

        <div class="flex items-center justify-between">

            <div class="flex items-center gap-3">

                <div class="hidden md:block">

                    @if(auth()->user()->foto)

        <img src="{{ asset('images/'.auth()->user()->foto) }}"
             alt="Profile"
             class="w-12
                    h-12
                    rounded-full
                    object-cover
                    border-2
                    border-white">

    @else

        <div class="w-12
                    h-12
                    rounded-full
                    bg-white/30
                    flex
                    items-center
                    justify-center">

            👤

        </div>

    @endif

</div>

                <div class="hidden md:block">

                    <h1 class="font-semibold text-sm">

                        {{ auth()->user()->name }}

                    </h1>

                    <p class="text-xs text-green-100">

                        Guru/Staff

                    </p>

                </div>

            </div>

            {{-- LOGOUT --}}
            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                        class="text-xl hover:text-red-300 transition">

                    ⎋

                </button>

            </form>

        </div>

    </div>

</aside>
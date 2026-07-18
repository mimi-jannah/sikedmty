<aside class="w-64 min-h-screen
              bg-gradient-to-b
              from-green-800
              to-emerald-700
              text-white
              relative shadow-2xl">

    {{-- LOGO --}}
    <div class="p-6 border-b border-green-600">

        <div class="flex items-center gap-3">

            <img src="{{ asset('images/LogoSekolah.jpeg') }}"
                 class="w-14 h-14 object-contain">

            <div>

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

        <a href="{{ route('tata_usaha.dashboard') }}"
           class="flex items-center gap-3
                  bg-white/10
                  hover:bg-white/20
                  transition
                  px-4 py-3 rounded-xl">

            ▣ Dasbor

        </a>

        <a href="{{ route('tata_usaha.data_guru') }}"
           class="flex items-center gap-3
                  bg-white/10
                  hover:bg-white/20
                  transition
                  px-4 py-3 rounded-xl">

            ▣ Data Guru/Staff

        </a>

        <a href="{{ route('tata_usaha.pelatihan') }}"
           class="flex items-center gap-3
                  bg-white/10
                  hover:bg-white/20
                  transition
                  px-4 py-3 rounded-xl">

            ▣ Data Pelatihan

        </a>

            <a href="{{ route('tata_usaha.kinerja.index') }}"
                class="flex items-center gap-3
                bg-white/10
                hover:bg-white/20
                transition
                px-4 py-3 rounded-xl">

            ▣ Data Kinerja

        </a>

        <a href="{{ route('tata_usaha.laporan_kehadiran') }}"
                class="flex items-center gap-3
                bg-white/10
                hover:bg-white/20
                transition
                px-4 py-3 rounded-xl">

            ▣ Data Kehadiran

        </a>

        

    </div>

    {{-- PROFILE --}}
    <div class="absolute bottom-0 left-0 w-64
                p-5 border-t border-green-600">

        <div class="flex items-center justify-between">

            <div class="flex items-center gap-3">

                <img src="{{ asset('images/TataUsaha.png') }}"
                    alt="Profile"
                    class="w-10 h-10 rounded-full object-cover border-2 border-white">

                <div>

                    <h1 class="font-semibold text-sm">

                        {{ auth()->user()->name }}

                    </h1>

                    <p class="text-xs text-green-100">

                        Tata Usaha

                    </p>

                </div>

            </div>

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
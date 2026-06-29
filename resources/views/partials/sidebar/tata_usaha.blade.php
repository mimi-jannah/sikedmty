<aside
class="fixed
       top-0
       left-0
       h-screen
       w-72
       bg-gradient-to-b
       from-green-800
       to-emerald-700
       text-white
       shadow-2xl
       flex
       flex-col">

    {{-- LOGO --}}
    <div class="px-6 py-5 border-b border-green-700 flex-shrink-0">

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
    <div class="flex-1 overflow-y-auto px-4 py-5 space-y-3">

        <a href="{{ route('tata_usaha.dashboard') }}"
            class="flex items-center gap-3
                px-4 py-3
                rounded-xl
                transition-all duration-200
                hover:bg-white/20
                hover:translate-x-1">

            ▣ Dasbor

        </a>

        <a href="{{ route('tata_usaha.data_guru') }}"
           class="flex items-center gap-3
                px-4 py-3
                rounded-xl
                transition-all duration-200
                hover:bg-white/20
                hover:translate-x-1">

            ▣ Data Guru/Staff

        </a>

        <a href="{{ route('tata_usaha.pelatihan') }}"
           class="flex items-center gap-3
                px-4 py-3
                rounded-xl
                transition-all duration-200
                hover:bg-white/20
                hover:translate-x-1">

            ▣ Data Pelatihan

        </a>

            <a href="{{ route('tu.kinerja') }}"
                class="flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    transition-all duration-200
                    hover:bg-white/20
                    hover:translate-x-1">

            ▣ Data Kinerja

        </a>

        <a href="{{ route('tata_usaha.laporan_kehadiran') }}"
                class="flex items-center gap-3
                    px-4 py-3
                    rounded-xl
                    transition-all duration-200
                    hover:bg-white/20
                    hover:translate-x-1">

            ▣ Data Kehadiran

        </a>

        <a href="{{ route('tata_usaha.kelas.index') }}"
                class="flex items-center gap-3
                px-4 py-3
                rounded-xl
                transition-all duration-200
                hover:bg-white/20
                hover:translate-x-1">

            ▣ Daftar Kelas

        </a>

        <a href="{{ route('tata-usaha.mapel') }}"
            class="flex items-center gap-3
                px-4 py-3
                rounded-xl
                transition-all duration-200
                hover:bg-white/20
                hover:translate-x-1">

            ▣ Mata Pelajaran

        </a>

        <a href="#"
           class="flex items-center gap-3
            px-4 py-3
            rounded-xl
            transition-all duration-200
            hover:bg-white/20
            hover:translate-x-1">

            ▣ Data Perizinan

        </a>

    </div>

    {{-- PROFILE --}}
    <div class="mt-auto
            border-t
            border-green-700
            p-5
            flex-shrink-0">

        <div class="flex items-center justify-between">

            <div class="flex items-center gap-3">

                <img src="{{ asset('images/wosok.jpg') }}"
                    alt="Profile"
                    class="w-12 h-12 rounded-full object-cover border-2 border-white">

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

                <button
                    class="w-10
                        h-10
                        rounded-full
                        bg-white/10
                        hover:bg-red-500
                        transition">

                    ⎋
            </button>

        </form>

        </div>

    </div>

</aside>
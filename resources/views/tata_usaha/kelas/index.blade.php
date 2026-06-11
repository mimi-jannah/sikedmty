@extends('layouts.app')

@section('content')

<div class="p-8">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-5xl font-bold text-slate-800">
            Daftar Kelas
        </h1>

        <a href="{{ route('tata_usaha.kelas.create') }}"
           class="bg-black
                  text-white
                  px-6 py-3
                  rounded-2xl
                  font-bold
                  hover:bg-gray-800
                  transition">

            + Tambah Daftar Kelas

        </a>

    </div>

    {{-- TOOLBAR --}}
    <div class="flex justify-between items-center mb-5">

        {{-- BUTTON --}}
        <div class="flex items-center gap-3">

            {{-- EDIT --}}
            <button id="btnEdit"
                    class="bg-gray-100
                           text-gray-400
                           px-5 py-2
                           rounded-xl
                           font-semibold
                           cursor-not-allowed"
                    disabled>

                Edit

            </button>

            {{-- HAPUS --}}
            <button id="btnHapus"
                    class="bg-gray-100
                           text-gray-400
                           px-5 py-2
                           rounded-xl
                           font-semibold
                           cursor-not-allowed"
                    disabled>

                Hapus

            </button>

        </div>

        {{-- SEARCH --}}
        <div class="relative">

            <input type="text"
                   id="searchInput"
                   placeholder="Cari kelas, wali kelas, guru..."
                   class="pl-10
                          pr-4
                          py-2
                          rounded-xl
                          border
                          border-gray-300
                          w-72
                          focus:outline-none">

            <span class="absolute left-3 top-2.5 text-gray-400">
                🔍
            </span>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <table class="w-full">

            {{-- HEAD --}}
            <thead class="bg-slate-100">

                <tr>

                    <th class="p-5">
                        <input type="checkbox" id="checkAll">
                    </th>

                    <th class="p-5 text-left">No</th>
                    <th class="p-5 text-left">Kelas</th>
                    <th class="p-5 text-left">Total Siswa</th>
                    <th class="p-5 text-left">Wali Kelas</th>
                    <th class="p-5 text-left">Guru</th>
                    <th class="p-5 text-left">Jam Mengajar</th>
                    <th class="p-5 text-left">Hari Mengajar</th>

                </tr>

            </thead>

            {{-- BODY --}}
            <tbody id="tableBody">

                @foreach($kelas as $item)

                <tr class="border-t hover:bg-slate-50 transition data-row">

                    {{-- CHECKBOX --}}
                    <td class="p-5">

                        <input type="checkbox"
                               class="row-checkbox"
                               value="{{ $item->id }}">

                    </td>

                    {{-- NO --}}
                    <td class="p-5">
                        {{ $loop->iteration }}
                    </td>

                    {{-- KELAS --}}
                    <td class="p-5 font-semibold">
                        {{ $item->nama_kelas }}
                    </td>

                    {{-- TOTAL --}}
                    <td class="p-5">
                        {{ $item->total_siswa }}
                    </td>

                    {{-- WALI --}}
                    <td class="p-5">
                        {{ $item->wali_kelas }}
                    </td>

                    {{-- GURU --}}
                    <td class="p-5">
                        {{ $item->guru }}
                    </td>

                    {{-- JAM --}}
                    <td class="p-5">
                        {{ $item->jam_mengajar }}
                    </td>

                    {{-- HARI --}}
                    <td class="p-5">
                        {{ $item->hari_mengajar }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

{{-- SCRIPT --}}
<script>

    const checkboxes = document.querySelectorAll('.row-checkbox');
    const btnEdit = document.getElementById('btnEdit');
    const btnHapus = document.getElementById('btnHapus');

    checkboxes.forEach(box => {

        box.addEventListener('change', () => {

            const checked =
                document.querySelectorAll('.row-checkbox:checked');

            /*
            |--------------------------------------------------------------------------
            | EDIT
            |--------------------------------------------------------------------------
            */

            if (checked.length === 1) {

                btnEdit.disabled = false;

                btnEdit.classList.remove(
                    'bg-gray-100',
                    'text-gray-400',
                    'cursor-not-allowed'
                );

                btnEdit.classList.add(
                    'bg-yellow-500',
                    'text-white'
                );

                btnEdit.onclick = () => {

                    window.location.href =
                        `/tata-usaha/kelas/${checked[0].value}/edit`;
                };

            }

            else {

                btnEdit.disabled = true;

                btnEdit.classList.add(
                    'bg-gray-100',
                    'text-gray-400',
                    'cursor-not-allowed'
                );

                btnEdit.classList.remove(
                    'bg-yellow-500',
                    'text-white'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | HAPUS
            |--------------------------------------------------------------------------
            */

            if (checked.length >= 1) {

                btnHapus.disabled = false;

                btnHapus.classList.remove(
                    'bg-gray-100',
                    'text-gray-400',
                    'cursor-not-allowed'
                );

                btnHapus.classList.add(
                    'bg-red-500',
                    'text-white'
                );

                btnHapus.onclick = () => {

                    if(confirm('Yakin ingin hapus data kelas?')) {

                        window.location.href =
                            `/tata-usaha/kelas/${checked[0].value}/hapus`;
                    }
                };

            }

            else {

                btnHapus.disabled = true;

                btnHapus.classList.add(
                    'bg-gray-100',
                    'text-gray-400',
                    'cursor-not-allowed'
                );

                btnHapus.classList.remove(
                    'bg-red-500',
                    'text-white'
                );
            }

        });

    });

    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('keyup', function() {

        let value = this.value.toLowerCase();

        let rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {

            row.style.display =
                row.innerText.toLowerCase().includes(value)
                ? ''
                : 'none';
        });

    });

</script>

@endsection
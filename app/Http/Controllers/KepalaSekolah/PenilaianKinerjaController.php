<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenilaianKinerja;
use App\Models\User;
use App\Models\Kehadiran;
use App\Models\Cuti;
use Carbon\Carbon;

class PenilaianKinerjaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PENILAIAN KINERJA
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        // =========================================================
        // QUERY DATA PENILAIAN
        // =========================================================

        $query = PenilaianKinerja::with('user');


        // =========================================================
        // CARI NAMA GURU
        // =========================================================

        if ($request->filled('search')) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where(
                    'name',
                    'like',
                    '%' . $request->search . '%'
                );

            });
        }


        // =========================================================
        // FILTER JABATAN
        // =========================================================

        if ($request->filled('jabatan')) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where(
                    'jabatan',
                    $request->jabatan
                );

            });
        }


        // =========================================================
        // FILTER TANGGAL PENILAIAN
        // =========================================================

        if ($request->filled('tanggal_penilaian')) {

            $query->whereDate(
                'tanggal_penilaian',
                $request->tanggal_penilaian
            );
        }


        // =========================================================
        // SORTING
        // =========================================================

        if ($request->sort == 'terbaru') {

            $query->orderBy(
                'tanggal_penilaian',
                'desc'
            );

        } elseif ($request->sort == 'terlama') {

            $query->orderBy(
                'tanggal_penilaian',
                'asc'
            );

        } elseif ($request->sort == 'nilai_desc') {

            $query->orderBy(
                'nilai',
                'desc'
            );

        } elseif ($request->sort == 'nilai_asc') {

            $query->orderBy(
                'nilai',
                'asc'
            );

        } elseif ($request->sort == 'nama_asc') {

            $query->join(
                'users',
                'users.id',
                '=',
                'penilaian_kinerjas.user_id'
            )
            ->orderBy(
                'users.name',
                'asc'
            )
            ->select(
                'penilaian_kinerjas.*'
            );

        } elseif ($request->sort == 'nama_desc') {

            $query->join(
                'users',
                'users.id',
                '=',
                'penilaian_kinerjas.user_id'
            )
            ->orderBy(
                'users.name',
                'desc'
            )
            ->select(
                'penilaian_kinerjas.*'
            );

        } else {

            $query->latest();
        }


        // =========================================================
        // DATA PENILAIAN
        // =========================================================

        $penilaians = $query
            ->paginate(10)
            ->withQueryString();


        // =========================================================
        // DATA GURU
        // =========================================================

        $gurus = User::whereHas('role', function ($q) {

            $q->where(
                'slug',
                'guru'
            );

        })->get();


        // =========================================================
        // PERIODE REKAP
        // =========================================================

        $periode = $request->input(
            'periode',
            now()->format('Y-m')
        );


        // Cek format periode
        try {

            $tanggalPeriode = Carbon::createFromFormat(
                'Y-m',
                $periode
            );

        } catch (\Exception $e) {

            $periode = now()->format('Y-m');

            $tanggalPeriode = Carbon::createFromFormat(
                'Y-m',
                $periode
            );
        }


        $bulan = $tanggalPeriode->month;

        $tahun = $tanggalPeriode->year;

        $selectedUserId = $request->input('user_id');


        // =========================================================
        // REKAP KEHADIRAN BERDASARKAN BULAN YANG DIPILIH
        // =========================================================

        $rekapKehadiran = Kehadiran::whereMonth(
                'tanggal',
                $bulan
            )
            ->whereYear(
                'tanggal',
                $tahun
            )
            ->selectRaw("
                user_id,

                SUM(
                    CASE
                        WHEN status = 'Berhasil'
                        THEN 1
                        ELSE 0
                    END
                ) AS hadir,

                SUM(
                    CASE
                        WHEN status = 'Terlambat'
                        THEN 1
                        ELSE 0
                    END
                ) AS terlambat
            ")
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');


        // =========================================================
        // REKAP CUTI BERDASARKAN BULAN YANG DIPILIH
        // =========================================================

        $rekapCuti = Cuti::whereMonth(
                'tanggal_mulai',
                $bulan
            )
            ->whereYear(
                'tanggal_mulai',
                $tahun
            )
            ->selectRaw("
                user_id,
                COUNT(*) AS total_cuti
            ")
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        $rekapHadirTerpilih = 0;
$rekapTerlambatTerpilih = 0;
$rekapCutiTerpilih = 0;

if ($selectedUserId) {

    $dataKehadiran = $rekapKehadiran
        ->get($selectedUserId);

    if ($dataKehadiran) {

        $rekapHadirTerpilih =
            (int) $dataKehadiran->hadir;

        $rekapTerlambatTerpilih =
            (int) $dataKehadiran->terlambat;
    }


    $dataCuti = $rekapCuti
        ->get($selectedUserId);

    if ($dataCuti) {

        $rekapCutiTerpilih =
            (int) $dataCuti->total_cuti;
    }
}


        // =========================================================
        // TAMPILKAN HALAMAN
        // =========================================================

        return view(
    'kepala_sekolah.kinerja.index',
    compact(
        'penilaians',
        'gurus',
        'rekapKehadiran',
        'rekapCuti',
        'periode',
        'selectedUserId',
        'rekapHadirTerpilih',
        'rekapTerlambatTerpilih',
        'rekapCutiTerpilih'
    )
);
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENILAIAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'user_id' => 'required|exists:users,id',

            'tanggal_penilaian' => 'required|date',

            'deskripsi' => 'required',

            'nilai' => 'required|integer|min:0|max:100',

        ]);


        // =========================================================
        // KATEGORI NILAI
        // =========================================================

        if ($request->nilai >= 90) {

            $kategori = 'Sangat Baik';

        } elseif ($request->nilai >= 80) {

            $kategori = 'Baik';

        } elseif ($request->nilai >= 70) {

            $kategori = 'Cukup';

        } else {

            $kategori = 'Kurang';
        }


        // =========================================================
        // SIMPAN DATA
        // =========================================================

        PenilaianKinerja::create([

            'user_id' => $request->user_id,

            'tanggal_penilaian' =>
                $request->tanggal_penilaian,

            'deskripsi' =>
                $request->deskripsi,

            'nilai' =>
                $request->nilai,

            'kategori' =>
                $kategori,

        ]);


        return redirect()
            ->route('kinerja.index')
            ->with(
                'success',
                'Penilaian berhasil disimpan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PENILAIAN
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        // =========================================================
        // DATA PENILAIAN YANG AKAN DIEDIT
        // =========================================================

        $penilaian =
            PenilaianKinerja::findOrFail($id);


        // =========================================================
        // DATA PENILAIAN
        // =========================================================

        $penilaians =
            PenilaianKinerja::with('user')
                ->latest()
                ->paginate(10)
                ->withQueryString();


        // =========================================================
        // DATA GURU
        // =========================================================

        $gurus =
            User::whereHas('role', function ($q) {

                $q->where(
                    'slug',
                    'guru'
                );

            })->get();


        // =========================================================
        // PERIODE REKAP
        // =========================================================

        $periode = request()->input(
            'periode',
            now()->format('Y-m')
        );


        try {

            $tanggalPeriode = Carbon::createFromFormat(
                'Y-m',
                $periode
            );

        } catch (\Exception $e) {

            $periode = now()->format('Y-m');

            $tanggalPeriode = Carbon::createFromFormat(
                'Y-m',
                $periode
            );
        }


        $bulan = $tanggalPeriode->month;

        $tahun = $tanggalPeriode->year;


        // =========================================================
        // REKAP KEHADIRAN
        // =========================================================

        $rekapKehadiran = Kehadiran::whereMonth(
                'tanggal',
                $bulan
            )
            ->whereYear(
                'tanggal',
                $tahun
            )
            ->selectRaw("
                user_id,

                SUM(
                    CASE
                        WHEN status = 'Berhasil'
                        THEN 1
                        ELSE 0
                    END
                ) AS hadir,

                SUM(
                    CASE
                        WHEN status = 'Terlambat'
                        THEN 1
                        ELSE 0
                    END
                ) AS terlambat
            ")
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');


        // =========================================================
        // REKAP CUTI
        // =========================================================

        $rekapCuti = Cuti::whereMonth(
                'tanggal_mulai',
                $bulan
            )
            ->whereYear(
                'tanggal_mulai',
                $tahun
            )
            ->selectRaw("
                user_id,
                COUNT(*) AS total_cuti
            ")
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');


        return view(
            'kepala_sekolah.kinerja.index',
            compact(
                'penilaian',
                'penilaians',
                'gurus',
                'rekapKehadiran',
                'rekapCuti',
                'periode'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PENILAIAN
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $id
    ) {

        $request->validate([

            'user_id' =>
                'required|exists:users,id',

            'tanggal_penilaian' =>
                'required|date',

            'deskripsi' =>
                'required',

            'nilai' =>
                'required|integer|min:0|max:100',

        ]);


        // =========================================================
        // KATEGORI NILAI
        // =========================================================

        if ($request->nilai >= 90) {

            $kategori = 'Sangat Baik';

        } elseif ($request->nilai >= 80) {

            $kategori = 'Baik';

        } elseif ($request->nilai >= 70) {

            $kategori = 'Cukup';

        } else {

            $kategori = 'Kurang';
        }


        // =========================================================
        // CARI DATA
        // =========================================================

        $penilaian =
            PenilaianKinerja::findOrFail($id);


        // =========================================================
        // UPDATE
        // =========================================================

        $penilaian->update([

            'user_id' =>
                $request->user_id,

            'tanggal_penilaian' =>
                $request->tanggal_penilaian,

            'deskripsi' =>
                $request->deskripsi,

            'nilai' =>
                $request->nilai,

            'kategori' =>
                $kategori,

        ]);


        return redirect()
            ->route('kinerja.index')
            ->with(
                'success',
                'Penilaian berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS PENILAIAN
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $penilaian =
            PenilaianKinerja::findOrFail($id);


        $penilaian->delete();


        return redirect()
            ->route('kinerja.index')
            ->with(
                'success',
                'Data penilaian berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL PENILAIAN
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $penilaian =
            PenilaianKinerja::with('user')
                ->findOrFail($id);


        return view(
            'kepala_sekolah.kinerja.show',
            compact('penilaian')
        );
    }
}
<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kehadiran;
use App\Models\Cuti;
use App\Models\Kinerja;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | TOTAL GURU / STAFF
        |--------------------------------------------------------------------------
        */

        $totalGuru = User::whereHas('role', function ($q) {
            $q->where('slug', 'guru');
        })->count();


        /*
        |--------------------------------------------------------------------------
        | DATA KEHADIRAN HARI INI
        |--------------------------------------------------------------------------
        */

        $tanggalHariIni = now()->toDateString();


        // Hadir tepat waktu
        $totalHadir = Kehadiran::whereDate(
            'tanggal',
            $tanggalHariIni
        )
        ->where('status', 'Berhasil')
        ->count();


        // Terlambat
        $totalTerlambat = Kehadiran::whereDate(
            'tanggal',
            $tanggalHariIni
        )
        ->where('status', 'Terlambat')
        ->count();


        /*
        |--------------------------------------------------------------------------
        | KETIDAKHADIRAN
        |--------------------------------------------------------------------------
        |
        | Guru yang belum memiliki data kehadiran pada hari ini.
        |
        */

        $guruSudahKehadiran = Kehadiran::whereDate(
            'tanggal',
            $tanggalHariIni
        )
        ->distinct('user_id')
        ->count('user_id');


        $totalTidakHadir = max(
            0,
            $totalGuru - $guruSudahKehadiran
        );


        /*
        |--------------------------------------------------------------------------
        | TOTAL CUTI
        |--------------------------------------------------------------------------
        */

        $totalCuti = Cuti::count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL PELATIHAN / KINERJA
        |--------------------------------------------------------------------------
        */

        $totalPelatihan = Kinerja::count();


        /*
        |--------------------------------------------------------------------------
        | MONITORING KEHADIRAN
        |--------------------------------------------------------------------------
        |
        | Mengambil data kehadiran terbaru sekaligus data guru
        | dan lokasi kehadiran.
        |
        */

        $monitoring = Kehadiran::with('user')
            ->latest()
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view(
            'kepala_sekolah.dashboard.index',
            compact(
                'totalGuru',
                'totalHadir',
                'totalTerlambat',
                'totalTidakHadir',
                'totalCuti',
                'totalPelatihan',
                'monitoring'
            )
        );
    }
}
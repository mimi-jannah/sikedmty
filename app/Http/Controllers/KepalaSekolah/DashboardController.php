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
        $totalGuru = User::whereHas('role', function ($q) {
            $q->where('slug', 'guru');
        })->count();

        $totalHadir = Kehadiran::whereDate(
            'tanggal',
            now()->toDateString()
        )->count();

        $totalCuti = Cuti::count();

        $totalPelatihan = Kinerja::count();

        $monitoring = Kehadiran::latest()
                        ->take(10)
                        ->get();

    return view(
    'kepala_sekolah.dashboard.index',
    compact(
        'totalGuru',
        'totalHadir',
        'totalCuti',
        'totalPelatihan',
        'monitoring'
    )
);
    }
}
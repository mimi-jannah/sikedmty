<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use App\Models\Kelas;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalKehadiran = Kehadiran::where('user_id', $user->id)->count();

        $hadir = Kehadiran::where('user_id', $user->id)
                    ->where('status', 'Berhasil')
                    ->count();

        $terlambat = Kehadiran::where('user_id', $user->id)
                        ->where('status', 'Terlambat')
                        ->count();

        $totalKelas = Kelas::where('guru', $user->name)->count();

        return view('guru.dashboard.index', compact(
            'totalKehadiran',
            'hadir',
            'terlambat',
            'totalKelas'
        ));
    }
}
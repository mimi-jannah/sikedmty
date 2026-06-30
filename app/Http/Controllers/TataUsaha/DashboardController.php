<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kehadiran;
use App\Models\Kelas;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGuru = User::count();

        $totalKehadiran = Kehadiran::count();

        return view('tata_usaha.dashboard.index', compact(
            'totalGuru',
            'totalKehadiran',
        ));
    }
}
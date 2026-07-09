<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelatihan;
use App\Models\User;

class PelatihanMonitoringController extends Controller
{
    public function index(Request $request)
    {
        $pelatihans = Pelatihan::with('user')
                        ->latest()
                        ->get();

        // Total data pelatihan
        $totalPelatihan = Pelatihan::count();

        // Jumlah guru yang pernah mengikuti pelatihan
        $guruMengikuti = User::where('jabatan', 'Guru')
                                ->whereHas('pelatihans')
                                ->count();

        // Jumlah staff yang pernah mengikuti pelatihan
        $staffMengikuti = User::where('jabatan', 'Staff')
                                ->whereHas('pelatihans')
                                ->count();
        
        if ($request->filled('detail')) {
            $detail = Pelatihan::with('user')
                        ->find($request->detail);
        } else {
            $detail = $pelatihans->first();
        }

        return view(
            'kepala_sekolah.pelatihan.index',
            compact(
                'pelatihans',
                'totalPelatihan',
                'guruMengikuti',
                'staffMengikuti',
                'detail'
            )
        );
    }

        
}
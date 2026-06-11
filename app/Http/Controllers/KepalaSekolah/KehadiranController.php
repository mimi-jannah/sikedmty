<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use App\Models\User;

class KehadiranController extends Controller
{
    public function index()
    {
        $guru = User::where('jabatan', 'guru')->get();

        return view(
            'kepala_sekolah.kehadiran.index',
            compact('guru')
        );
    }

    public function detail($id)
    {
        $guru = User::findOrFail($id);

        $riwayat = Kehadiran::where('user_id', $id)
                    ->latest()
                    ->get();

        return view(
            'kepala_sekolah.kehadiran.detail',
            compact('guru', 'riwayat')
        );
    }
}
<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kehadiran;
use App\Exports\KehadiranExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKehadiranController extends Controller
{
    public function index()
    {
        $gurus = \App\Models\User::whereNotNull('jabatan')->get();

        return view('tata_usaha.laporan_kehadiran.index', compact('gurus'));
    }

    public function detail($id)
    {
        $guru = User::findOrFail($id);

        $riwayat = Kehadiran::where('user_id', $id)
                    ->latest()
                    ->get();

        return view(
            'tata_usaha.laporan_kehadiran.detail',
            compact('guru', 'riwayat')
        );
    }

    public function export($id)
    {
        return Excel::download(
            new KehadiranExport($id),
            'laporan-kehadiran.xlsx'
        );
    }

}
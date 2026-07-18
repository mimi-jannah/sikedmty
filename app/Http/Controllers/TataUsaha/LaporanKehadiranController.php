<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kehadiran;
use App\Models\Cuti;
use App\Exports\KehadiranExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKehadiranController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->tanggal ?? now()->toDateString();
        $search = $request->search;

        $gurus = User::whereNotNull('jabatan')
            ->with([
                'kehadirans' => function ($q) use ($tanggal) {
                    $q->whereDate('tanggal', $tanggal);
                }
            ])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                          ->orWhere('jabatan', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->get();

        $totalGuru = User::whereNotNull('jabatan')->count();

        $berhasil = Kehadiran::whereDate('tanggal', $tanggal)
            ->where('status', 'Berhasil')
            ->count();

        $terlambat = Kehadiran::whereDate('tanggal', $tanggal)
            ->where('status', 'Terlambat')
            ->count();

        $cuti = Cuti::count();

        return view(
            'tata_usaha.laporan_kehadiran.index',
            compact(
                'gurus',
                'tanggal',
                'totalGuru',
                'berhasil',
                'terlambat',
                'cuti'
            )
        );
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
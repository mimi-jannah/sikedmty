<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenilaianKinerja;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PenilaianKinerjaController extends Controller
{
    public function index(Request $request)
    {
        $penilaians = PenilaianKinerja::with('user')
                        ->latest()
                        ->paginate(10);

        $totalPenilaian = PenilaianKinerja::count();

        $guruSudahDinilai = PenilaianKinerja::distinct('user_id')
                                    ->count('user_id');

        $guru = User::where('jabatan','Guru')->count();

        $belumDinilai = $guru - $guruSudahDinilai;

        $rataRata = round(
            PenilaianKinerja::avg('nilai'),
            2
        );

        if ($request->filled('detail')) {

            $detail = PenilaianKinerja::with('user')
                ->find($request->detail);

        } else {

            $detail = $penilaians->first();

        }

        return view(
            'tata_usaha.kinerja.index',
            compact(
                'penilaians',
                'totalPenilaian',
                'guruSudahDinilai',
                'belumDinilai',
                'rataRata',
                'detail'
            )
        );
    }

        public function pdf($id)
    {
        $penilaian = PenilaianKinerja::with('user')->findOrFail($id);

        $pdf = Pdf::loadView(
            'tata_usaha.kinerja.pdf',
            compact('penilaian')
        );

        return $pdf->download(
            'Laporan Penilaian Kinerja.pdf'
        );
    }
}
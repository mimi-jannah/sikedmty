<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\PenilaianKinerja;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilPenilaianController extends Controller
{
    public function index()
    {
        $penilaian = PenilaianKinerja::where('user_id', Auth::id())
                        ->latest()
                        ->first();

        return view(
            'guru.hasil_penilaian.index',
            compact('penilaian')
        );
    }

        public function pdf()
    {
        $penilaian = \App\Models\PenilaianKinerja::with('user')
                        ->where('user_id', auth()->id())
                        ->latest()
                        ->firstOrFail();

        $pdf = Pdf::loadView(
            'guru.kinerja.pdf',
            compact('penilaian')
        );

        return $pdf->stream('Hasil_Penilaian_Kinerja.pdf');
    }
}
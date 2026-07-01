<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\PenilaianKinerja;
use Illuminate\Support\Facades\Auth;

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
}
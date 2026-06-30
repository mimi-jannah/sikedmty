<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;

class CutiKepsekController extends Controller
{
    public function index()
    {
        $cutis = Cuti::latest()->get();

        return view(
            'kepala_sekolah.cuti_kepsek.index',
            compact('cutis')
        );
    }

    public function setujui($id)
    {
        $cuti = Cuti::findOrFail($id);

        $cuti->update([

            'status' => 'Disetujui'

        ]);

        return back()->with(
        'success',
        'Perizinan Disetujui'
    );
        }

    public function tolak($id)
    {
        $cuti = Cuti::findOrFail($id);

        $cuti->update([

            'status' => 'Ditolak'

        ]);

            return back()->with(
            'error',
            'Perizinan Ditolak'
        );
    }
}
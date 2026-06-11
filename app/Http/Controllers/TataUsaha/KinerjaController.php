<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\Kinerja;
use Illuminate\Http\Request;

class KinerjaController extends Controller
{
    public function index()
    {
        $kinerjas = Kinerja::latest()->get();

        return view('tata_usaha.kinerja.index', compact('kinerjas'));
    }

    public function store(Request $request)
{
    Kinerja::create([

        'user_id' => auth()->id(),

        'kategori' => $request->kategori,

        'tanggal' => $request->tanggal,

        'guru_staff' => $request->guru_staff,

        'nama_pelatihan' => $request->nama_pelatihan,

        'deskripsi' => $request->deskripsi,

        'penyelenggara' => $request->penyelgara,

        'lokasi' => $request->lokasi,

        'status' => 'Menunggu'

    ]);

    return redirect()->back();
}
}
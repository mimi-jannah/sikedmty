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
    $request->validate([
        'nama_form' => 'required',
        'semester' => 'required',
        'tahun_ajaran' => 'required',
        'keterangan' => 'nullable'
    ]);

    Kinerja::create([

        'nama_form'      => $request->nama_form,
        'semester'       => $request->semester,
        'tahun_ajaran'   => $request->tahun_ajaran,
        'keterangan'     => $request->keterangan,
        'status'         => 'Aktif',

    ]);

    return redirect()->back()->with('success','Form penilaian berhasil ditambahkan.');
}
}
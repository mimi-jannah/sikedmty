<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN DAFTAR KELAS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $kelas = Kelas::latest()->get();

        return view(
            'tata_usaha.kelas.index',
            compact('kelas')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH KELAS
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('tata_usaha.kelas.create');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN KELAS
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        Kelas::create([

            'nama_kelas'   => $request->nama_kelas,
            'total_siswa'  => $request->total_siswa,
            'wali_kelas'   => $request->wali_kelas,
            'guru'         => $request->guru,
            'jam_mengajar' => $request->jam_mengajar,
            'hari_mengajar'=> $request->hari_mengajar,

        ]);

        return redirect()
            ->route('tata_usaha.kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit($id)
{
    $kelas = Kelas::findOrFail($id);

    return view('tata_usaha.kelas.edit', compact('kelas'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_kelas' => 'required',
        'total_siswa' => 'required',
        'wali_kelas' => 'required',
        'guru' => 'required',
        'jam_mengajar' => 'required',
        'hari_mengajar' => 'required',
    ]);

    $kelas = Kelas::findOrFail($id);

    $kelas->update([
        'nama_kelas' => $request->nama_kelas,
        'total_siswa' => $request->total_siswa,
        'wali_kelas' => $request->wali_kelas,
        'guru' => $request->guru,
        'jam_mengajar' => $request->jam_mengajar,
        'hari_mengajar' => $request->hari_mengajar,
    ]);

    return redirect()
        ->route('tata_usaha.kelas.index')
        ->with('success', 'Daftar kelas berhasil diupdate');
}

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        return redirect()
            ->route('tata_usaha.kelas.index')
            ->with('success', 'Daftar kelas berhasil dihapus');
    }
}
<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mapel;

class MapelController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $mapels = Mapel::latest()->get();

        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('tata_usaha.mapel.index', compact(
            'mapels',
            'kelas'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
            Mapel::create([
            'kelas' => $request->kelas,
            'nama_mapel' => $request->nama_mapel,
        ]);

        return back()->with('success', 'Mata pelajaran berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([
            'kelas' => 'required',
            'nama_mapel' => 'required',
        ]);

        $mapel = Mapel::findOrFail($id);

        $mapel->update([
            'kelas' => $request->kelas,
            'nama_mapel' => $request->nama_mapel,
        ]);

        return back()->with(
            'success',
            'Data mata pelajaran berhasil diperbarui'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        Mapel::findOrFail($id)->delete();

        return back()->with(

            'success',

            'Data mata pelajaran berhasil dihapus'
        );
    }
}
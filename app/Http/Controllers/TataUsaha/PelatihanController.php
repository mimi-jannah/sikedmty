<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\Pelatihan;

class PelatihanController extends Controller
{
    public function index()
    {
        $pelatihans = Pelatihan::with('user')
                        ->latest()
                        ->get();

        return view(
            'tata_usaha.pelatihan.index',
            compact('pelatihans')
        );
    }

        public function update(Request $request,$id)
    {
        $pelatihan = Pelatihan::findOrFail($id);

        $data = [

            'tanggal_pelatihan'=>$request->tanggal_pelatihan,

            'nama_pelatihan'=>$request->nama_pelatihan,

            'deskripsi'=>$request->deskripsi,

            'penyelenggara'=>$request->penyelenggara,

            'lokasi'=>$request->lokasi,

        ];

        if($request->hasFile('sertifikat'))
        {
            $data['sertifikat']=$request
                ->file('sertifikat')
                ->store('sertifikat','public');
        }

        $pelatihan->update($data);

        return back()->with(
            'success',
            'Data berhasil diperbarui'
        );
    }

    public function destroy($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);

        $pelatihan->delete();

        return back()->with(
            'success',
            'Data pelatihan berhasil dihapus.'
        );
    }
}
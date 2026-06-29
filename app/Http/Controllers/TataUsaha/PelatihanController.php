<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelatihan;
use App\Models\User;


class PelatihanController extends Controller
{
    public function index()
{
    $pelatihans = Pelatihan::with('user')
                    ->latest()
                    ->get();

    $gurus = User::whereHas('role', function ($q) {

        $q->where('slug', 'guru');

    })->orderBy('name')->get();

    return view(
        'tata_usaha.pelatihan.index',
        compact(
            'pelatihans',
            'gurus'
        )
    );
}

        public function store(Request $request)
{
    $file = null;

    if ($request->hasFile('sertifikat')) {

        $file = $request
            ->file('sertifikat')
            ->store('sertifikat', 'public');
    }

    Pelatihan::create([

        'user_id'             => $request->user_id,

        'tanggal_pelatihan'   => $request->tanggal_pelatihan,

        'nama_pelatihan'      => $request->nama_pelatihan,

        'deskripsi'           => $request->deskripsi,

        'penyelenggara'       => $request->penyelenggara,

        'lokasi'              => $request->lokasi,

        'sertifikat'          => $file

    ]);

    return back()->with(
        'success',
        'Data pelatihan berhasil ditambahkan.'
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
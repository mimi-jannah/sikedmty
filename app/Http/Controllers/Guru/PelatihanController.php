<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelatihan;

class PelatihanController extends Controller
{
    public function index()
    {
        $pelatihans = Pelatihan::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        return view(
            'guru.pelatihan.index',
            compact('pelatihans')
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

            'user_id' => auth()->id(),

            'tanggal_pelatihan' => $request->tanggal_pelatihan,

            'nama_pelatihan' => $request->nama_pelatihan,

            'deskripsi' => $request->deskripsi,

            'penyelenggara' => $request->penyelenggara,

            'lokasi' => $request->lokasi,

            'sertifikat' => $file

        ]);

        return back()->with(
            'success',
            'Pelatihan berhasil ditambahkan'
        );
    }

    public function update(Request $request, $id)
    {
        $pelatihan = Pelatihan::findOrFail($id);

        $data = [

            'tanggal_pelatihan' => $request->tanggal_pelatihan,

            'nama_pelatihan' => $request->nama_pelatihan,

            'deskripsi' => $request->deskripsi,

            'penyelenggara' => $request->penyelenggara,

            'lokasi' => $request->lokasi,
        ];

            if ($request->hasFile('sertifikat')) {

        $file = $request
            ->file('sertifikat')
            ->store('sertifikat', 'public');

        dd($file);
    }

        $pelatihan->update($data);

        return back()->with(
            'success',
            'Data berhasil diperbarui'
        );
    }
}
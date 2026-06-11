<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;

class CutiController extends Controller
{
    public function index()
    {
        $cutis = Cuti::where('user_id', auth()->id())
                      ->latest()
                      ->get();

        return view('guru.cuti.index', compact('cutis'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'jenis' => 'required',

            'tanggal_mulai' => 'required|date',

            'tanggal_selesai' => 'required|date',

            'alasan' => 'required',

            'surat' => 'nullable|mimes:pdf,jpg,jpeg,png'

        ]);

        $surat = null;

        if ($request->hasFile('surat')) {

            $file = $request->file('surat');

            $surat = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('surat-cuti'), $surat);
        }

        Cuti::create([

            'user_id' => auth()->id(),

            'jenis' => $request->jenis,

            'tanggal_mulai' => $request->tanggal_mulai,

            'tanggal_selesai' => $request->tanggal_selesai,

            'alasan' => $request->alasan,

            'surat' => $surat,

            'status' => 'Menunggu'

        ]);

        return back()->with('success', 'Pengajuan berhasil dikirim');
    }
}
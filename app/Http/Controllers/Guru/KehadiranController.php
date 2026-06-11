<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kehadiran;

class KehadiranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN KEHADIRAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $riwayat = Kehadiran::where('user_id', auth()->id())
                    ->latest()
                    ->get();

        return view('guru.kehadiran.index', compact('riwayat'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN KEHADIRAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI JAM KEHADIRAN
        |--------------------------------------------------------------------------
        */

        $jamSekarang = now()->format('H:i');

        $status = '';

        // 07.00 - 07.30 = BERHASIL
        if ($jamSekarang >= '07:00' && $jamSekarang <= '07:30') {

            $status = 'Berhasil';
        }

        // 07.31 - 08.00 = TERLAMBAT
        elseif ($jamSekarang > '07:30' && $jamSekarang <= '08:00') {

            $status = 'Terlambat';
        }

        // SELAIN ITU = DITOLAK
        else {

            return back()->with(

                'error',

                'Kehadiran hanya bisa dilakukan pukul 07.00 - 08.00'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FOTO CAMERA
        |--------------------------------------------------------------------------
        */

        $foto = null;

        if ($request->foto_camera) {

            // CEK FOLDER
            if (!file_exists(public_path('storage/kehadiran'))) {

                mkdir(public_path('storage/kehadiran'), 0777, true);
            }

            $image = $request->foto_camera;

            $image = str_replace('data:image/png;base64,', '', $image);

            $image = str_replace(' ', '+', $image);

            $imageData = base64_decode($image);

            $namaFile = 'kehadiran/' . time() . '.png';

            file_put_contents(

                public_path('storage/' . $namaFile),

                $imageData
            );

            $foto = $namaFile;
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATABASE
        |--------------------------------------------------------------------------
        */
        if (!$request->lokasi) {

            return back()->with(
                'error',
                'Lokasi GPS belum terdeteksi. Aktifkan GPS lalu coba lagi.'
            );
        }


        Kehadiran::create([

            'user_id' => auth()->id(),

            'tanggal' => now()->toDateString(),

            'jam_masuk' => now()->format('H:i:s'),

            'status' => $status,

            'lokasi' => $request->lokasi,

            'bukti' => $foto,
        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return back()->with(

            'success',

            'Kehadiran ' . $status
        );
    }
}
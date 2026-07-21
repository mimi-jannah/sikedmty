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

        if (!$request->lokasi) {

            return back()->with(
                'error',
                'Lokasi GPS belum terdeteksi. Aktifkan GPS lalu coba lagi.'
            );
        }

        // Koordinat Sekolah
        $sekolahLat = env('SCHOOL_LAT');
        $sekolahLng = env('SCHOOL_LNG');
        $maxRadius = env('MAX_RADIUS', 100);

        // Lokasi dari browser
        [$userLat, $userLng] = explode(',', $request->lokasi);

        $userLat = (float) trim($userLat);
        $userLng = (float) trim($userLng);

        //koordinat kampus
        //Latitude  : 0.5711897654818395
        //Longitude : 101.42612908207548

        // ===========================
        // HITUNG JARAK (HAVERSINE)
        // ===========================

        $earthRadius = 6371000; // meter

        $dLat = deg2rad($userLat - $sekolahLat);
        $dLng = deg2rad($userLng - $sekolahLng);

        $a =
            sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($sekolahLat)) *
            cos(deg2rad($userLat)) *
            sin($dLng / 2) *
            sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $jarak = $earthRadius * $c;

        // Maksimal radius 100 meter
        if ($jarak > $maxRadius) {

            return back()->with(
                'error',
                'Anda berada di luar area MTSS Thamrin Yahya. Kehadiran hanya dapat dilakukan dalam radius ' . $maxRadius . ' meter dari sekolah.'
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

        return back()->with(

            'success',

            'Kehadiran ' . $status
        );
    }
}
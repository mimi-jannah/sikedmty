<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;
use Carbon\Carbon;

class CutiKepsekController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DATA CUTI
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $cutis = Cuti::with('user')
            ->latest()
            ->get();

        return view(
            'kepala_sekolah.cuti_kepsek.index',
            compact('cutis')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SETUJUI CUTI
    |--------------------------------------------------------------------------
    */

    public function setujui($id)
    {
        $cuti = Cuti::findOrFail($id);

        // Jika bukan jenis Cuti, tidak menggunakan kuota 12 hari
        if ($cuti->jenis !== 'Cuti') {

            $cuti->update([
                'status' => 'Disetujui'
            ]);

            return back()->with(
                'success',
                'Perizinan ' . $cuti->jenis . ' berhasil disetujui.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | KUOTA CUTI TAHUNAN
        |--------------------------------------------------------------------------
        */

        $kuotaCuti = 12;

        $tahun = Carbon::parse($cuti->tanggal_mulai)->year;


        /*
        |--------------------------------------------------------------------------
        | HITUNG CUTI YANG SUDAH DISETUJUI
        |--------------------------------------------------------------------------
        */

        $cutiTerpakai = Cuti::where('user_id', $cuti->user_id)

            ->where('jenis', 'Cuti')

            ->where('status', 'Disetujui')

            ->whereYear('tanggal_mulai', $tahun)

            ->get()

            ->sum(function ($data) {

                $mulai = Carbon::parse($data->tanggal_mulai);

                $selesai = Carbon::parse($data->tanggal_selesai);

                return $mulai->diffInDays($selesai) + 1;
            });


        /*
        |--------------------------------------------------------------------------
        | HITUNG JUMLAH HARI PENGAJUAN
        |--------------------------------------------------------------------------
        */

        $hariPengajuan =
            Carbon::parse($cuti->tanggal_mulai)
                ->diffInDays(
                    Carbon::parse($cuti->tanggal_selesai)
                ) + 1;


        /*
        |--------------------------------------------------------------------------
        | HITUNG SISA KUOTA
        |--------------------------------------------------------------------------
        */

        $sisaCuti = $kuotaCuti - $cutiTerpakai;


        /*
        |--------------------------------------------------------------------------
        | CEK KUOTA
        |--------------------------------------------------------------------------
        */

        if ($sisaCuti <= 0) {

            return back()->with(
                'error',
                'Pengajuan cuti ' . $cuti->user->name .
                ' tidak dapat disetujui karena kuota cuti tahunan ' .
                $kuotaCuti .
                ' hari sudah habis.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK JUMLAH HARI PENGAJUAN
        |--------------------------------------------------------------------------
        */

        if ($hariPengajuan > $sisaCuti) {

            return back()->with(
                'error',
                'Pengajuan cuti ' . $cuti->user->name .
                ' tidak dapat disetujui. Sisa kuota cuti hanya ' .
                $sisaCuti .
                ' hari, sedangkan pengajuan berlangsung selama ' .
                $hariPengajuan .
                ' hari.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PERSETUJUAN
        |--------------------------------------------------------------------------
        */

        $cuti->update([
            'status' => 'Disetujui'
        ]);


        return back()->with(
            'success',
            'Cuti ' . $cuti->user->name .
            ' berhasil disetujui. Sisa kuota cuti: ' .
            ($sisaCuti - $hariPengajuan) .
            ' hari.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TOLAK CUTI
    |--------------------------------------------------------------------------
    */

    public function tolak($id)
    {
        $cuti = Cuti::findOrFail($id);

        $cuti->update([
            'status' => 'Ditolak'
        ]);

        return back()->with(
            'error',
            'Perizinan ' . $cuti->user->name . ' ditolak.'
        );
    }
}
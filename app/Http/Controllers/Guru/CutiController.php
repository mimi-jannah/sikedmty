<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;
use Carbon\Carbon;

class CutiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | KUOTA CUTI TAHUNAN
    |--------------------------------------------------------------------------
    */

    private const KUOTA_CUTI_TAHUNAN = 12;


    /*
    |--------------------------------------------------------------------------
    | HALAMAN DATA CUTI
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $userId = auth()->id();

        $cutis = Cuti::where('user_id', $userId)
            ->latest()
            ->get();

        return view(
            'guru.cuti.index',
            compact('cutis')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG HARI KERJA
    |--------------------------------------------------------------------------
    |
    | Senin - Jumat dihitung.
    | Sabtu dan Minggu tidak dihitung.
    |
    */

    private function hitungHariKerja($tanggalMulai, $tanggalSelesai)
    {
        $mulai = Carbon::parse($tanggalMulai)->startOfDay();
        $selesai = Carbon::parse($tanggalSelesai)->startOfDay();

        $jumlahHari = 0;

        while ($mulai->lte($selesai)) {

            // 1 = Senin
            // 5 = Jumat
            if ($mulai->dayOfWeekIso <= 5) {
                $jumlahHari++;
            }

            $mulai->addDay();
        }

        return $jumlahHari;
    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG CUTI YANG SUDAH DISETUJUI
    |--------------------------------------------------------------------------
    */

    private function hitungCutiDisetujui($userId, $tahun)
    {
        $cutis = Cuti::where('user_id', $userId)
            ->where('jenis', 'Cuti')
            ->where('status', 'Disetujui')
            ->whereYear('tanggal_mulai', $tahun)
            ->get();

        $total = 0;

        foreach ($cutis as $cuti) {

            $total += $this->hitungHariKerja(
                $cuti->tanggal_mulai,
                $cuti->tanggal_selesai
            );
        }

        return $total;
    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG CUTI YANG MASIH MENUNGGU
    |--------------------------------------------------------------------------
    |
    | Cuti Menunggu ikut diperhitungkan untuk mencegah guru
    | mengirim beberapa pengajuan yang totalnya melebihi kuota.
    |
    */

    private function hitungCutiMenunggu($userId, $tahun)
    {
        $cutis = Cuti::where('user_id', $userId)
            ->where('jenis', 'Cuti')
            ->where('status', 'Menunggu')
            ->whereYear('tanggal_mulai', $tahun)
            ->get();

        $total = 0;

        foreach ($cutis as $cuti) {

            $total += $this->hitungHariKerja(
                $cuti->tanggal_mulai,
                $cuti->tanggal_selesai
            );
        }

        return $total;
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENGAJUAN CUTI
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI INPUT
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'jenis' => 'required|in:Izin,Sakit,Cuti',

            'tanggal_mulai' => 'required|date',

            'tanggal_selesai' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai'
            ],

            'alasan' => 'required|string',

            'surat' => [
                'nullable',
                'mimes:pdf,jpg,jpeg,png',
                'max:2048'
            ]

        ], [

            'jenis.required' => 'Jenis pengajuan wajib dipilih.',

            'jenis.in' => 'Jenis pengajuan tidak valid.',

            'tanggal_mulai.required' =>
                'Tanggal mulai wajib diisi.',

            'tanggal_selesai.required' =>
                'Tanggal selesai wajib diisi.',

            'tanggal_selesai.after_or_equal' =>
                'Tanggal selesai tidak boleh sebelum tanggal mulai.',

            'alasan.required' =>
                'Alasan pengajuan wajib diisi.',

            'surat.mimes' =>
                'Surat harus berformat PDF, JPG, JPEG, atau PNG.',

            'surat.max' =>
                'Ukuran surat maksimal 2 MB.'

        ]);


        /*
        |--------------------------------------------------------------------------
        | JIKA BUKAN CUTI TAHUNAN
        |--------------------------------------------------------------------------
        |
        | Izin dan Sakit tidak menggunakan kuota cuti tahunan.
        |
        */

        if ($request->jenis !== 'Cuti') {

            return $this->simpanPengajuan(
                $request
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK TAHUN
        |--------------------------------------------------------------------------
        */

        $tahun = Carbon::parse(
            $request->tanggal_mulai
        )->year;


        /*
        |--------------------------------------------------------------------------
        | CEK JUMLAH HARI KERJA YANG DIAJUKAN
        |--------------------------------------------------------------------------
        */

        $jumlahHariDiajukan = $this->hitungHariKerja(

            $request->tanggal_mulai,

            $request->tanggal_selesai

        );


        /*
        |--------------------------------------------------------------------------
        | CEK APAKAH TANGGAL TERDIRI DARI HARI KERJA
        |--------------------------------------------------------------------------
        */

        if ($jumlahHariDiajukan <= 0) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Tanggal pengajuan tidak memiliki hari kerja. Silakan pilih tanggal kerja.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | HITUNG CUTI TERPAKAI
        |--------------------------------------------------------------------------
        */

        $cutiDisetujui = $this->hitungCutiDisetujui(

            auth()->id(),

            $tahun

        );


        /*
        |--------------------------------------------------------------------------
        | HITUNG CUTI YANG MASIH MENUNGGU
        |--------------------------------------------------------------------------
        */

        $cutiMenunggu = $this->hitungCutiMenunggu(

            auth()->id(),

            $tahun

        );


        /*
        |--------------------------------------------------------------------------
        | HITUNG SISA KUOTA
        |--------------------------------------------------------------------------
        */

        $sisaCuti = max(

            0,

            self::KUOTA_CUTI_TAHUNAN
            - $cutiDisetujui
            - $cutiMenunggu

        );


        /*
        |--------------------------------------------------------------------------
        | CEK KUOTA
        |--------------------------------------------------------------------------
        */

        if ($jumlahHariDiajukan > $sisaCuti) {

            return back()
                ->withInput()
                ->with(

                    'error',

                    'Pengajuan cuti tidak dapat dilakukan. '
                    . 'Sisa kuota cuti tahunan Anda hanya '
                    . $sisaCuti
                    . ' hari, sedangkan pengajuan yang dipilih '
                    . 'sebanyak '
                    . $jumlahHariDiajukan
                    . ' hari kerja.'

                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PENGAJUAN
        |--------------------------------------------------------------------------
        */

        return $this->simpanPengajuan(
            $request
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA PENGAJUAN
    |--------------------------------------------------------------------------
    */

    private function simpanPengajuan(Request $request)
    {
        $surat = null;


        /*
        |--------------------------------------------------------------------------
        | UPLOAD SURAT
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('surat')) {

            $file = $request->file('surat');

            $folder = public_path('surat-cuti');


            /*
            | Pastikan folder tersedia
            */

            if (!file_exists($folder)) {

                mkdir(
                    $folder,
                    0777,
                    true
                );
            }


            /*
            | Nama file dibuat unik
            */

            $namaFile =
                time()
                . '_'
                . uniqid()
                . '_'
                . $file->getClientOriginalName();


            $file->move(
                $folder,
                $namaFile
            );


            $surat = $namaFile;
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        Cuti::create([

            'user_id' =>
                auth()->id(),

            'jenis' =>
                $request->jenis,

            'tanggal_mulai' =>
                $request->tanggal_mulai,

            'tanggal_selesai' =>
                $request->tanggal_selesai,

            'alasan' =>
                $request->alasan,

            'surat' =>
                $surat,

            'status' =>
                'Menunggu'

        ]);


        /*
        |--------------------------------------------------------------------------
        | PESAN BERHASIL
        |--------------------------------------------------------------------------
        */

        return back()->with(

            'success',

            'Pengajuan berhasil dikirim dan menunggu persetujuan Kepala Sekolah.'

        );
    }
}
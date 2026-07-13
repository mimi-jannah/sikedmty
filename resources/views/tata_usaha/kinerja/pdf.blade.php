<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Laporan Penilaian Kinerja</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            margin:40px;
        }

        h2{
            text-align:center;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:30px;
        }

        td{
            padding:10px;
            border:1px solid #ccc;
        }

        .judul{
            width:35%;
            font-weight:bold;
            background:#f5f5f5;
        }

    </style>

</head>

<body>

<div style="text-align:center; margin-bottom:20px;">

    <img src="{{ public_path('images/kop-sekolah.png') }}"
         style="width:100%;">

</div>

<div style="text-align:center; margin-top:10px; margin-bottom:25px;">

    <h2 style="margin:0; font-size:22px;">

        LAPORAN PENILAIAN KINERJA GURU

    </h2>

    <p style="margin-top:8px; font-size:12px;">

        MTs Thamrin Yahya Rambah Hilir

    </p>

</div>

    <table style="width:100%; border-collapse:collapse; margin-top:20px;">

        <tr>
            <td class="judul">Nama Guru</td>
            <td>{{ $penilaian->user->name }}</td>
        </tr>

        <tr>
            <td class="judul">NIP</td>
            <td>{{ $penilaian->user->nip }}</td>
        </tr>

        <tr>
            <td class="judul">Jabatan</td>
            <td>{{ $penilaian->user->jabatan }}</td>
        </tr>

        <tr>
            <td class="judul">Tanggal Penilaian</td>
            <td>{{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->translatedFormat('d F Y') }}</td>
        </tr>

        <tr>
            <td class="judul">Nilai</td>
            <td>{{ $penilaian->nilai }}</td>
        </tr>

        <tr>
            <td class="judul">Predikat</td>
            <td>{{ $penilaian->kategori }}</td>
        </tr>

    </table>

    <h4 style="margin-top:30px; margin-bottom:10px;">

    Catatan Kepala Madrasah

    </h4>

    <div style="
        border:1px solid #999;
        padding:15px;
        line-height:26px;
        text-align:justify;
        min-height:65px;
    ">

    {{ $penilaian->deskripsi }}

    </div>

    <div style="
    width:40%;
    margin-left:auto;
    margin-top:20px;
    text-align:center;
">

    <p style="margin:0;">
        Rambah Hilir,
        {{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->translatedFormat('d F Y') }}
    </p>

    <p style="margin-top:10px;">
        Kepala Sekolah
    </p>

    <div style="height:70px;"></div>

    <p style="margin:0; font-weight:bold;">
        WANNASRI, S.Pi
    </p>

    <p style="margin:2px 0 0 0;">
        NIP. 197403012007011002
    </p>

</div>



</body>

</html>
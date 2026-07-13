<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Hasil Penilaian Kinerja Guru</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            margin:35px;
            font-size:12px;
            color:#333;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        td{
            padding:8px;
        }

        .judul{
            font-size:20px;
            font-weight:bold;
            text-align:center;
            margin-top:15px;
        }

        .subjudul{
            text-align:center;
            font-size:12px;
            margin-bottom:25px;
        }

    </style>

</head>

<body>

<div style="text-align:center; margin-bottom:20px;">

    <img src="{{ public_path('images/kop-sekolah.png') }}"
         style="width:100%;">

</div>

<div class="judul">

    HASIL PENILAIAN KINERJA GURU

</div>

<div class="subjudul">

    MTs Thamrin Yahya Rambah Hilir

</div>

<table style="margin-top:20px;">

    <tr>
        <td style="width:30%;"><b>Nama Guru</b></td>
        <td style="width:3%;">:</td>
        <td>{{ $penilaian->user->name }}</td>
    </tr>

    <tr>
        <td><b>NIP</b></td>
        <td>:</td>
        <td>{{ $penilaian->user->nip }}</td>
    </tr>

    <tr>
        <td><b>Jabatan</b></td>
        <td>:</td>
        <td>{{ $penilaian->user->jabatan }}</td>
    </tr>

    <tr>
        <td><b>Tanggal Penilaian</b></td>
        <td>:</td>
        <td>
            {{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)
                ->translatedFormat('d F Y') }}
        </td>
    </tr>

    <tr>
        <td><b>Dinilai Oleh</b></td>
        <td>:</td>
        <td>Kepala Sekolah</td>
    </tr>

</table>

<hr style="margin:20px 0;">

<h3 style="
    background:#0f8b5f;
    color:white;
    padding:10px;
    text-align:center;
    margin-bottom:15px;
">

HASIL PENILAIAN

</h3>

<table style="width:100%; border-collapse:collapse;">

    <tr>

        <td style="
            width:50%;
            border:1px solid #ccc;
            text-align:center;
            padding:20px;
        ">

            <div style="font-size:14px; color:#666;">

                Nilai Akhir

            </div>

            <div style="
                font-size:42px;
                font-weight:bold;
                color:#15803d;
                margin-top:10px;
            ">

                {{ $penilaian->nilai }}

            </div>

            <div style="color:#666;">

                dari 100

            </div>

        </td>

        <td style="
            width:50%;
            border:1px solid #ccc;
            text-align:center;
            padding:20px;
        ">

            <div style="font-size:14px; color:#666;">

                Predikat

            </div>

            <div style="
                margin-top:15px;
                font-size:24px;
                font-weight:bold;
                color:#15803d;
            ">

                {{ $penilaian->kategori }}

            </div>

        </td>

    </tr>

</table>
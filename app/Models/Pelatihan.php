<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $fillable = [

        'user_id',
        'tanggal_pelatihan',
        'nama_pelatihan',
        'deskripsi',
        'penyelenggara',
        'lokasi',
        'sertifikat'

    ];
}
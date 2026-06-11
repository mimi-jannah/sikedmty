<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kinerja extends Model
{
    protected $fillable = [

    'user_id',
    'kategori',
    'tanggal',
    'guru_staff',
    'nama_pelatihan',
    'deskripsi',
    'penyelenggara',
    'lokasi',
    'bukti',
    'status'

];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kinerja extends Model
{
    protected $fillable = [

    'nama_form',
    'semester',
    'tahun_ajaran',
    'keterangan',
    'status',

    ];
}
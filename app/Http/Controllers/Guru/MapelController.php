<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Mapel;

class MapelController extends Controller
{
    public function indexGuru()
    {
        $mapels = Mapel::all();

        return view('guru.mapel.index', compact('mapels'));
    }
}
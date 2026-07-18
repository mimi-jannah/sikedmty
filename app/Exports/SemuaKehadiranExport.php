<?php

namespace App\Exports;

use App\Models\Kehadiran;
use Maatwebsite\Excel\Concerns\FromCollection;

class SemuaKehadiranExport implements FromCollection
{
    public function collection()
    {
        return Kehadiran::with('user')->get();
    }
}
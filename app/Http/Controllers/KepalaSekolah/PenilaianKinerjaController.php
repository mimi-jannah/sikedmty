<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenilaianKinerja;
use App\Models\User;

class PenilaianKinerjaController extends Controller
{
        public function index(Request $request)
    {
        $query = PenilaianKinerja::with('user');

        // Cari nama guru
        if ($request->filled('search')) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%');

            });

        }

        // Filter jabatan
        if ($request->filled('jabatan')) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('jabatan', $request->jabatan);

            });

        }

        // Filter tanggal
        if ($request->filled('tanggal_penilaian')) {

            $query->whereDate(
                'tanggal_penilaian',
                $request->tanggal_penilaian
            );

        }

        // Sorting
            if ($request->sort == 'terbaru') {

                $query->orderBy('tanggal_penilaian', 'desc');

            } elseif ($request->sort == 'terlama') {

                $query->orderBy('tanggal_penilaian', 'asc');

            } elseif ($request->sort == 'nilai_desc') {

                $query->orderBy('nilai', 'desc');

            } elseif ($request->sort == 'nilai_asc') {

                $query->orderBy('nilai', 'asc');

            } elseif ($request->sort == 'nama_asc') {

                $query->join('users', 'users.id', '=', 'penilaian_kinerjas.user_id')
                    ->orderBy('users.name', 'asc')
                    ->select('penilaian_kinerjas.*');

            } elseif ($request->sort == 'nama_desc') {

                $query->join('users', 'users.id', '=', 'penilaian_kinerjas.user_id')
                    ->orderBy('users.name', 'desc')
                    ->select('penilaian_kinerjas.*');

            } else {

                $query->latest();

            }

            $penilaians = $query->paginate(10)->withQueryString();

            $gurus = User::whereHas('role', function ($q) {

            $q->where('slug', 'guru');

        })->get();

        return view(
            'kepala_sekolah.kinerja.index',
            compact('penilaians', 'gurus')
        );
    }

        public function store(Request $request)
    {
        $request->validate([

            'user_id' => 'required|exists:users,id',

            'tanggal_penilaian' => 'required|date',

            'deskripsi' => 'required',

            'nilai' => 'required|integer|min:0|max:100',

        ]);

        // Menentukan kategori otomatis
        if ($request->nilai >= 90) {

            $kategori = 'Sangat Baik';

        } elseif ($request->nilai >= 80) {

            $kategori = 'Baik';

        } elseif ($request->nilai >= 70) {

            $kategori = 'Cukup';

        } else {

            $kategori = 'Kurang';

        }

        PenilaianKinerja::create([

            'user_id' => $request->user_id,

            'tanggal_penilaian' => $request->tanggal_penilaian,

            'deskripsi' => $request->deskripsi,

            'nilai' => $request->nilai,

            'kategori' => $kategori,

        ]);

        return redirect()
                ->route('kinerja.index')
                ->with('success', 'Penilaian berhasil disimpan.');
    }

        public function edit($id)
    {
        $penilaian = PenilaianKinerja::findOrFail($id);

        $penilaians = PenilaianKinerja::with('user')
                        ->latest()
                        ->get();

        $gurus = User::whereHas('role', function ($q) {
            $q->where('slug', 'guru');
        })->get();

        return view(
            'kepala_sekolah.kinerja.index',
            compact('penilaian', 'penilaians', 'gurus')
        );
    }

        public function update(Request $request, $id)
    {
        $request->validate([

            'user_id' => 'required|exists:users,id',

            'tanggal_penilaian' => 'required|date',

            'deskripsi' => 'required',

            'nilai' => 'required|integer|min:0|max:100',

        ]);

        // Menentukan kategori otomatis
        if ($request->nilai >= 90) {

            $kategori = 'Sangat Baik';

        } elseif ($request->nilai >= 80) {

            $kategori = 'Baik';

        } elseif ($request->nilai >= 70) {

            $kategori = 'Cukup';

        } else {

            $kategori = 'Kurang';

        }

        $penilaian = PenilaianKinerja::findOrFail($id);

        $penilaian->update([

            'user_id' => $request->user_id,

            'tanggal_penilaian' => $request->tanggal_penilaian,

            'deskripsi' => $request->deskripsi,

            'nilai' => $request->nilai,

            'kategori' => $kategori,

        ]);

        return redirect()
                ->route('kinerja.index')
                ->with('success', 'Penilaian berhasil diperbarui.');
    }

        public function destroy($id)
    {
        $penilaian = PenilaianKinerja::findOrFail($id);

        $penilaian->delete();

        return redirect()
            ->route('kinerja.index')
            ->with('success', 'Data penilaian berhasil dihapus.');
    }
}
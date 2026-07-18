<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GuruStaffController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN DATA GURU/STAFF
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $guruStaff = User::all();

        return view(
            'tata_usaha.data_guru.index',
            compact('guruStaff')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN TAMBAH DATA
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('tata_usaha.data_guru.create');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA
    |--------------------------------------------------------------------------
    */

   public function store(Request $request)
{
   
    $request->validate([
    'name' => 'required',
    'email' => 'required|email|unique:users,email',
    'nip' => 'required|unique:users,nip',
    'golongan' => 'required',
    'jabatan' => 'required',
    'password' => 'required|min:8',
]);

    $foto = null;

    if ($request->hasFile('foto')) {

        $foto = time().'.'.$request->foto->extension();

        $request->foto->move(
            public_path('images'),
            $foto
        );
    }
    User::create([

        'name' => $request->name,

        'email' => $request->email,

        'nip' => $request->nip,

        'golongan' => $request->golongan,

        'jabatan' => $request->jabatan,

        'foto' => $foto,

        'password' => Hash::make($request->password),

        // default role guru
        'role_id' => 1,
    ]);

    return redirect()
            ->route('tata_usaha.data_guru')
            ->with(
                'success',
                'Data berhasil ditambahkan'
            );
}


    /*
    |--------------------------------------------------------------------------
    | HALAMAN EDIT DATA
    |--------------------------------------------------------------------------
    */

    public function edit($id)
{
    $guru = User::findOrFail($id);

    return view(
        'tata_usaha.data_guru.edit',
        compact('guru')
    );
}

    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
{
    $guru = User::findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | VALIDASI
    |--------------------------------------------------------------------------
    */

    $request->validate([

        'name' => 'required',

        'email' => 'required',

        'nip' => 'required',

        'golongan' => 'required',

        'jabatan' => 'required',

    ]);

    /*
    |--------------------------------------------------------------------------
    | FOTO
    |--------------------------------------------------------------------------
    */

    $foto = $guru->foto;

    if ($request->hasFile('foto')) {

        $foto = time().'.'.$request->foto->extension();

        $request->foto->move(
            public_path('images'),
            $foto
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */

    $guru->name = $request->name;

    $guru->email = $request->email;

    $guru->nip = $request->nip;

    $guru->golongan = $request->golongan;

    $guru->jabatan = $request->jabatan;

    $guru->foto = $foto;

    /*
    |--------------------------------------------------------------------------
    | PASSWORD
    |--------------------------------------------------------------------------
    */

    if ($request->password) {

        $guru->password = Hash::make($request->password);

    }

    $guru->save();

    return redirect()
            ->route('tata_usaha.data_guru')
            ->with(
                'success',
                'Data berhasil diupdate'
            );
}
    /*
    |--------------------------------------------------------------------------
    | HAPUS DATA
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $guru = User::findOrFail($id);

        $guru->delete();

        return redirect()
                ->route('tata_usaha.data_guru')
                ->with(
                    'success',
                    'Data berhasil dihapus'
                );
    }

    public function show($id)
    {
        $guru = User::findOrFail($id);

        return view(
            'tata_usaha.data_guru.show',
            compact('guru')
        );
    }
}
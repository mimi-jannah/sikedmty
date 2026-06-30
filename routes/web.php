<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\KehadiranController;
use App\Http\Controllers\Guru\CutiController;
use App\Http\Controllers\Guru\PelatihanController;

use App\Http\Controllers\TataUsaha\DashboardController as TataUsahaDashboardController;
use App\Http\Controllers\TataUsaha\GuruStaffController as TataUsahaGuruStaffController;
use App\Http\Controllers\TataUsaha\KinerjaController;
use App\Http\Controllers\TataUsaha\LaporanKehadiranController;
use App\Http\Controllers\TataUsaha\PelatihanController as TataUsahaPelatihanController;

use App\Http\Controllers\KepalaSekolah\DashboardController as KepalaSekolahDashboardController;
use App\Http\Controllers\KepalaSekolah\CutiKepsekController;
use App\Http\Controllers\KepalaSekolah\PenilaianKinerjaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return redirect('/login');

});


//guru

Route::middleware([
    'auth',
    'role:guru'
])->prefix('guru')->group(function () {

    Route::get('/dashboard', [
        GuruDashboardController::class,
        'index'
    ])->name('guru.dashboard');

    Route::get('/kehadiran', [
        KehadiranController::class,
        'index'
    ])->name('guru.kehadiran');

    Route::post('/kehadiran', [
        KehadiranController::class,
        'store'
    ])->name('guru.kehadiran.store');

    //cuti
    Route::get('/guru/cuti', [CutiController::class, 'index'])
    ->name('guru.cuti');

    Route::post('/guru/cuti/store', [CutiController::class, 'store'])
    ->name('guru.cuti.store');

    //pelatihan
    Route::get('/pelatihan',[PelatihanController::class, 'index'])
    ->name('guru.pelatihan.index');
    
    Route::post('/pelatihan/store',[PelatihanController::class,'store'])
    ->name('guru.pelatihan.store');

    Route::put('/pelatihan/{id}',[PelatihanController::class,'update'])
    ->name('guru.pelatihan.update');

});


//tatausaha

Route::middleware([
    'auth',
    'role:tata_usaha'
])->prefix('tata-usaha')->group(function () {

    Route::get('/dashboard', [
        TataUsahaDashboardController::class,
        'index'
    ])->name('tata_usaha.dashboard');

    Route::get('/data-guru', [
        TataUsahaGuruStaffController::class,
        'index'
    ])->name('tata_usaha.data_guru');

    Route::get('/data-guru/create', [
        TataUsahaGuruStaffController::class,
        'create'
    ])->name('tata_usaha.data_guru.create');

    Route::post('/data-guru', [
        TataUsahaGuruStaffController::class,
        'store'
    ])->name('tata_usaha.data_guru.store');

   Route::get('/data-guru/{id}/edit', [
        TataUsahaGuruStaffController::class,
        'edit'
    ])->name('tata_usaha.data_guru.edit');

    Route::put('/data-guru/{id}', [
        TataUsahaGuruStaffController::class,
        'update'
    ])->name('tata_usaha.data_guru.update');

    Route::delete('/data-guru/{id}', [
        TataUsahaGuruStaffController::class,
        'destroy'
    ])->name('tata_usaha.data_guru.destroy');

    Route::get('/data-guru/{id}', [
        TataUsahaGuruStaffController::class,
        'show'
    ])->name('tata_usaha.data_guru.show');

    //data kinerja

    Route::get(
        '/tata-usaha/kinerja',
        [KinerjaController::class, 'index']
    )->name('tu.kinerja');

    Route::post('/tata-usaha/kinerja/store',
        [KinerjaController::class, 'store'])
    ->name('tata-usaha.kinerja.store');

    //laporan kehadiran
    Route::get(
        '/laporan-kehadiran',
        [LaporanKehadiranController::class, 'index']
    )->name('tata_usaha.laporan_kehadiran');

    Route::get(
        '/laporan-kehadiran/{id}',
        [LaporanKehadiranController::class, 'detail']
    )->name('tata_usaha.kehadiran.detail');

    Route::get(
        '/tata-usaha/laporan-kehadiran/export/{id}',
        [LaporanKehadiranController::class, 'export']
    )->name('tata_usaha.kehadiran.export');

    //pelatihan
    Route::get('/pelatihan',[TataUsahaPelatihanController::class,'index']
        )->name('tata_usaha.pelatihan');

    Route::post('/pelatihan/store',[TataUsahaPelatihanController::class,'store']
        )->name('tata_usaha.pelatihan.store');

    Route::put('/pelatihan/{id}',[TataUsahaPelatihanController::class,'update']
        )->name('tata_usaha.pelatihan.update');

    Route::delete('/pelatihan/{id}',[TataUsahaPelatihanController::class,'destroy']
        )->name('tata_usaha.pelatihan.destroy');

    


});


//kepala sekolah

Route::middleware([
    'auth',
    'role:kepala_sekolah'
])->prefix('kepala-sekolah')->group(function () {

    Route::get('/dashboard', [
        KepalaSekolahDashboardController::class,
        'index'
    ])->name('kepala_sekolah.dashboard');

     Route::get('/kinerja', [PenilaianKinerjaController::class, 'index'])
        ->name('kinerja.index');

    Route::post('/kinerja/store', [PenilaianKinerjaController::class,'store'])
        ->name('kinerja.store');
    
    Route::get('/kinerja/{id}/edit', [PenilaianKinerjaController::class, 'edit'])
        ->name('kinerja.edit');

    Route::put('/kinerja/{id}', [PenilaianKinerjaController::class, 'update'])
        ->name('kinerja.update');
});


//cuti
    Route::get(
        '/kepala-sekolah/cuti_kepsek',
        [CutiKepsekController::class, 'index']
    )->name('kepala_sekolah.cuti_kepsek');

    Route::put(
        '/kepala-sekolah/cuti_kepsek/setujui/{id}',
        [CutiKepsekController::class, 'setujui']
    )->name('kepala.cuti_kepsek.setujui');

    Route::put(
        '/kepala-sekolah/cuti_kepsek/tolak/{id}',
        [CutiKepsekController::class, 'tolak']
    )->name('kepala.cuti_kepsek.tolak');

    //laporan kehadiran
    Route::get(
        '/kehadiran',
        [\App\Http\Controllers\KepalaSekolah\KehadiranController::class, 'index']
    )->name('kepala.kehadiran');

    Route::get(
        '/kehadiran/{id}',
        [\App\Http\Controllers\KepalaSekolah\KehadiranController::class, 'detail']
    )->name('kepala.kehadiran.detail');

    //penilaian kinerja
   


Route::get('/redirect-dashboard', function () {

    $role = auth()->user()->role->slug;

    if ($role == 'guru') {

        return redirect()->route('guru.dashboard');
    }

    if ($role == 'tata_usaha') {

        return redirect()->route('tata_usaha.dashboard');
    }

    if ($role == 'kepala_sekolah') {

        return redirect()->route('kepala_sekolah.dashboard');
    }

    abort(403);

})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

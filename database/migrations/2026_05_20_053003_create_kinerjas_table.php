<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('kinerjas', function (Blueprint $table) {

        $table->id();

        $table->string('tanggal');

        $table->string('guru_staff');

        $table->string('nama_pelatihan');

        $table->text('deskripsi');

        $table->string('penyelenggara');

        $table->string('lokasi');

        $table->string('status')
              ->default('Menunggu');

        $table->timestamps();

    });
}

    public function down(): void
    {
        Schema::dropIfExists('kinerjas');
    }
};
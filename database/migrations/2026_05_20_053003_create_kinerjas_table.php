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

    $table->string('nama_form');
    $table->string('semester');
    $table->string('tahun_ajaran');
    $table->text('keterangan')->nullable();
    $table->string('status')->default('Aktif');

    $table->timestamps();

});
}

    public function down(): void
    {
        Schema::dropIfExists('kinerjas');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up(): void
    {
        Schema::create('penilaian_kinerjas', function (Blueprint $table) {

            $table->id();

            // Guru/Staff yang dinilai
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Tanggal penilaian
            $table->date('tanggal_penilaian');

            // Deskripsi kinerja
            $table->text('deskripsi');

            // Nilai (0-100)
            $table->integer('nilai');

            // Kategori otomatis
            $table->string('kategori');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_kinerjas');
    }
};

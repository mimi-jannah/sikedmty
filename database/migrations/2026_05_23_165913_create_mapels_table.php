<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up()
    {
        Schema::table('mapels', function ($table) {
            $table->string('kode_mapel')->after('id');
        });
    }

    public function down()
    {
        Schema::table('mapels', function ($table) {
            $table->dropColumn('kode_mapel');
        });
    }

};
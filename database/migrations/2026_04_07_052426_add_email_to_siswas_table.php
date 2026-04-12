<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // PERHATIAN: Nama tabel di sini adalah 'siswas'
        Schema::table('siswas', function (Blueprint $table) {
            $table->string('email')->unique()->after('nis');
        });
    }

    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
};

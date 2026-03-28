<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aspirasi_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('id_aspirasi');
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai']);
            $table->string('feedback', 255)->nullable();
            $table->string('changed_by', 100)->nullable();
            $table->timestamps();

            $table->foreign('id_aspirasi')->references('id_aspirasi')->on('aspirasis')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('aspirasi_histories');
    }
};

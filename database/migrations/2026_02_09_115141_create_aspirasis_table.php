<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->integer('id_aspirasi')->primary();
            $table->string('nis', 20);
            $table->integer('id_kategori');
            $table->string('lokasi', 50);
            $table->text('ket');
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai']);
            $table->string('feedback', 100)->nullable();
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswas')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('aspirasis');
    }
};

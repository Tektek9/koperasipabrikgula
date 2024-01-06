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
        Schema::create('data_kas_banks', function (Blueprint $table) {
            $table->id();
            $table->date("tanggal");
            $table->string("jenis");//masuk keluar
            $table->string("nomor_bukti");
            $table->string("nomor_perkiraan");
            $table->string("nomor_perkiraan_lawan");
            $table->string("deskripsi");
            $table->string("ubl");//upah bahan lain lain
            $table->integer("jumlah_uang");
            $table->string("created_by");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kas_banks');
    }
};

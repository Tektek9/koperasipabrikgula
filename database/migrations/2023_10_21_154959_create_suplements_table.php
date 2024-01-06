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
        Schema::create('suplements', function (Blueprint $table) {
            $table->id();
            $table->date("tahun");
            $table->string("jenis");//debit kredit
            $table->string("nomor_bukti");
            $table->string("nomor_perkiraan");
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
        Schema::dropIfExists('suplements');
    }
};

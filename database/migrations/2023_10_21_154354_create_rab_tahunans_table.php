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
        Schema::create('rab_tahunans', function (Blueprint $table) {
            $table->id();
            $table->string("tahun");
            $table->string("nomor_perkiraan");
            $table->string("nama_perkiraan");
            $table->integer("rab_januari");
            $table->integer("rab_februari");
            $table->integer("rab_maret");
            $table->integer("rab_april");
            $table->integer("rab_mei");
            $table->integer("rab_juni");
            $table->integer("rab_juli");
            $table->integer("rab_agustus");
            $table->integer("rab_september");
            $table->integer("rab_oktober");
            $table->integer("rab_november");
            $table->integer("rab_desember");
            $table->string("created_by");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rab_tahunans');
    }
};

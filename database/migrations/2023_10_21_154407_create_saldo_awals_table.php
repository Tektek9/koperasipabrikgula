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
        Schema::create('saldo_awals', function (Blueprint $table) {
            $table->id();
            $table->string("nomor_perkiraan");
            $table->string("nama_perkiraan");
            $table->string("jensi");//debit atau kredit
            $table->string("saldo_awal");
            $table->string("created_by");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_awals');
    }
};

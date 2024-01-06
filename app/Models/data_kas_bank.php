<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_kas_bank extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'jenis',
        'nomor_bukti',
        'nomor_perkiraan',
        'nomor_perkiraan_lawan',
        'deskripsi',
        'ubl',
        'jumlah_uang',
        'created_by',
    ];
}

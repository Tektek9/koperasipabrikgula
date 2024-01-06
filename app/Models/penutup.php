<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penutup extends Model
{
    use HasFactory;
    protected $fillable = [
        'tahun',
        'jenis',
        'nomor_bukti',
        'nomor_perkiraan',
        'deskripsi',
        'ubl',
        'jumlah_uang',
        'created_by',
    ];
}

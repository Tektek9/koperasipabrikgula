<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rab_tahunan extends Model
{
    use HasFactory;
    protected $fillable = [
        'tahun',
        'nomor_perkiraan',
        'nama_perkiraan',
        'rab_januari',
        'rab_februari',
        'rab_maret',
        'rab_april',
        'rab_mei',
        'rab_juni',
        'rab_juli',
        'rab_agustus',
        'rab_september',
        'rab_oktober',
        'rab_november',
        'rab_desember',
        'created_by',
    ];
}

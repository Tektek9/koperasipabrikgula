<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nomor_perkiraan extends Model
{
    use HasFactory;
    protected $fillable = ['kode', 'uraian',
    'created_by'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';
    protected $fillable = ['nama_paket', 'destinasi', 'tanggal', 'jam_keberangkatan', 'harga', 'benefit'];
}

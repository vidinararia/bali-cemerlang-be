<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket_pesawat extends Model
{
    use HasFactory;

    protected $table = 'tiket_pesawat';
    protected $fillable = ['nama_pesawat', 'kota_asal', 'kota_tujuan', 'waktu_berangkat', 'harga'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesawat extends Model
{
    use HasFactory;

    protected $table = 'pesawat';
    protected $fillable = ['nama_pesawat'];
}

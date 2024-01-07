<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promos';
    protected $fillable = ['judul_promo', 'isi_promo', 'foto_promo'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'offers';
    protected $fillable = ['judul_offer', 'isi_offer', 'jenis_offer', 'foto_offer'];
}

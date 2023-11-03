<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class tiket extends Model
{
    use HasFactory;

    protected $table = 'tiket';
    protected $fillable = ['waktu_berangkat', 'harga', 'tanggal_lokasi_awal', 'tanggal_lokasi_tujuan'];

    public $timestamps = false;
    /**
     * Get the user that owns the tiket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nama_pesawat(): BelongsTo
    {
        return $this->belongsTo(pesawat::class, 'id_pesawat', 'id');
    }

    public function lokasi_awal(): BelongsTo
    {
        return $this->belongsTo(lokasi::class, 'id_lokasi_awal', 'id');
    }

    public function lokasi_tujuan(): BelongsTo
    {
        return $this->belongsTo(lokasi::class, 'id_lokasi_tujuan', 'id');
    }
}

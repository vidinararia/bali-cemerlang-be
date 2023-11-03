<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TiketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'id_pesawat' => $this->id_pesawat,
            'nama_pesawat' => $this->nama_pesawat,
            'waktu_berangkat' => $this->waktu_berangkat,
            'harga' => $this->harga,
            'id_lokasi_awal' => $this->id_lokasi_awal,
            'lokasi_awal' => $this->lokasi_awal,
            'tanggal_lokasi_awal' => $this->tanggal_lokasi_awal,
            'id_lokasi_tujuan' => $this->id_lokasi_tujuan,
            'lokasi_tujuan' => $this->lokasi_tujuan,
            'tanggal_lokasi_tujuan' => $this->tanggal_lokasi_tujuan
        ];
    }
}

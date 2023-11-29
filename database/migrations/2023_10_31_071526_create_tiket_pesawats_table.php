<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tiket_pesawat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pesawat');
            $table->string('kota_asal');
            $table->string('kota_tujuan');
            $table->string('waktu_berangkat');
            $table->integer('harga');
            $table->string('jenis_tiket');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket');
    }
};

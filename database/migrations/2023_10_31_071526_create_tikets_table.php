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
        Schema::create('tiket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pesawat')->constrained('pesawat')->cascadeOnUpdate('cascade')->cascadeOnDelete('cascade');
            $table->string('waktu_berangkat');
            $table->integer('harga');
            $table->foreignId('id_lokasi_awal')->constrained('lokasi')->cascadeOnUpdate('cascade')->cascadeOnDelete('cascade');
            $table->string('tanggal_lokasi_awal');
            $table->foreignId('id_lokasi_tujuan')->constrained('lokasi')->cascadeOnUpdate('cascade')->cascadeOnDelete('cascade');
            $table->string('tanggal_lokasi_tujuan');
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

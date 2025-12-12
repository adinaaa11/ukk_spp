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
       Schema::create('pembayaran', function (Blueprint $table) {
    $table->bigIncrements('id_pembayaran');
    $table->unsignedBigInteger('id_petugas');
    $table->char('nisn', 10);
    $table->date('tgl_bayar');
    $table->string('bulan_dibayar', 8);
    $table->string('tahun_dibayar', 4);
    $table->unsignedBigInteger('id_spp');
    $table->integer('jumlah_bayar');
    $table->timestamps();

    // Foreign Keys
    $table->foreign('id_petugas')->references('id_petugas')->on('petugas');
    $table->foreign('nisn')->references('nisn')->on('siswa');
    $table->foreign('id_spp')->references('id_spp')->on('spp');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};

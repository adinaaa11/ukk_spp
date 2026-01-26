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
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->string('metode_pembayaran', 20)->default('tunai')->after('jumlah_bayar');
            $table->string('bank_tujuan', 50)->nullable()->after('metode_pembayaran');
            $table->string('no_rekening_pengirim', 50)->nullable()->after('bank_tujuan');
            $table->string('nama_pengirim', 100)->nullable()->after('no_rekening_pengirim');
            $table->date('tanggal_transfer')->nullable()->after('nama_pengirim');
            $table->text('catatan')->nullable()->after('tanggal_transfer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropColumn([
                'metode_pembayaran',
                'bank_tujuan',
                'no_rekening_pengirim',
                'nama_pengirim',
                'tanggal_transfer',
                'catatan'
            ]);
        });
    }
};
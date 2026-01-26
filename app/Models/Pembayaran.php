<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    
    protected $fillable = [
        'id_petugas',
        'nisn',
        'tgl_bayar',
        'bulan_dibayar',
        'tahun_dibayar',
        'id_spp',
        'jumlah_bayar',
        'metode_pembayaran',
        'bank_tujuan',
        'no_rekening_pengirim',
        'nama_pengirim',
        'tanggal_transfer',
        'catatan',
    ];

    protected $casts = [
        'tgl_bayar' => 'date',
        'tanggal_transfer' => 'date',
        'created_at' => 'datetime',
    ];

    /**
     * Relasi dengan Siswa
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    /**
     * Relasi dengan Petugas
     */
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }

    /**
     * Relasi dengan SPP
     */
    public function spp()
    {
        return $this->belongsTo(Spp::class, 'id_spp', 'id_spp');
    }
}
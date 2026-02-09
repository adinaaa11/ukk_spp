<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'nisn';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nisn',
        'nis',
        'nama',
        'id_kelas',
        'alamat',
        'no_telp',
        'id_spp',
    ];

    /**
     * Relasi ke Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    /**
     * Relasi ke SPP
     */
    public function spp()
    {
        return $this->belongsTo(Spp::class, 'id_spp', 'id_spp');
    }

    /**
     * Relasi ke Pembayaran (One to Many)
     */
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'nisn', 'nisn');
    }

    /**
     * Accessor: Get jumlah bulan yang sudah dibayar
     */
    public function getTotalBulanTerbayarAttribute()
    {
        return $this->pembayaran()->count();
    }

    /**
     * Accessor: Get total nominal yang sudah dibayar
     */
    public function getTotalNominalTerbayarAttribute()
    {
        return $this->pembayaran()->sum('jumlah_bayar');
    }

    /**
     * Scope: Filter siswa berdasarkan kelas
     */
    public function scopeByKelas($query, $idKelas)
    {
        return $query->where('id_kelas', $idKelas);
    }

    /**
     * Scope: Filter siswa berdasarkan tahun SPP
     */
    public function scopeByTahunSpp($query, $tahun)
    {
        return $query->whereHas('spp', function($q) use ($tahun) {
            $q->where('tahun', $tahun);
        });
    }
}
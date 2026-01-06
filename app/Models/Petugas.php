<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    use Notifiable;

    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';

    protected $fillable = [
        'username',
        'nama_petugas',
        'level',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // PENTING: Method untuk autentikasi
    public function getAuthIdentifierName()
    {
        return 'username'; // Login pakai username
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    // Relasi ke Pembayaran
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_petugas', 'id_petugas');
    }
}
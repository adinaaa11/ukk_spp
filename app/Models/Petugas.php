<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    use Notifiable;

    protected $table = 'petugas';

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

    // jika kamu ingin casting
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

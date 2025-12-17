<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'petugas',
        ],
        
        // GUARD UNTUK SISWA
        'siswa' => [
            'driver' => 'session',
            'provider' => 'siswas', // Diubah dari 'siswa' menjadi 'siswas'
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'petugas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Petugas::class,
        ],
        
        // PROVIDER UNTUK SISWA
        'siswas' => [ // Diubah dari 'siswa' menjadi 'siswas'
            'driver' => 'eloquent',
            'model' => App\Models\Siswa::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
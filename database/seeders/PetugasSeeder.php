<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;

class PetugasSeeder extends Seeder
{
    public function run()
    {
        Petugas::create([
            'username' => 'admin',
            'nama_petugas' => 'Administrator',
            'level' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    }
}

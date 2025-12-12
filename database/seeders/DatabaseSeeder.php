<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Petugas;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\Siswa;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Petugas/Admin
        Petugas::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'), // Passwordnya: admin123
            'nama_petugas' => 'Administrator',
            'level' => 'admin',
        ]);

        Petugas::create([
            'username' => 'petugas',
            'password' => Hash::make('petugas123'), // Passwordnya: petugas123
            'nama_petugas' => 'Petugas Loket',
            'level' => 'petugas',
        ]);

        // 2. Buat Data SPP
        $spp1 = Spp::create([
            'tahun' => 2025,
            'nominal' => 500000
        ]);

        // 3. Buat Data Kelas
        $kelas1 = Kelas::create([
            'nama_kelas' => 'XII RPL 1',
            'kompetensi_keahlian' => 'Rekayasa Perangkat Lunak'
        ]);

        // 4. Buat Data Siswa (NISN: 001)
        Siswa::create([
            'nisn' => '001',
            'nis' => '1001',
            'nama' => 'Advan Siswa Percobaan',
            'id_kelas' => $kelas1->id_kelas,
            'alamat' => 'Jl. Kebenaran No. 1',
            'no_telp' => '08123456789',
            'id_spp' => $spp1->id_spp,
        ]);
        
        Siswa::create([
            'nisn' => '002',
            'nis' => '1002',
            'nama' => 'Budi Santoso',
            'id_kelas' => $kelas1->id_kelas,
            'alamat' => 'Jl. Contoh No. 2',
            'no_telp' => '08987654321',
            'id_spp' => $spp1->id_spp,
        ]);
    }
}
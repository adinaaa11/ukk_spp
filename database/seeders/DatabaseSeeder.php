<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\Siswa;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        Petugas::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'nama_petugas' => 'Administrator',
            'level' => 'admin',
        ]);

        // 2. Buat Akun Petugas
        Petugas::create([
            'username' => 'petugas',
            'password' => Hash::make('petugas123'),
            'nama_petugas' => 'Petugas Loket',
            'level' => 'petugas',
        ]);

        // 3. Buat Data SPP
        $spp1 = Spp::create([
            'tahun' => 2025,
            'nominal' => 500000
        ]);

        // 4. Buat Data Kelas
        $kelas1 = Kelas::create([
            'nama_kelas' => 'XII RPL 1',
            'kompetensi_keahlian' => 'Rekayasa Perangkat Lunak'
        ]);

        // 5. Buat Data Siswa dengan Login
        Siswa::create([
            'nisn' => '0012345678',
            'nis' => '12345678',
            'nama' => 'Advan Siswa Percobaan',
            'id_kelas' => $kelas1->id_kelas,
            'alamat' => 'Jl. Kebenaran No. 1',
            'no_telp' => '08123456789',
            'id_spp' => $spp1->id_spp,
            'username' => '0012345678', // Username = NISN
            'password' => Hash::make('siswa123'),
        ]);
        
        Siswa::create([
            'nisn' => '0098765432',
            'nis' => '87654321',
            'nama' => 'Budi Santoso',
            'id_kelas' => $kelas1->id_kelas,
            'alamat' => 'Jl. Contoh No. 2',
            'no_telp' => '08987654321',
            'id_spp' => $spp1->id_spp,
            'username' => '0098765432', // Username = NISN
            'password' => Hash::make('siswa123'),
        ]);

        echo "\n✅ Seeder berhasil!\n";
        echo "Admin - username: admin, password: admin123\n";
        echo "Petugas - username: petugas, password: petugas123\n";
        echo "Siswa - NISN: 0012345678, password: siswa123\n";
    }
}
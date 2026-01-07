<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        echo "\n🔄 Membuat data...\n\n";
        
        // 1. ADMIN
        echo "📝 Membuat admin...\n";
        DB::table('petugas')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'nama_petugas' => 'Administrator',
            'level' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 2. PETUGAS
        echo "📝 Membuat petugas...\n";
        DB::table('petugas')->insert([
            'username' => 'petugas',
            'password' => Hash::make('petugas123'),
            'nama_petugas' => 'Petugas Loket',
            'level' => 'petugas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 3. SPP
        echo "📝 Membuat SPP...\n";
        DB::table('spp')->insert([
            'tahun' => 2025,
            'nominal' => 500000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $id_spp = DB::getPdo()->lastInsertId();
        
        // 4. KELAS
        echo "📝 Membuat kelas...\n";
        DB::table('kelas')->insert([
            'nama_kelas' => 'XII RPL 1',
            'kompetensi_keahlian' => 'Rekayasa Perangkat Lunak',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $id_kelas = DB::getPdo()->lastInsertId();
        
        // 5. SISWA
        echo "📝 Membuat siswa...\n";
        DB::table('siswa')->insert([
            'nisn' => '0012345678',
            'nis' => '12345678',
            'nama' => 'Siswa Test',
            'id_kelas' => $id_kelas,
            'alamat' => 'Jl. Test No. 1',
            'no_telp' => '08123456789',
            'id_spp' => $id_spp,
            'username' => '0012345678',
            'password' => Hash::make('siswa123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        echo "\n========================================\n";
        echo "✅ SEEDER BERHASIL!\n";
        echo "========================================\n";
        echo "LOGIN ADMIN:\n";
        echo "  Username: admin\n";
        echo "  Password: admin123\n";
        echo "========================================\n";
        echo "LOGIN SISWA:\n";
        echo "  NISN: 0012345678\n";
        echo "  Password: siswa123\n";
        echo "========================================\n\n";
    }
}
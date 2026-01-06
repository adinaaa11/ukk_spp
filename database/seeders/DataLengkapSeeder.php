<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{Petugas, Kelas, Spp, Siswa};

class DataLengkapSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Admin & Petugas
        Petugas::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'nama_petugas' => 'Administrator',
            'level' => 'admin',
        ]);

        Petugas::create([
            'username' => 'petugas',
            'password' => Hash::make('petugas123'),
            'nama_petugas' => 'Petugas Loket',
            'level' => 'petugas',
        ]);

        // 2. Buat SPP
        $spp = Spp::create(['tahun' => 2025, 'nominal' => 500000]);

        // 3. Data Jurusan (30 Kelas)
        $jurusan = [
            // PERMESINAN DAN OTOMOTIF
            ['nama' => 'X TKR 1', 'jurusan' => 'Teknik Kendaraan Ringan'],
            ['nama' => 'X TKR 2', 'jurusan' => 'Teknik Kendaraan Ringan'],
            ['nama' => 'XI TKR 1', 'jurusan' => 'Teknik Kendaraan Ringan'],
            ['nama' => 'XI TKR 2', 'jurusan' => 'Teknik Kendaraan Ringan'],
            ['nama' => 'XII TKR 1', 'jurusan' => 'Teknik Kendaraan Ringan'],
            ['nama' => 'XII TKR 2', 'jurusan' => 'Teknik Kendaraan Ringan'],
            
            ['nama' => 'X TPM', 'jurusan' => 'Teknik Permesinan'],
            ['nama' => 'XI TPM', 'jurusan' => 'Teknik Permesinan'],
            ['nama' => 'XII TPM', 'jurusan' => 'Teknik Permesinan'],
            
            ['nama' => 'X TL', 'jurusan' => 'Teknik Pengelasan'],
            ['nama' => 'XI TL', 'jurusan' => 'Teknik Pengelasan'],
            ['nama' => 'XII TL', 'jurusan' => 'Teknik Pengelasan'],
            
            ['nama' => 'X TBKR', 'jurusan' => 'Teknik Bodi Kendaraan Ringan'],
            ['nama' => 'XI TBKR', 'jurusan' => 'Teknik Bodi Kendaraan Ringan'],
            
            // IT
            ['nama' => 'X RPL 1', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            ['nama' => 'X RPL 2', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            ['nama' => 'XI RPL 1', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            ['nama' => 'XI RPL 2', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            ['nama' => 'XII RPL 1', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            ['nama' => 'XII RPL 2', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            
            ['nama' => 'X MKT', 'jurusan' => 'Mekatronika'],
            ['nama' => 'XI MKT', 'jurusan' => 'Mekatronika'],
            
            ['nama' => 'X TKJ', 'jurusan' => 'Teknik Komputer dan Jaringan'],
            ['nama' => 'XI TKJ', 'jurusan' => 'Teknik Komputer dan Jaringan'],
            ['nama' => 'XII TKJ', 'jurusan' => 'Teknik Komputer dan Jaringan'],
            
            ['nama' => 'X DKV', 'jurusan' => 'Desain Komunikasi Visual'],
            
            // PERTANIAN
            ['nama' => 'X ATPH', 'jurusan' => 'Agribisnis Tanaman Pangan Holtikultura'],
            ['nama' => 'XI ATPH', 'jurusan' => 'Agribisnis Tanaman Pangan Holtikultura'],
            
            ['nama' => 'X APHP', 'jurusan' => 'Agribisnis Pengolahan Hasil Pertanian'],
            ['nama' => 'XI APHP', 'jurusan' => 'Agribisnis Pengolahan Hasil Pertanian'],
        ];

        // Buat 30 Kelas
        $kelasData = [];
        foreach ($jurusan as $j) {
            $kelasData[] = Kelas::create([
                'nama_kelas' => $j['nama'],
                'kompetensi_keahlian' => $j['jurusan']
            ]);
        }

        // 4. Buat 1900 Siswa (63-64 per kelas)
        $totalSiswa = 0;
        foreach ($kelasData as $kelas) {
            $jumlahPerKelas = ($totalSiswa < 1800) ? 64 : 63; // Rata-rata agar total 1900
            
            for ($i = 1; $i <= $jumlahPerKelas; $i++) {
                $totalSiswa++;
                $nisn = str_pad($totalSiswa, 10, '0', STR_PAD_LEFT);
                $nis = str_pad($totalSiswa, 8, '0', STR_PAD_LEFT);
                
                Siswa::create([
                    'nisn' => $nisn,
                    'nis' => $nis,
                    'nama' => 'Siswa ' . $totalSiswa,
                    'id_kelas' => $kelas->id_kelas,
                    'alamat' => 'Jl. Contoh No. ' . $totalSiswa,
                    'no_telp' => '0812' . rand(10000000, 99999999),
                    'id_spp' => $spp->id_spp,
                    'username' => $nisn,
                    'password' => Hash::make('siswa123'),
                ]);
                
                if ($totalSiswa >= 1900) break;
            }
            
            if ($totalSiswa >= 1900) break;
        }

        echo "\n✅ Seeder berhasil!\n";
        echo "Total Siswa: {$totalSiswa}\n";
        echo "Total Kelas: " . count($kelasData) . "\n";
    }
}
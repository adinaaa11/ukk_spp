<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DataLengkapSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama
        DB::table('pembayaran')->delete();
        DB::table('siswa')->delete();
        DB::table('kelas')->delete();
        DB::table('spp')->delete();
        DB::table('petugas')->delete();

        echo "\n🔄 Membuat data lengkap...\n\n";

        // 1. PETUGAS
        echo "📝 Membuat petugas...\n";
        DB::table('petugas')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'nama_petugas' => 'Administrator',
                'level' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'petugas',
                'password' => Hash::make('petugas123'),
                'nama_petugas' => 'Petugas Loket',
                'level' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 2. SPP (3 nominal berbeda)
        echo "📝 Membuat SPP...\n";
        DB::table('spp')->insert([
            ['tahun' => 2025, 'nominal' => 75000, 'created_at' => now(), 'updated_at' => now()],
            ['tahun' => 2025, 'nominal' => 100000, 'created_at' => now(), 'updated_at' => now()],
            ['tahun' => 2025, 'nominal' => 175000, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 3. DATA KELAS LENGKAP (10 JURUSAN)
        echo "📝 Membuat kelas...\n";
        
        $kelasData = [
            // === BIDANG IT (4 jurusan x 3 tingkat = 12 kelas) ===
            // RPL - Rekayasa Perangkat Lunak
            ['nama' => 'X RPL 1', 'jurusan' => 'Rekayasa Perangkat Lunak (RPL)'],
            ['nama' => 'X RPL 2', 'jurusan' => 'Rekayasa Perangkat Lunak (RPL)'],
            ['nama' => 'XI RPL', 'jurusan' => 'Rekayasa Perangkat Lunak (RPL)'],
            ['nama' => 'XII RPL', 'jurusan' => 'Rekayasa Perangkat Lunak (RPL)'],
            
            // DKV - Desain Komunikasi Visual
            ['nama' => 'X DKV 1', 'jurusan' => 'Desain Komunikasi Visual (DKV)'],
            ['nama' => 'X DKV 2', 'jurusan' => 'Desain Komunikasi Visual (DKV)'],
            ['nama' => 'XI DKV 1', 'jurusan' => 'Desain Komunikasi Visual (DKV)'],
            ['nama' => 'XI DKV 2', 'jurusan' => 'Desain Komunikasi Visual (DKV)'],
            ['nama' => 'XII DKV 1', 'jurusan' => 'Desain Komunikasi Visual (DKV)'],
            ['nama' => 'XII DKV 2', 'jurusan' => 'Desain Komunikasi Visual (DKV)'],
            
            // MKT - Mekatronika
            ['nama' => 'X MKT 1', 'jurusan' => 'Mekatronika (MKT)'],
            ['nama' => 'X MKT 2', 'jurusan' => 'Mekatronika (MKT)'],
            ['nama' => 'XI MKT 1', 'jurusan' => 'Mekatronika (MKT)'],
            ['nama' => 'XI MKT 2', 'jurusan' => 'Mekatronika (MKT)'],
            ['nama' => 'XII MKT 1', 'jurusan' => 'Mekatronika (MKT)'],
            ['nama' => 'XII MKT 2', 'jurusan' => 'Mekatronika (MKT)'],
            
            // TKJ - Teknik Komputer dan Jaringan
            ['nama' => 'X TKJ 1', 'jurusan' => 'Teknik Komputer dan Jaringan (TKJ)'],
            ['nama' => 'X TKJ 2', 'jurusan' => 'Teknik Komputer dan Jaringan (TKJ)'],
            ['nama' => 'XI TKJ 1', 'jurusan' => 'Teknik Komputer dan Jaringan (TKJ)'],
            ['nama' => 'XI TKJ 2', 'jurusan' => 'Teknik Komputer dan Jaringan (TKJ)'],
            ['nama' => 'XII TKJ 1', 'jurusan' => 'Teknik Komputer dan Jaringan (TKJ)'],
            ['nama' => 'XII TKJ 2', 'jurusan' => 'Teknik Komputer dan Jaringan (TKJ)'],

            // === BIDANG PERMESINAN (4 jurusan x 3 tingkat = 12 kelas) ===
            // TPM - Teknik Permesinan
            ['nama' => 'X TPM 1', 'jurusan' => 'Teknik Permesinan (TPM)'],
            ['nama' => 'X TPM 2', 'jurusan' => 'Teknik Permesinan (TPM)'],
            ['nama' => 'XI TPM 1', 'jurusan' => 'Teknik Permesinan (TPM)'],
            ['nama' => 'XI TPM 2', 'jurusan' => 'Teknik Permesinan (TPM)'],
            ['nama' => 'XII TPM 1', 'jurusan' => 'Teknik Permesinan (TPM)'],
            ['nama' => 'XII TPM 2', 'jurusan' => 'Teknik Permesinan (TPM)'],
            
            // TL - Teknik Pengelasan
            ['nama' => 'X TL 1', 'jurusan' => 'Teknik Pengelasan (TL)'],
            ['nama' => 'X TL 2', 'jurusan' => 'Teknik Pengelasan (TL)'],
            ['nama' => 'XI TL 1', 'jurusan' => 'Teknik Pengelasan (TL)'],
            ['nama' => 'XI TL 2', 'jurusan' => 'Teknik Pengelasan (TL)'],
            ['nama' => 'XII TL 1', 'jurusan' => 'Teknik Pengelasan (TL)'],
            ['nama' => 'XII TL 2', 'jurusan' => 'Teknik Pengelasan (TL)'],
            
            // TBKR - Teknik Body Kendaraan Ringan
            ['nama' => 'X TBKR', 'jurusan' => 'Teknik Body Kendaraan Ringan (TBKR)'],
            ['nama' => 'XI TBKR', 'jurusan' => 'Teknik Body Kendaraan Ringan (TBKR)'],
            ['nama' => 'XII TBKR', 'jurusan' => 'Teknik Body Kendaraan Ringan (TBKR)'],
            
            // TKR - Teknik Kendaraan Ringan
            ['nama' => 'X TKR 1', 'jurusan' => 'Teknik Kendaraan Ringan (TKR)'],
            ['nama' => 'X TKR 2', 'jurusan' => 'Teknik Kendaraan Ringan (TKR)'],
            ['nama' => 'XI TKR 1', 'jurusan' => 'Teknik Kendaraan Ringan (TKR)'],
            ['nama' => 'XI TKR 2', 'jurusan' => 'Teknik Kendaraan Ringan (TKR)'],
            ['nama' => 'XII TKR 1', 'jurusan' => 'Teknik Kendaraan Ringan (TKR)'],
            ['nama' => 'XII TKR 2', 'jurusan' => 'Teknik Kendaraan Ringan (TKR)'],

            // === BIDANG PERTANIAN (2 jurusan x 3 tingkat = 6 kelas) ===
            // APHP - Agribisnis Pengolahan Hasil Pertanian
            ['nama' => 'X APHP 1', 'jurusan' => 'Agribisnis Pengolahan Hasil Pertanian (APHP)'],
            ['nama' => 'X APHP 2', 'jurusan' => 'Agribisnis Pengolahan Hasil Pertanian (APHP)'],
            ['nama' => 'X APHP 3', 'jurusan' => 'Agribisnis Pengolahan Hasil Pertanian (APHP)'],
            ['nama' => 'XI APHP 1', 'jurusan' => 'Agribisnis Pengolahan Hasil Pertanian (APHP)'],
            ['nama' => 'XI APHP 2', 'jurusan' => 'Agribisnis Pengolahan Hasil Pertanian (APHP)'],
            ['nama' => 'XI APHP 3', 'jurusan' => 'Agribisnis Pengolahan Hasil Pertanian (APHP)'],
            ['nama' => 'XII APHP 1', 'jurusan' => 'Agribisnis Pengolahan Hasil Pertanian (APHP)'],
            ['nama' => 'XII APHP 2', 'jurusan' => 'Agribisnis Pengolahan Hasil Pertanian (APHP)'],
            ['nama' => 'XII APHP 3', 'jurusan' => 'Agribisnis Pengolahan Hasil Pertanian (APHP)'],
            
            // ATPH - Agribisnis Tanaman Pangan dan Hortikultura
            ['nama' => 'X ATPH 1', 'jurusan' => 'Agribisnis Tanaman Pangan dan Hortikultura (ATPH)'],
            ['nama' => 'X ATPH 2', 'jurusan' => 'Agribisnis Tanaman Pangan dan Hortikultura (ATPH)'],
            ['nama' => 'XI ATPH 1', 'jurusan' => 'Agribisnis Tanaman Pangan dan Hortikultura (ATPH)'],
            ['nama' => 'XI ATPH 2', 'jurusan' => 'Agribisnis Tanaman Pangan dan Hortikultura (ATPH)'],
            ['nama' => 'XII ATPH 1', 'jurusan' => 'Agribisnis Tanaman Pangan dan Hortikultura (ATPH)'],
            ['nama' => 'XII ATPH 2', 'jurusan' => 'Agribisnis Tanaman Pangan dan Hortikultura (ATPH)'],
        ];

        foreach ($kelasData as $k) {
            DB::table('kelas')->insert([
                'nama_kelas' => $k['nama'],
                'kompetensi_keahlian' => $k['jurusan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 4. SISWA (35 siswa per kelas)
        echo "📝 Membuat siswa...\n";
        $kelasIds = DB::table('kelas')->pluck('id_kelas', 'nama_kelas');
        $sppIds = DB::table('spp')->pluck('id_spp')->toArray();
        
        $totalSiswa = 0;
        foreach ($kelasIds as $namaKelas => $idKelas) {
            for ($i = 1; $i <= 35; $i++) {
                $totalSiswa++;
                $nisn = str_pad($totalSiswa, 10, '0', STR_PAD_LEFT);
                $nis = str_pad($totalSiswa, 8, '0', STR_PAD_LEFT);
                
                DB::table('siswa')->insert([
                    'nisn' => $nisn,
                    'nis' => $nis,
                    'nama' => "Siswa {$namaKelas} No.{$i}",
                    'id_kelas' => $idKelas,
                    'alamat' => "Jl. Contoh No. {$totalSiswa}, Surabaya",
                    'no_telp' => '0812' . rand(10000000, 99999999),
                    'id_spp' => $sppIds[array_rand($sppIds)],
                    'username' => $nisn,
                    'password' => Hash::make('siswa123'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 5. PEMBAYARAN SAMPLE (untuk hari ini - 13 Januari 2025)
        echo "📝 Membuat pembayaran sample...\n";
        $tanggalHariIni = Carbon::create(2025, 1, 13);
        
        // Ambil beberapa siswa random untuk pembayaran hari ini
        $siswaIds = DB::table('siswa')->limit(50)->pluck('nisn')->toArray();
        $bulanList = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                      'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        foreach ($siswaIds as $nisn) {
            $siswa = DB::table('siswa')->where('nisn', $nisn)->first();
            
            DB::table('pembayaran')->insert([
                'id_petugas' => 1, // Admin
                'nisn' => $nisn,
                'tgl_bayar' => $tanggalHariIni,
                'bulan_dibayar' => $bulanList[array_rand($bulanList)],
                'tahun_dibayar' => '2025',
                'id_spp' => $siswa->id_spp,
                'jumlah_bayar' => DB::table('spp')->where('id_spp', $siswa->id_spp)->value('nominal'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        echo "\n========================================\n";
        echo "✅ SEEDER BERHASIL!\n";
        echo "========================================\n";
        echo "Total Kelas: " . count($kelasIds) . "\n";
        echo "Total Siswa: {$totalSiswa} (35 per kelas)\n";
        echo "Total Jurusan: 10\n";
        echo "Pembayaran Hari Ini (13 Jan 2025): " . count($siswaIds) . " transaksi\n";
        echo "========================================\n";
        echo "LOGIN ADMIN:\n";
        echo "  Username: admin\n";
        echo "  Password: admin123\n";
        echo "========================================\n";
        echo "LOGIN SISWA (contoh):\n";
        echo "  NISN: 0000000001\n";
        echo "  Password: siswa123\n";
        echo "========================================\n\n";
    }
}
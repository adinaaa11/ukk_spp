<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FixSiswaPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'siswa:fix-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix password siswa menjadi bcrypt hash dari siswa123';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Memperbaiki password siswa...');
        
        // Hash password siswa123
        $hashedPassword = Hash::make('siswa123');
        
        // Update semua siswa
        $count = DB::table('siswa')->update([
            'password' => $hashedPassword,
            'updated_at' => now(),
        ]);
        
        $this->info("✅ Password {$count} siswa berhasil diupdate!");
        $this->info("📌 Password default: siswa123");
        $this->line('');
        $this->line('Hash yang digunakan: ' . $hashedPassword);
        
        return Command::SUCCESS;
    }
}
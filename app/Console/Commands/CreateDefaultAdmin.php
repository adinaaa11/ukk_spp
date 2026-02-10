<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class CreateDefaultAdmin extends Command
{
    protected $signature = 'admin:create-default';
    protected $description = 'Buat admin default untuk aplikasi';

    public function handle()
    {
        // Cek apakah admin sudah ada
        $existing = Petugas::where('username', 'admin')->first();
        
        if ($existing) {
            $this->warn("⚠️  Admin dengan username 'admin' sudah ada!");
            
            if ($this->confirm('Reset password admin yang sudah ada?')) {
                $existing->update([
                    'password' => Hash::make('admin123')
                ]);
                
                $this->info("✅ Password admin berhasil direset!");
                $this->displayCredentials('admin', 'admin123', $existing->level);
            }
            
            return Command::SUCCESS;
        }
        
        // Buat admin baru
        $petugas = Petugas::create([
            'username' => 'admin',
            'nama_petugas' => 'Administrator',
            'password' => Hash::make('admin123'),
            'level' => 'admin',
        ]);
        
        $this->info("✅ Admin default berhasil dibuat!");
        $this->displayCredentials('admin', 'admin123', 'admin');
        
        return Command::SUCCESS;
    }
    
    private function displayCredentials($username, $password, $level)
    {
        $this->line("");
        $this->line("=================================");
        $this->line("Username: {$username}");
        $this->line("Password: {$password}");
        $this->line("Level: {$level}");
        $this->line("=================================");
        $this->line("");
    }
}
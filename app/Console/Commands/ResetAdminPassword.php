<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class ResetAdminPassword extends Command
{
    protected $signature = 'admin:reset-password {username}';
    protected $description = 'Reset password admin/petugas';

    public function handle()
    {
        $username = $this->argument('username');
        
        $petugas = Petugas::where('username', $username)->first();
        
        if (!$petugas) {
            $this->error("❌ User dengan username '{$username}' tidak ditemukan!");
            return Command::FAILURE;
        }
        
        // Password baru
        $newPassword = 'admin123';
        
        $petugas->update([
            'password' => Hash::make($newPassword)
        ]);
        
        $this->info("✅ Password berhasil direset!");
        $this->line("");
        $this->line("=================================");
        $this->line("Username: {$petugas->username}");
        $this->line("Password: {$newPassword}");
        $this->line("Level: {$petugas->level}");
        $this->line("=================================");
        
        return Command::SUCCESS;
    }
}
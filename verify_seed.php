<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Petugas;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

echo "\n=== DATA PETUGAS ===\n";
Petugas::all(['id_petugas', 'username', 'nama_petugas', 'level'])->each(function($p) {
    echo "ID: {$p->id_petugas}, User: {$p->username}, Nama: {$p->nama_petugas}, Level: {$p->level}\n";
});

echo "\n=== DATA SISWA ===\n";
Siswa::all(['nisn', 'nama', 'username', 'id_kelas'])->each(function($s) {
    echo "NISN: {$s->nisn}, Nama: {$s->nama}, User: {$s->username}, Kelas: {$s->id_kelas}\n";
});

echo "\n=== TESTING PASSWORD HASH ===\n";
$petugas = Petugas::where('username', 'admin')->first();
$adminMatch = $petugas ? Hash::check('admin123', $petugas->password) : false;
echo "Admin password match: " . ($adminMatch ? "✅ YES" : "❌ NO") . "\n";

$petugas2 = Petugas::where('username', 'petugas')->first();
$petugasMatch = $petugas2 ? Hash::check('petugas123', $petugas2->password) : false;
echo "Petugas password match: " . ($petugasMatch ? "✅ YES" : "❌ NO") . "\n";

$siswa = Siswa::where('nisn', '0012345678')->first();
$siswaMatch = $siswa ? Hash::check('siswa123', $siswa->password) : false;
echo "Siswa password match: " . ($siswaMatch ? "✅ YES" : "❌ NO") . "\n";

echo "\n========================================\n";
echo "✅ VERIFIKASI SELESAI!\n";
echo "========================================\n\n";
?>

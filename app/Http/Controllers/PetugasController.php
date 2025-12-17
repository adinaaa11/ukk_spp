<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::latest()->paginate(10);
        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:petugas,username|max:255',
            'nama_petugas' => 'required|string|max:255',
            'level' => 'required|in:admin,petugas',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Petugas::create([
            'username' => $request->username,
            'nama_petugas' => $request->nama_petugas,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('petugas.index')
            ->with('success', 'Data petugas berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $petugas = Petugas::with('pembayaran')->findOrFail($id);
        return view('petugas.show', compact('petugas'));
    }

    public function edit(string $id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('petugas.edit', compact('petugas'));
    }

    public function update(Request $request, string $id)
    {
        $petugas = Petugas::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255|unique:petugas,username,' . $id . ',id_petugas',
            'nama_petugas' => 'required|string|max:255',
            'level' => 'required|in:admin,petugas',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'username' => $request->username,
            'nama_petugas' => $request->nama_petugas,
            'level' => $request->level,
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        return redirect()->route('petugas.index')
            ->with('success', 'Data petugas berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $petugas = Petugas::findOrFail($id);

        // Cek apakah petugas ini sedang login
        if (auth()->id() == $id) {
            return redirect()->route('petugas.index')
                ->with('error', 'Tidak dapat menghapus akun yang sedang login!');
        }

        // Cek apakah petugas memiliki history transaksi
        if ($petugas->pembayaran()->count() > 0) {
            return redirect()->route('petugas.index')
                ->with('error', 'Tidak dapat menghapus petugas yang memiliki riwayat transaksi!');
        }

        $petugas->delete();

        return redirect()->route('petugas.index')
            ->with('success', 'Data petugas berhasil dihapus!');
    }
}
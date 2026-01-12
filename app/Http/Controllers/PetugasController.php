<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $query = Petugas::query();

        // Filter berdasarkan pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('nama_petugas', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan level
        if ($request->has('level') && !empty($request->level)) {
            $query->where('level', $request->level);
        }

        $petugas = $query->latest()->paginate(10);
        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        // VALIDASI LENGKAP
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:petugas,username',
                'regex:/^[a-zA-Z0-9_]+$/', // Hanya huruf, angka, underscore
            ],
            'nama_petugas' => [
                'required',
                'string',
                'max:255',
                'min:3',
            ],
            'level' => [
                'required',
                Rule::in(['admin', 'petugas']),
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],
        ], [
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'username.regex' => 'Username hanya boleh berisi huruf, angka, dan underscore',
            'nama_petugas.required' => 'Nama petugas harus diisi',
            'nama_petugas.min' => 'Nama petugas minimal 3 karakter',
            'level.required' => 'Level harus dipilih',
            'level.in' => 'Level harus admin atau petugas',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        Petugas::create([
            'username' => $validated['username'],
            'nama_petugas' => $validated['nama_petugas'],
            'level' => $validated['level'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('petugas.index')
            ->with('success', '✅ Data petugas berhasil ditambahkan!');
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

        // VALIDASI LENGKAP
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9_]+$/',
                Rule::unique('petugas', 'username')->ignore($id, 'id_petugas'),
            ],
            'nama_petugas' => [
                'required',
                'string',
                'max:255',
                'min:3',
            ],
            'level' => [
                'required',
                Rule::in(['admin', 'petugas']),
            ],
            'password' => [
                'nullable',
                'string',
                'min:6',
                'confirmed',
            ],
        ], [
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'username.regex' => 'Username hanya boleh berisi huruf, angka, dan underscore',
            'nama_petugas.required' => 'Nama petugas harus diisi',
            'nama_petugas.min' => 'Nama petugas minimal 3 karakter',
            'level.required' => 'Level harus dipilih',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $data = [
            'username' => $validated['username'],
            'nama_petugas' => $validated['nama_petugas'],
            'level' => $validated['level'],
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($validated['password']);
        }

        $petugas->update($data);

        return redirect()->route('petugas.index')
            ->with('success', '✅ Data petugas berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        try {
            $petugas = Petugas::findOrFail($id);

            // VALIDASI: Cek apakah petugas ini sedang login
            if (auth()->id() == $id) {
                return redirect()->route('petugas.index')
                    ->with('error', '❌ Tidak dapat menghapus akun yang sedang login!');
            }

            // VALIDASI: Cek apakah petugas memiliki history transaksi
            if ($petugas->pembayaran()->count() > 0) {
                return redirect()->route('petugas.index')
                    ->with('error', '❌ Tidak dapat menghapus petugas yang memiliki riwayat transaksi!');
            }

            $petugas->delete();

            return redirect()->route('petugas.index')
                ->with('success', '✅ Data petugas berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->route('petugas.index')
                ->with('error', '❌ Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
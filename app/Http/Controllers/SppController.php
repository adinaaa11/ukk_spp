<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    public function index()
    {
        $spp = Spp::withCount('siswa')->latest()->paginate(10);
        return view('spp.index', compact('spp'));
    }

    public function create()
    {
        return view('spp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|digits:4',
            'nominal' => 'required|integer|min:0',
        ]);

        Spp::create($request->all());

        return redirect()->route('spp.index')
            ->with('success', 'Data SPP berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $spp = Spp::with('siswa')->findOrFail($id);
        return view('spp.show', compact('spp'));
    }

    public function edit(string $id)
    {
        $spp = Spp::findOrFail($id);
        return view('spp.edit', compact('spp'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'tahun' => 'required|integer|digits:4',
            'nominal' => 'required|integer|min:0',
        ]);

        $spp = Spp::findOrFail($id);
        $spp->update($request->all());

        return redirect()->route('spp.index')
            ->with('success', 'Data SPP berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $spp = Spp::findOrFail($id);
        
        // Cek apakah ada siswa yang menggunakan SPP ini
        if ($spp->siswa()->count() > 0) {
            return redirect()->route('spp.index')
                ->with('error', 'Tidak dapat menghapus SPP yang masih digunakan siswa!');
        }

        $spp->delete();

        return redirect()->route('spp.index')
            ->with('success', 'Data SPP berhasil dihapus!');
    }
}
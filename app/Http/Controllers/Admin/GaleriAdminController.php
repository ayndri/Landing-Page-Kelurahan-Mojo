<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriAdminController extends Controller
{
    public function index()
    {
        $galeris = Galeri::orderBy('urutan')->orderByDesc('created_at')->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto'      => 'required|image|max:3072',
            'judul'     => 'nullable|string|max:255',
            'keterangan'=> 'nullable|string',
            'kategori'  => 'nullable|string|max:100',
            'urutan'    => 'nullable|integer',
        ]);

        $path = $request->file('foto')->store('galeri', 'public');

        Galeri::create([
            'foto'       => $path,
            'judul'      => $request->judul,
            'keterangan' => $request->keterangan,
            'kategori'   => $request->kategori,
            'urutan'     => $request->urutan ?? 0,
            'user_id'    => Auth::id(),
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'foto'      => 'nullable|image|max:3072',
            'judul'     => 'nullable|string|max:255',
            'keterangan'=> 'nullable|string',
            'kategori'  => 'nullable|string|max:100',
            'urutan'    => 'nullable|integer',
        ]);

        $data = [
            'judul'      => $request->judul,
            'keterangan' => $request->keterangan,
            'kategori'   => $request->kategori,
            'urutan'     => $request->urutan ?? 0,
        ];

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($galeri->foto);
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        Storage::disk('public')->delete($galeri->foto);
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil dihapus.');
    }
}

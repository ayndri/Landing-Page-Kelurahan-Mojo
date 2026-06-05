<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanAdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pengumumans = $user->isSuperAdmin()
            ? Pengumuman::with('user')->orderByDesc('tanggal')->get()
            : Pengumuman::where('user_id', $user->id)->orderByDesc('tanggal')->get();

        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'konten'   => 'required|string',
            'kategori' => 'required|string|in:Info,Kegiatan,Kesehatan,Administrasi',
            'tanggal'  => 'required|date',
        ]);

        $validated['is_penting'] = $request->boolean('is_penting');
        $validated['user_id']    = Auth::id();

        Pengumuman::create($validated);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        $this->authorizeAccess($pengumuman);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $this->authorizeAccess($pengumuman);

        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'konten'   => 'required|string',
            'kategori' => 'required|string|in:Info,Kegiatan,Kesehatan,Administrasi',
            'tanggal'  => 'required|date',
        ]);

        $validated['is_penting'] = $request->boolean('is_penting');
        $pengumuman->update($validated);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $this->authorizeAccess($pengumuman);
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }

    private function authorizeAccess(Pengumuman $pengumuman): void
    {
        $user = Auth::user();
        if ($user->isRwAdmin() && $pengumuman->user_id !== $user->id) {
            abort(403, 'Anda tidak punya akses ke pengumuman ini.');
        }
    }
}

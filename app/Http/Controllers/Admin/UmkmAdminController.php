<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UmkmAdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $umkm = $user->isSuperAdmin()
            ? Umkm::with('user')->latest()->get()
            : Umkm::with('user')
                ->whereHas('user', fn($q) => $q->where('rw_number', $user->rw_number))
                ->latest()->get();

        return view('admin.umkm.index', compact('umkm'));
    }

    public function create()
    {
        return view('admin.umkm.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'nullable|string|max:255',
            'nama_pemilik' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'produk' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'lokasi_keterangan' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:100',
            'shopee' => 'nullable|string|max:255',
            'jam_buka' => 'nullable|string|max:100',
            'foto' => 'nullable|image|max:5120',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        Umkm::create($validated);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil ditambahkan.');
    }

    public function edit(Umkm $umkm)
    {
        $this->authorizeAccess($umkm->user_id);
        $umkm->load('products');
        return view('admin.umkm.edit', compact('umkm'));
    }

    public function update(Request $request, Umkm $umkm)
    {
        $this->authorizeAccess($umkm->user_id);

        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'nullable|string|max:255',
            'nama_pemilik' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'produk' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'lokasi_keterangan' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:100',
            'shopee' => 'nullable|string|max:255',
            'jam_buka' => 'nullable|string|max:100',
            'foto' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            if ($umkm->foto) Storage::disk('public')->delete($umkm->foto);
            $validated['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        $umkm->update($validated);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil diperbarui.');
    }

    public function destroy(Umkm $umkm)
    {
        $this->authorizeAccess($umkm->user_id);

        if ($umkm->foto) Storage::disk('public')->delete($umkm->foto);
        $umkm->delete();

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil dihapus.');
    }

    private function authorizeAccess(?int $ownerId): void
    {
        $user = Auth::user();
        if ($user->isSuperAdmin()) return;

        $owner = User::find($ownerId);
        if (!$owner || $owner->rw_number !== $user->rw_number) {
            abort(403, 'Anda tidak punya akses ke data ini.');
        }
    }
}

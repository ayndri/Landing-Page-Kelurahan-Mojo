<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlantAdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $plants = $user->isSuperAdmin()
            ? Plant::with('user')->latest()->get()
            : Plant::with('user')
                ->whereHas('user', fn($q) => $q->where('rw_number', $user->rw_number))
                ->latest()->get();

        return view('admin.tanaman.index', compact('plants'));
    }

    public function create()
    {
        return view('admin.tanaman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nama_latin' => 'nullable|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'manfaat' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'lokasi_keterangan' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('tanaman', 'public');
        }

        Plant::create($validated);

        return redirect()->route('admin.tanaman.index')->with('success', 'Tanaman berhasil ditambahkan.');
    }

    public function edit(Plant $plant)
    {
        $this->authorizeAccess($plant->user_id);
        return view('admin.tanaman.edit', compact('plant'));
    }

    public function update(Request $request, Plant $plant)
    {
        $this->authorizeAccess($plant->user_id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nama_latin' => 'nullable|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'manfaat' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'lokasi_keterangan' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($plant->foto) Storage::disk('public')->delete($plant->foto);
            $validated['foto'] = $request->file('foto')->store('tanaman', 'public');
        }

        $plant->update($validated);

        return redirect()->route('admin.tanaman.index')->with('success', 'Tanaman berhasil diperbarui.');
    }

    public function destroy(Plant $plant)
    {
        $this->authorizeAccess($plant->user_id);

        if ($plant->foto) Storage::disk('public')->delete($plant->foto);
        $plant->delete();

        return redirect()->route('admin.tanaman.index')->with('success', 'Tanaman berhasil dihapus.');
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

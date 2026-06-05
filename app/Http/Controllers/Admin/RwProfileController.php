<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RwProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RwProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $rwNumber = $user->isSuperAdmin() ? request('rw', 9) : $user->rw_number;
        $profile = RwProfile::firstOrNew(['rw_number' => $rwNumber]);

        $availableRw = $user->isSuperAdmin() ? [9, 10, 11, 12, 13] : [$user->rw_number];

        return view('admin.profil.edit', compact('profile', 'rwNumber', 'availableRw'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $rwNumber = $user->isSuperAdmin() ? $request->rw_number : $user->rw_number;

        $validated = $request->validate([
            'nama_ketua' => 'nullable|string|max:255',
            'sekretaris' => 'nullable|string|max:255',
            'bendahara' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'alamat' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'jumlah_kk' => 'nullable|integer|min:0',
            'jumlah_penduduk' => 'nullable|integer|min:0',
            'foto_ketua' => 'nullable|image|max:2048',
            'foto_kegiatan' => 'nullable|image|max:2048',
        ]);

        $profile = RwProfile::firstOrNew(['rw_number' => $rwNumber]);
        $profile->rw_number = $rwNumber;

        if ($request->hasFile('foto_ketua')) {
            if ($profile->foto_ketua) Storage::disk('public')->delete($profile->foto_ketua);
            $validated['foto_ketua'] = $request->file('foto_ketua')->store('rw/foto', 'public');
        } else {
            unset($validated['foto_ketua']);
        }

        if ($request->hasFile('foto_kegiatan')) {
            if ($profile->foto_kegiatan) Storage::disk('public')->delete($profile->foto_kegiatan);
            $validated['foto_kegiatan'] = $request->file('foto_kegiatan')->store('rw/foto', 'public');
        } else {
            unset($validated['foto_kegiatan']);
        }

        $profile->fill($validated)->save();

        return back()->with('success', 'Profil RW ' . $rwNumber . ' berhasil diperbarui.');
    }
}

<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\UmkmProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UmkmProductController extends Controller {
    public function store(Request $request, Umkm $umkm) {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga'     => 'nullable|string|max:100',
            'foto'      => 'nullable|image|max:10240',
            'urutan'    => 'nullable|integer',
        ]);
        $validated['umkm_id'] = $umkm->id;
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('umkm-produk', 'public');
        }
        UmkmProduct::create($validated);
        return redirect()->route('admin.umkm.edit', $umkm)->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, Umkm $umkm, UmkmProduct $product) {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga'     => 'nullable|string|max:100',
            'foto'      => 'nullable|image|max:10240',
            'urutan'    => 'nullable|integer',
        ]);
        if ($request->hasFile('foto')) {
            if ($product->foto) Storage::disk('public')->delete($product->foto);
            $validated['foto'] = $request->file('foto')->store('umkm-produk', 'public');
        }
        $product->update($validated);
        return redirect()->route('admin.umkm.edit', $umkm)->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Umkm $umkm, UmkmProduct $product) {
        if ($product->foto) Storage::disk('public')->delete($product->foto);
        $product->delete();
        return redirect()->route('admin.umkm.edit', $umkm)->with('success', 'Produk berhasil dihapus.');
    }
}

@extends('layouts.admin')
@section('title', 'Edit UMKM: '.$umkm->nama_usaha)

@push('styles')
<style>
#map-picker { height: 350px; border-radius: 12px; overflow: hidden; position: relative; z-index: 0; }
.prod-edit-form { display: none; }
.prod-edit-form.open { display: block; }
</style>
@endpush

@section('content')
<div class="max-w-4xl space-y-6">

    {{-- ── UMKM FORM ── --}}
    <div class="bg-white rounded-xl shadow p-8">
        <form method="POST" action="{{ route('admin.umkm.update', $umkm) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            @include('admin.umkm._form')
            <div class="pt-4 border-t flex gap-3">
                <button type="submit" class="bg-amber-500 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-amber-600 transition text-sm">
                    Perbarui
                </button>
                <a href="{{ route('admin.umkm.index') }}" class="border border-gray-300 text-gray-600 px-6 py-2.5 rounded-lg text-sm hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

    {{-- ── PRODUK MANAGEMENT ── --}}
    <div class="bg-white rounded-xl shadow p-8">
        <h2 class="font-bold text-xl text-gray-800 mb-6 flex items-center gap-2">
            🛍️ Produk &amp; Layanan
        </h2>

        {{-- Existing products --}}
        @if($umkm->products->count() > 0)
        <div class="space-y-3 mb-8">
            @foreach($umkm->products as $product)
            <div class="border border-gray-200 rounded-xl overflow-hidden" id="prod-{{ $product->id }}">
                {{-- Product row --}}
                <div class="flex items-center gap-3 p-3">
                    <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-amber-50 flex items-center justify-center text-2xl">
                        @if($product->foto)
                        <img src="{{ Storage::url($product->foto) }}" alt="{{ $product->nama }}" class="w-full h-full object-cover">
                        @else
                        🛍️
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-bold text-gray-800">{{ $product->nama }}</div>
                        @if($product->harga)
                        <div class="text-amber-600 font-semibold text-sm">{{ $product->harga }}</div>
                        @endif
                        @if($product->deskripsi)
                        <div class="text-gray-400 text-xs truncate">{{ $product->deskripsi }}</div>
                        @endif
                    </div>
                    <div class="flex gap-2 flex-shrink-0">
                        <button type="button" onclick="toggleEdit({{ $product->id }})"
                            class="bg-amber-50 text-amber-700 px-3 py-1.5 rounded-lg text-sm font-semibold hover:bg-amber-100 transition">
                            Edit
                        </button>
                        <form method="POST" action="{{ route('admin.umkm.produk.destroy', [$umkm, $product]) }}"
                              onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-sm font-semibold hover:bg-red-100 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Inline edit form --}}
                <div class="prod-edit-form border-t border-gray-100 p-4 bg-gray-50" id="edit-{{ $product->id }}">
                    <form method="POST" action="{{ route('admin.umkm.produk.update', [$umkm, $product]) }}"
                          enctype="multipart/form-data" class="space-y-3">
                        @csrf @method('PUT')
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-xs font-semibold text-gray-600 block mb-1">Nama Produk *</label>
                                <input type="text" name="nama" value="{{ $product->nama }}" required
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400">
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-600 block mb-1">Harga</label>
                                <input type="text" name="harga" value="{{ $product->harga }}" placeholder="Rp 10.000"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400">
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-600 block mb-1">Deskripsi</label>
                            <textarea name="deskripsi" rows="2"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400">{{ $product->deskripsi }}</textarea>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-600 block mb-1">Foto Produk</label>
                            <input type="file" name="foto" accept="image/*"
                                onchange="previewImage(this, 'preview-prod-{{ $product->id }}')"
                                class="text-sm text-gray-600">
                            @if($product->foto)
                            <p class="text-xs text-gray-400 mt-1">Pilih foto baru untuk mengganti yang lama.</p>
                            @endif
                            <img id="preview-prod-{{ $product->id }}" class="hidden mt-2 w-20 h-20 object-cover rounded-lg border border-gray-200" alt="Preview foto produk baru">
                        </div>
                        <div class="flex gap-2">
                            <button type="submit"
                                class="bg-amber-500 text-white font-semibold px-4 py-2 rounded-lg text-sm hover:bg-amber-600 transition">
                                Simpan
                            </button>
                            <button type="button" onclick="toggleEdit({{ $product->id }})"
                                class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8 text-gray-400 text-sm mb-6">
            <div class="text-4xl mb-2">📦</div>
            Belum ada produk. Tambahkan produk pertama!
        </div>
        @endif

        {{-- Add new product --}}
        <div class="border border-dashed border-amber-300 rounded-xl p-5 bg-amber-50/40">
            <h3 class="font-bold text-gray-700 mb-4">➕ Tambah Produk Baru</h3>
            <form method="POST" action="{{ route('admin.umkm.produk.store', $umkm) }}"
                  enctype="multipart/form-data" class="space-y-3">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-semibold text-gray-600 block mb-1">Nama Produk *</label>
                        <input type="text" name="nama" required
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-600 block mb-1">Harga</label>
                        <input type="text" name="harga" placeholder="Rp 10.000"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 block mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="2" placeholder="Deskripsi singkat produk..."
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-amber-400"></textarea>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 block mb-1">Foto Produk</label>
                    <input type="file" name="foto" accept="image/*"
                        onchange="previewImage(this, 'preview-new-prod')"
                        class="text-sm text-gray-600">
                    <img id="preview-new-prod" class="hidden mt-2 w-20 h-20 object-cover rounded-lg border border-gray-200" alt="Preview foto produk baru">
                </div>
                <button type="submit"
                    class="bg-amber-500 text-white font-semibold px-5 py-2 rounded-lg text-sm hover:bg-amber-600 transition">
                    + Tambah Produk
                </button>
            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
function toggleEdit(id) {
    const form = document.getElementById('edit-' + id);
    form.classList.toggle('open');
}
function previewImage(input, previewId) {
    if (!input.files || !input.files[0]) return;
    const preview = document.getElementById(previewId);
    const reader = new FileReader();
    reader.onload = e => { preview.src = e.target.result; preview.classList.remove('hidden'); };
    reader.readAsDataURL(input.files[0]);
}
</script>
@endpush

@include('admin.tanaman._map_script')
@endsection

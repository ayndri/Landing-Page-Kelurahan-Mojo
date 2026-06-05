<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Usaha <span class="text-red-500">*</span></label>
        <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $umkm->nama_usaha ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 @error('nama_usaha') border-red-400 @enderror">
        @error('nama_usaha')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Usaha</label>
        <input type="text" name="jenis_usaha" value="{{ old('jenis_usaha', $umkm->jenis_usaha ?? '') }}"
            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="Contoh: Kuliner, Kerajinan, Jasa">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik</label>
        <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik', $umkm->nama_pemilik ?? '') }}"
            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
        <input type="text" name="no_telepon" value="{{ old('no_telepon', $umkm->no_telepon ?? '') }}"
            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
        <div class="flex">
            <span class="bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg px-3 py-2.5 text-sm text-gray-500">@</span>
            <input type="text" name="instagram" value="{{ old('instagram', $umkm->instagram ?? '') }}"
                class="flex-1 border border-gray-300 rounded-r-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
        </div>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Buka</label>
        <input type="text" name="jam_buka" value="{{ old('jam_buka', $umkm->jam_buka ?? '') }}"
            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="Contoh: 08.00 - 17.00">
    </div>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Link Shopee</label>
    <div class="flex">
        <span class="bg-orange-50 border border-r-0 border-gray-300 rounded-l-lg px-3 py-2.5 text-sm text-orange-500 font-medium">shopee.co.id/</span>
        <input type="text" name="shopee" value="{{ old('shopee', $umkm->shopee ?? '') }}"
            class="flex-1 border border-gray-300 rounded-r-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="nama-toko atau URL lengkap">
    </div>
    <p class="text-xs text-gray-400 mt-1">Isi username Shopee atau tempel URL lengkap toko Shopee</p>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Usaha</label>
    <textarea name="deskripsi" rows="3"
        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">{{ old('deskripsi', $umkm->deskripsi ?? '') }}</textarea>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Produk / Layanan</label>
    <textarea name="produk" rows="3"
        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">{{ old('produk', $umkm->produk ?? '') }}</textarea>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Foto UMKM</label>
    @if(isset($umkm) && $umkm->foto)
        <img src="{{ Storage::url($umkm->foto) }}" class="w-32 h-32 object-cover rounded-lg mb-2 border">
    @endif
    <input type="file" name="foto" accept="image/*"
        onchange="previewImage(this, 'preview-foto-umkm')"
        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-amber-50 file:text-amber-700">
    <img id="preview-foto-umkm" class="hidden mt-2 w-32 h-32 object-cover rounded-lg border border-gray-200" alt="Preview foto baru">
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Lokasi</label>
    <input type="text" name="lokasi_keterangan" value="{{ old('lokasi_keterangan', $umkm->lokasi_keterangan ?? '') }}"
        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="Contoh: Jl. Mojo No. 5, RT 02">
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Pin Lokasi di Peta</label>
    <div class="flex gap-2 mb-2">
        <input type="text" id="alamat-search"
            placeholder="Ketik alamat, cth: Jl. Mojo No. 5 Surabaya"
            onkeydown="if(event.key==='Enter'){event.preventDefault();cariAlamat()}"
            class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
        <button type="button" onclick="cariAlamat()"
            class="bg-amber-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-amber-600 transition whitespace-nowrap">
            Cari Lokasi
        </button>
    </div>
    <p class="text-xs text-gray-400 mb-2">Atau klik langsung pada peta untuk menentukan lokasi UMKM</p>
    <div id="map-picker"></div>
    <div class="grid grid-cols-2 gap-3 mt-3">
        <div>
            <label class="text-xs text-gray-500">Latitude</label>
            <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $umkm->latitude ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="-7.2575">
        </div>
        <div>
            <label class="text-xs text-gray-500">Longitude</label>
            <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $umkm->longitude ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="112.7521">
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input, previewId) {
    if (!input.files || !input.files[0]) return;
    const preview = document.getElementById(previewId);
    const reader = new FileReader();
    reader.onload = e => { preview.src = e.target.result; preview.classList.remove('hidden'); };
    reader.readAsDataURL(input.files[0]);
}
</script>
@endpush

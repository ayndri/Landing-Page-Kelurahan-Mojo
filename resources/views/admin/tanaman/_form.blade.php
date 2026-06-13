<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tanaman <span class="text-red-500">*</span></label>
        <input type="text" name="nama" value="{{ old('nama', $plant->nama ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f] @error('nama') border-red-400 @enderror">
        @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Latin</label>
        <input type="text" name="nama_latin" value="{{ old('nama_latin', $plant->nama_latin ?? '') }}"
            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]" placeholder="Contoh: Moringa oleifera">
    </div>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis / Kategori</label>
    <input type="text" name="jenis" value="{{ old('jenis', $plant->jenis ?? '') }}"
        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]" placeholder="Contoh: Tanaman Obat, Sayuran, Buah">
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
    <textarea name="deskripsi" rows="3"
        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]">{{ old('deskripsi', $plant->deskripsi ?? '') }}</textarea>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Manfaat</label>
    <textarea name="manfaat" rows="3"
        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]">{{ old('manfaat', $plant->manfaat ?? '') }}</textarea>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Tanaman</label>
    @if(isset($plant) && $plant->foto)
        <img src="{{ Storage::url($plant->foto) }}" class="w-32 h-32 object-cover rounded-lg mb-2 border">
    @endif
    <input type="file" name="foto" accept="image/*"
        onchange="previewImage(this, 'preview-foto-tanaman')"
        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-[#2d6a4f] @error('foto') ring-1 ring-red-400 rounded-lg @enderror">
    <p class="text-xs text-gray-400 mt-1">Format gambar (JPG/PNG), maksimal 10 MB.</p>
    @error('foto')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    <img id="preview-foto-tanaman" class="hidden mt-2 w-32 h-32 object-cover rounded-lg border border-gray-200" alt="Preview foto baru">
</div>

{{-- Lokasi --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Lokasi</label>
    <input type="text" name="lokasi_keterangan" value="{{ old('lokasi_keterangan', $plant->lokasi_keterangan ?? '') }}"
        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]" placeholder="Contoh: Di depan rumah Pak Budi, RT 03">
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Pin Lokasi di Peta</label>
    <div class="flex gap-2 mb-2">
        <input type="text" id="alamat-search"
            placeholder="Ketik alamat, cth: Jl. Mojo No. 5 Surabaya"
            onkeydown="if(event.key==='Enter'){event.preventDefault();cariAlamat()}"
            class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]">
        <button type="button" onclick="cariAlamat()"
            class="bg-[#2d6a4f] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#40916c] transition whitespace-nowrap">
            Cari Lokasi
        </button>
    </div>
    <p class="text-xs text-gray-400 mb-2">Atau klik langsung pada peta untuk menentukan lokasi tanaman</p>
    <div id="map-picker"></div>
    <div class="grid grid-cols-2 gap-3 mt-3">
        <div>
            <label class="text-xs text-gray-500">Latitude</label>
            <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $plant->latitude ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]" placeholder="-7.2575">
        </div>
        <div>
            <label class="text-xs text-gray-500">Longitude</label>
            <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $plant->longitude ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]" placeholder="112.7521">
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

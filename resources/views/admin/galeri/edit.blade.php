@extends('layouts.admin')
@section('title', 'Edit Foto Galeri')

@section('content')
<div class="max-w-xl">
    <div class="bg-white rounded-xl shadow p-8">
        <div class="mb-6">
            <img id="preview-foto" src="{{ Storage::url($galeri->foto) }}" alt="{{ $galeri->judul }}"
                 class="w-full h-48 object-cover rounded-xl">
        </div>
        <form method="POST" action="{{ route('admin.galeri.update', $galeri) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ganti Foto</label>
                <input type="file" name="foto" accept="image/*"
                       onchange="previewImage(this, 'preview-foto')"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]">
                <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul / Keterangan Singkat</label>
                <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori</label>
                    <select name="kategori"
                            class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]">
                        <option value="">— Pilih —</option>
                        @foreach(['Kegiatan','Lingkungan','Sosial','Rapat','Lainnya'] as $k)
                        <option value="{{ $k }}" {{ old('kategori', $galeri->kategori) === $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', $galeri->urutan) }}" min="0"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Keterangan</label>
                <textarea name="keterangan" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f] resize-none">{{ old('keterangan', $galeri->keterangan) }}</textarea>
            </div>

            <div class="pt-4 border-t flex gap-3">
                <button type="submit" class="bg-[#2d6a4f] text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-[#40916c] transition text-sm">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="border border-gray-300 text-gray-600 px-6 py-2.5 rounded-lg text-sm hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

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

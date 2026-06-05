@extends('layouts.admin')
@section('title', 'Edit Profil RW '.$rwNumber)

@section('content')
<div class="max-w-3xl">
    @if(auth()->user()->isSuperAdmin() && count($availableRw) > 1)
    <div class="mb-6 flex gap-2 flex-wrap">
        @foreach($availableRw as $rw)
            <a href="{{ route('admin.profil.edit', ['rw' => $rw]) }}"
               class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $rw == $rwNumber ? 'bg-[#2d6a4f] text-white' : 'bg-white text-gray-600 border hover:border-[#2d6a4f]' }}">
                RW {{ $rw }}
            </a>
        @endforeach
    </div>
    @endif

    <div class="bg-white rounded-xl shadow p-8">
        <h2 class="text-lg font-bold text-gray-800 mb-6 pb-4 border-b">Profil RW {{ $rwNumber }}</h2>

        <form method="POST" action="{{ route('admin.profil.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @if(auth()->user()->isSuperAdmin())
                <input type="hidden" name="rw_number" value="{{ $rwNumber }}">
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ketua</label>
                    <input type="text" name="nama_ketua" value="{{ old('nama_ketua', $profile->nama_ketua) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sekretaris</label>
                    <input type="text" name="sekretaris" value="{{ old('sekretaris', $profile->sekretaris) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bendahara</label>
                    <input type="text" name="bendahara" value="{{ old('bendahara', $profile->bendahara) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah KK</label>
                    <input type="number" name="jumlah_kk" value="{{ old('jumlah_kk', $profile->jumlah_kk) }}" min="0"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Penduduk</label>
                    <input type="number" name="jumlah_penduduk" value="{{ old('jumlah_penduduk', $profile->jumlah_penduduk) }}" min="0"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat', $profile->alamat) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                <input type="text" name="no_telepon" value="{{ old('no_telepon', $profile->no_telepon) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi RW</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]">{{ old('deskripsi', $profile->deskripsi) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Visi</label>
                <textarea name="visi" rows="2"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]">{{ old('visi', $profile->visi) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Misi</label>
                <textarea name="misi" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]">{{ old('misi', $profile->misi) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Ketua</label>
                    @if($profile->foto_ketua)
                        <img src="{{ Storage::url($profile->foto_ketua) }}" class="w-24 h-24 rounded-full object-cover mb-2 border">
                    @endif
                    <input type="file" name="foto_ketua" accept="image/*"
                        onchange="previewImage(this, 'preview-foto-ketua')"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-[#2d6a4f]">
                    <img id="preview-foto-ketua" class="hidden mt-2 w-24 h-24 rounded-full object-cover border border-gray-200" alt="Preview foto ketua baru">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Kegiatan</label>
                    @if($profile->foto_kegiatan)
                        <img src="{{ Storage::url($profile->foto_kegiatan) }}" class="w-full h-24 object-cover rounded-lg mb-2 border">
                    @endif
                    <input type="file" name="foto_kegiatan" accept="image/*"
                        onchange="previewImage(this, 'preview-foto-kegiatan')"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-[#2d6a4f]">
                    <img id="preview-foto-kegiatan" class="hidden mt-2 w-full h-24 object-cover rounded-lg border border-gray-200" alt="Preview foto kegiatan baru">
                </div>
            </div>

            <div class="pt-4 border-t flex gap-3">
                <button type="submit" class="bg-[#2d6a4f] text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-[#40916c] transition text-sm">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.dashboard') }}" class="border border-gray-300 text-gray-600 px-6 py-2.5 rounded-lg text-sm hover:bg-gray-50 transition">
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

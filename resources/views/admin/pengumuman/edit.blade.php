@extends('layouts.admin')
@section('title', 'Edit Pengumuman')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow p-8">
        <form method="POST" action="{{ route('admin.pengumuman.update', $pengumuman) }}" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul) }}" required
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]">
                @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" required
                            class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]">
                        @foreach(['Info','Kegiatan','Kesehatan','Administrasi'] as $k)
                        <option value="{{ $k }}" {{ old('kategori', $pengumuman->kategori) === $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $pengumuman->tanggal->format('Y-m-d')) }}" required
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Isi Pengumuman <span class="text-red-500">*</span></label>
                <textarea name="konten" rows="7" required
                          class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f] resize-none">{{ old('konten', $pengumuman->konten) }}</textarea>
                @error('konten') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_penting" id="is_penting" value="1"
                       class="w-4 h-4 accent-red-600" {{ old('is_penting', $pengumuman->is_penting) ? 'checked' : '' }}>
                <label for="is_penting" class="text-sm font-medium text-gray-700">
                    Tandai sebagai <span class="text-red-600 font-semibold">Penting</span>
                    <span class="text-gray-400 font-normal">(ditampilkan paling atas)</span>
                </label>
            </div>

            <div class="pt-4 border-t flex gap-3">
                <button type="submit" class="bg-[#2d6a4f] text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-[#40916c] transition text-sm">
                    Perbarui Pengumuman
                </button>
                <a href="{{ route('admin.pengumuman.index') }}" class="border border-gray-300 text-gray-600 px-6 py-2.5 rounded-lg text-sm hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

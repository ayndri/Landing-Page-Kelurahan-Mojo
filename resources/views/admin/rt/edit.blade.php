@extends('layouts.admin')
@section('title', 'Edit RT {{ $rt->rt_number }} — RW {{ $rt->rw_number }}')

@section('content')
<div class="max-w-lg">
    <div class="bg-white rounded-xl shadow p-8">
        <div class="mb-5 pb-4 border-b border-gray-100">
            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wide">Mengedit</p>
            <p class="text-lg font-bold text-gray-800">RT {{ $rt->rt_number }} — RW {{ $rt->rw_number }}</p>
        </div>
        <form method="POST" action="{{ route('admin.rt.update', $rt) }}" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Ketua RT</label>
                <input type="text" name="nama_ketua" value="{{ old('nama_ketua', $rt->nama_ketua) }}"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor Telepon</label>
                <input type="text" name="no_telepon" value="{{ old('no_telepon', $rt->no_telepon) }}"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah KK</label>
                    <input type="number" name="jumlah_kk" value="{{ old('jumlah_kk', $rt->jumlah_kk) }}" min="0"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah Penduduk</label>
                    <input type="number" name="jumlah_penduduk" value="{{ old('jumlah_penduduk', $rt->jumlah_penduduk) }}" min="0"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]">
                </div>
            </div>

            <div class="pt-4 border-t flex gap-3">
                <button type="submit" class="bg-[#2d6a4f] text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-[#40916c] transition text-sm">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.rt.index') }}" class="border border-gray-300 text-gray-600 px-6 py-2.5 rounded-lg text-sm hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

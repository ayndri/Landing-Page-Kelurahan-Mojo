@extends('layouts.admin')
@section('title', 'Tambah RT')

@section('content')
<div class="max-w-lg">
    <div class="bg-white rounded-xl shadow p-8">
        <form method="POST" action="{{ route('admin.rt.store') }}" class="space-y-5">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">RW <span class="text-red-500">*</span></label>
                    <select name="rw_number" required
                            class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]"
                            {{ count($rwOptions) === 1 ? 'disabled' : '' }}>
                        @foreach($rwOptions as $rw)
                        <option value="{{ $rw }}" {{ old('rw_number', $rwOptions[0]) == $rw ? 'selected' : '' }}>RW {{ $rw }}</option>
                        @endforeach
                    </select>
                    @if(count($rwOptions) === 1)
                    <input type="hidden" name="rw_number" value="{{ $rwOptions[0] }}">
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor RT <span class="text-red-500">*</span></label>
                    <input type="number" name="rt_number" value="{{ old('rt_number') }}" min="1" max="99" required
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]"
                           placeholder="cth: 1">
                    @error('rt_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Ketua RT</label>
                <input type="text" name="nama_ketua" value="{{ old('nama_ketua') }}"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]"
                       placeholder="cth: Bapak Suwarto">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor Telepon</label>
                <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]"
                       placeholder="cth: 0812-3456-7890">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah KK</label>
                    <input type="number" name="jumlah_kk" value="{{ old('jumlah_kk') }}" min="0"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah Penduduk</label>
                    <input type="number" name="jumlah_penduduk" value="{{ old('jumlah_penduduk') }}" min="0"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]/40 focus:border-[#2d6a4f]">
                </div>
            </div>

            <div class="pt-4 border-t flex gap-3">
                <button type="submit" class="bg-[#2d6a4f] text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-[#40916c] transition text-sm">
                    Simpan
                </button>
                <a href="{{ route('admin.rt.index') }}" class="border border-gray-300 text-gray-600 px-6 py-2.5 rounded-lg text-sm hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

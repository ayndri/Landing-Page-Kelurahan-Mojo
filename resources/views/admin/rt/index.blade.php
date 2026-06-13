@extends('layouts.admin')
@section('title', 'Daftar RT')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $rts->flatten()->count() }} RT terdaftar</p>
    <a href="{{ route('admin.rt.create') }}"
       class="bg-[#2d6a4f] text-white text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-[#40916c] transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah RT
    </a>
</div>

@if($rts->count())
    @foreach($rts as $rwNum => $rtList)
    <div class="mb-6">
        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-3">RW {{ $rwNum }}</h3>
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="w-full text-sm min-w-[700px]">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">RT</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Ketua RT</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Telepon</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">KK</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Penduduk</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($rtList->sortBy('rt_number') as $rt)
                    <tr>
                        <td class="px-5 py-3 font-bold text-[#2d6a4f]">RT {{ $rt->rt_number }}</td>
                        <td class="px-5 py-3 text-gray-800">{{ $rt->nama_ketua ?: '—' }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $rt->no_telepon ?: '—' }}</td>
                        <td class="px-5 py-3 text-gray-700">{{ $rt->jumlah_kk ? number_format($rt->jumlah_kk) : '—' }}</td>
                        <td class="px-5 py-3 text-gray-700">{{ $rt->jumlah_penduduk ? number_format($rt->jumlah_penduduk) : '—' }}</td>
                        <td class="px-5 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('admin.rt.edit', $rt) }}"
                               class="text-[#2d6a4f] hover:underline text-xs font-medium mr-3">Edit</a>
                            <form method="POST" action="{{ route('admin.rt.destroy', $rt) }}"
                                  class="inline" onsubmit="return confirm('Hapus RT {{ $rt->rt_number }} dari RW {{ $rwNum }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
@else
<div class="bg-white rounded-xl shadow p-16 text-center">
    <div class="text-5xl mb-4">🏘️</div>
    <h3 class="text-gray-600 font-semibold mb-2">Belum ada data RT</h3>
    <a href="{{ route('admin.rt.create') }}" class="text-[#2d6a4f] text-sm hover:underline">+ Tambah RT pertama</a>
</div>
@endif
@endsection

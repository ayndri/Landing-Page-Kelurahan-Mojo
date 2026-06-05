@extends('layouts.admin')
@section('title', 'Kelola Pengumuman')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $pengumumans->count() }} pengumuman terdaftar</p>
    <a href="{{ route('admin.pengumuman.create') }}"
       class="bg-[#2d6a4f] text-white text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-[#40916c] transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Pengumuman
    </a>
</div>

@if($pengumumans->count())
<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-5 py-3 text-gray-600 font-medium">Judul</th>
                <th class="text-left px-5 py-3 text-gray-600 font-medium">Kategori</th>
                <th class="text-left px-5 py-3 text-gray-600 font-medium">Tanggal</th>
                <th class="text-left px-5 py-3 text-gray-600 font-medium">Status</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($pengumumans as $p)
            @php
            $colors = ['Info'=>'#2563eb','Kegiatan'=>'#2d6a4f','Kesehatan'=>'#dc2626','Administrasi'=>'#d97706'];
            $color  = $colors[$p->kategori] ?? '#6b7280';
            @endphp
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4">
                    <div class="font-medium text-gray-800">{{ $p->judul }}</div>
                    <div class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ Str::limit($p->konten, 60) }}</div>
                </td>
                <td class="px-5 py-4">
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full"
                          style="background:{{ $color }}18;color:{{ $color }};">
                        {{ $p->kategori }}
                    </span>
                </td>
                <td class="px-5 py-4 text-gray-500 text-xs">{{ $p->tanggal->format('d M Y') }}</td>
                <td class="px-5 py-4">
                    @if($p->is_penting)
                    <span class="text-xs font-bold bg-red-50 text-red-600 border border-red-200 px-2 py-0.5 rounded-full">Penting</span>
                    @else
                    <span class="text-xs text-gray-400">—</span>
                    @endif
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-2 justify-end">
                        <a href="{{ route('pengumuman.show', $p) }}" target="_blank"
                           class="text-gray-400 hover:text-blue-500 transition" title="Lihat">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </a>
                        <a href="{{ route('admin.pengumuman.edit', $p) }}"
                           class="text-gray-400 hover:text-[#2d6a4f] transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form method="POST" action="{{ route('admin.pengumuman.destroy', $p) }}"
                              onsubmit="return confirm('Hapus pengumuman ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="bg-white rounded-xl shadow p-16 text-center">
    <div class="text-5xl mb-4">📢</div>
    <h3 class="text-gray-600 font-semibold mb-2">Belum ada pengumuman</h3>
    <a href="{{ route('admin.pengumuman.create') }}" class="text-[#2d6a4f] text-sm hover:underline">+ Tambah pengumuman pertama</a>
</div>
@endif
@endsection

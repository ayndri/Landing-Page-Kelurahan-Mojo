@extends('layouts.admin')
@section('title', 'Kelola Galeri')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm">{{ $galeris->total() }} foto terdaftar</p>
    <a href="{{ route('admin.galeri.create') }}"
       class="bg-[#2d6a4f] text-white text-sm font-medium px-4 py-2.5 rounded-lg hover:bg-[#40916c] transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Upload Foto
    </a>
</div>

@if($galeris->count())
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem;">
    @foreach($galeris as $g)
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div style="height:160px;overflow:hidden;position:relative;">
            <img src="{{ Storage::url($g->foto) }}" alt="{{ $g->judul }}"
                 style="width:100%;height:100%;object-fit:cover;">
            @if($g->kategori)
            <span style="position:absolute;top:8px;left:8px;background:rgba(0,0,0,0.55);color:#fff;font-size:0.6rem;font-weight:700;padding:2px 8px;border-radius:9999px;">{{ $g->kategori }}</span>
            @endif
        </div>
        <div class="p-3">
            <div class="text-sm font-semibold text-gray-800 truncate">{{ $g->judul ?: '—' }}</div>
            <div class="text-xs text-gray-400 mt-0.5">Urutan: {{ $g->urutan }}</div>
            <div class="flex items-center gap-2 mt-2 pt-2 border-t border-gray-100">
                <a href="{{ route('admin.galeri.edit', $g) }}"
                   class="text-xs font-medium text-[#2d6a4f] hover:underline">Edit</a>
                <form method="POST" action="{{ route('admin.galeri.destroy', $g) }}"
                      onsubmit="return confirm('Hapus foto ini?')" class="ml-auto">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-xs font-medium text-red-400 hover:text-red-600">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="mt-4">{{ $galeris->links() }}</div>
@else
<div class="bg-white rounded-xl shadow p-16 text-center">
    <div class="text-5xl mb-4">🖼️</div>
    <h3 class="text-gray-600 font-semibold mb-2">Belum ada foto</h3>
    <a href="{{ route('admin.galeri.create') }}" class="text-[#2d6a4f] text-sm hover:underline">+ Upload foto pertama</a>
</div>
@endif
@endsection

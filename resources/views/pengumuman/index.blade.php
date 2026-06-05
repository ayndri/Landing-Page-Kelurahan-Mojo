@extends('layouts.app')
@section('title', 'Pengumuman - Kelurahan Mojo 2')

@push('styles')
<style>
.pengumuman-item {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1.5rem;
    padding: 1.375rem 1.5rem;
    background: #fff;
    border-radius: 1rem;
    border: 1px solid #f0f0f0;
    box-shadow: 0 1px 6px rgba(0,0,0,0.04);
    text-decoration: none;
    transition: box-shadow 0.2s, transform 0.15s;
}
.pengumuman-item:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.09); transform: translateY(-1px); }
</style>
@endpush

@section('content')

<section style="background:linear-gradient(135deg,#1e3a8a,#2563eb);color:#fff;padding:2.75rem 1.5rem;">
    <div style="max-width:52rem;margin:0 auto;">
        <div style="font-size:0.8125rem;color:rgba(191,219,254,0.8);margin-bottom:0.5rem;">
            <a href="{{ route('home') }}" style="color:rgba(191,219,254,0.8);text-decoration:none;" class="hover:text-white">Beranda</a>
            &rsaquo; Pengumuman
        </div>
        <h1 style="font-size:clamp(1.75rem,4vw,2.5rem);font-weight:900;margin:0 0 0.5rem;letter-spacing:-0.02em;">Pengumuman</h1>
        <p style="color:rgba(191,219,254,0.75);font-size:0.9375rem;margin:0;">Informasi dan pengumuman resmi dari Kelurahan Mojo 2</p>
    </div>
</section>

<section style="background:#f8fafc;min-height:60vh;padding:3rem 1.5rem;">
    <div style="max-width:52rem;margin:0 auto;">

        @forelse($pengumumans as $p)
        @php
        $colors = ['Info'=>'#2563eb','Kegiatan'=>'#2d6a4f','Kesehatan'=>'#dc2626','Administrasi'=>'#d97706'];
        $color  = $colors[$p->kategori] ?? '#6b7280';
        @endphp

        <a href="{{ route('pengumuman.show', $p) }}" class="pengumuman-item" style="margin-bottom:0.875rem;border-left:4px solid {{ $color }};">
            <div style="flex:1;min-width:0;">
                <div style="display:flex;align-items:center;flex-wrap:wrap;gap:6px;margin-bottom:6px;">
                    @if($p->is_penting)
                    <span style="font-size:0.6rem;font-weight:800;letter-spacing:0.06em;text-transform:uppercase;background:#fef2f2;color:#dc2626;border:1px solid #fecaca;padding:2px 8px;border-radius:9999px;">Penting</span>
                    @endif
                    <span style="font-size:0.65rem;font-weight:700;padding:2px 9px;border-radius:9999px;background:{{ $color }}18;color:{{ $color }};">{{ $p->kategori }}</span>
                </div>
                <div style="font-weight:800;font-size:1rem;color:#111827;margin-bottom:4px;line-height:1.35;">{{ $p->judul }}</div>
                <div style="font-size:0.85rem;color:#6b7280;line-height:1.6;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $p->konten }}</div>
            </div>
            <div style="text-align:right;flex-shrink:0;padding-top:2px;">
                <div style="font-size:0.8125rem;font-weight:700;color:#374151;white-space:nowrap;">{{ $p->tanggal->translatedFormat('d M') }}</div>
                <div style="font-size:0.75rem;color:#9ca3af;">{{ $p->tanggal->format('Y') }}</div>
                <div style="margin-top:10px;font-size:0.75rem;font-weight:600;color:{{ $color }};">Baca →</div>
            </div>
        </a>

        @empty
        <div style="text-align:center;padding:5rem 0;color:#9ca3af;">
            <div style="font-size:3.5rem;margin-bottom:1rem;">📢</div>
            <p style="font-size:0.9375rem;font-weight:500;">Belum ada pengumuman saat ini.</p>
            <p style="font-size:0.85rem;margin-top:4px;">Cek lagi nanti ya.</p>
        </div>
        @endforelse

        @if($pengumumans->hasPages())
        <div style="margin-top:2rem;">
            {{ $pengumumans->links() }}
        </div>
        @endif

    </div>
</section>

@endsection

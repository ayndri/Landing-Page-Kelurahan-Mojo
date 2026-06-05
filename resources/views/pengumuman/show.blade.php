@extends('layouts.app')
@section('title', $pengumuman->judul . ' - Kelurahan Mojo 2')

@section('content')

@php
$colors = ['Info'=>'#2563eb','Kegiatan'=>'#2d6a4f','Kesehatan'=>'#dc2626','Administrasi'=>'#d97706'];
$color  = $colors[$pengumuman->kategori] ?? '#6b7280';
@endphp

<section style="background:linear-gradient(135deg,#1e3a8a,#2563eb);color:#fff;padding:2.75rem 1.5rem;">
    <div style="max-width:52rem;margin:0 auto;">
        <div style="font-size:0.8125rem;color:rgba(191,219,254,0.8);margin-bottom:0.75rem;">
            <a href="{{ route('home') }}" style="color:rgba(191,219,254,0.8);text-decoration:none;">Beranda</a>
            &rsaquo;
            <a href="{{ route('pengumuman.index') }}" style="color:rgba(191,219,254,0.8);text-decoration:none;">Pengumuman</a>
            &rsaquo; {{ Str::limit($pengumuman->judul, 40) }}
        </div>

        <div style="display:flex;align-items:center;flex-wrap:wrap;gap:8px;margin-bottom:1rem;">
            @if($pengumuman->is_penting)
            <span style="font-size:0.65rem;font-weight:800;letter-spacing:0.06em;text-transform:uppercase;background:rgba(220,38,38,0.25);color:#fca5a5;border:1px solid rgba(220,38,38,0.4);padding:3px 10px;border-radius:9999px;">Penting</span>
            @endif
            <span style="font-size:0.7rem;font-weight:700;padding:3px 10px;border-radius:9999px;background:rgba(255,255,255,0.15);color:rgba(255,255,255,0.9);">{{ $pengumuman->kategori }}</span>
        </div>

        <h1 style="font-size:clamp(1.5rem,4vw,2.25rem);font-weight:900;margin:0 0 0.75rem;letter-spacing:-0.02em;line-height:1.2;">{{ $pengumuman->judul }}</h1>
        <div style="color:rgba(191,219,254,0.7);font-size:0.875rem;">
            {{ $pengumuman->tanggal->translatedFormat('l, d F Y') }}
        </div>
    </div>
</section>

<section style="background:#f8fafc;padding:2.5rem 1.5rem;min-height:50vh;">
    <div style="max-width:52rem;margin:0 auto;">
        <div style="background:#fff;border-radius:1.25rem;border:1px solid #f0f0f0;box-shadow:0 2px 12px rgba(0,0,0,0.05);padding:2.5rem;">
            <div style="font-size:0.9375rem;color:#374151;line-height:1.9;white-space:pre-line;">{{ $pengumuman->konten }}</div>
        </div>

        @php
            $waText = "📢 *{$pengumuman->judul}*" .
                "\n📅 " . $pengumuman->tanggal->translatedFormat('d F Y') .
                ($pengumuman->is_penting ? "\n⚠️ _Pengumuman Penting_" : '') .
                "\n\nSelengkapnya:\n" . route('pengumuman.show', $pengumuman) .
                "\n\n_dari *Website Kelurahan Mojo 2*_";
            $waUrl = "https://wa.me/?text=" . rawurlencode($waText);
        @endphp
        <div style="margin-top:2rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
            <a href="{{ route('pengumuman.index') }}"
               style="display:inline-flex;align-items:center;gap:6px;font-size:0.875rem;font-weight:600;color:#374151;text-decoration:none;background:#fff;border:1px solid #e5e7eb;padding:9px 18px;border-radius:9999px;transition:background 0.15s;"
               onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='#fff'">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Pengumuman
            </a>
            <div style="display:flex;align-items:center;gap:0.75rem;">
                <a href="{{ $waUrl }}" target="_blank" rel="noopener"
                   style="display:inline-flex;align-items:center;gap:6px;background:#22c55e;color:#fff;font-size:0.8rem;font-weight:700;padding:9px 16px;border-radius:9999px;text-decoration:none;transition:background 0.15s;"
                   onmouseover="this.style.background='#16a34a'" onmouseout="this.style.background='#22c55e'">
                    <svg style="width:0.875rem;height:0.875rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Bagikan ke WA
                </a>
                <div style="font-size:0.8rem;color:#9ca3af;">
                    Diposting {{ $pengumuman->tanggal->diffForHumans() }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

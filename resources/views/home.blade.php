@extends('layouts.app')
@section('title', 'Kelurahan Mojo 2 — Kota Surabaya')

@push('styles')
<style>
/* ── HERO ── */
.hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    overflow: hidden;
    background: #0f1f17;
}
.hero-photo {
    position: absolute;
    inset: 0;
    background-image: url('/images/hero-kelurahan.jpg');
    background-size: cover;
    background-position: center;
    transform: scale(1.05);
    transition: transform 8s ease;
}
.hero-photo.loaded { transform: scale(1); }
.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(10,25,15,0.92) 0%,
        rgba(10,25,15,0.55) 45%,
        rgba(10,25,15,0.2) 100%
    );
}
.hero-content {
    position: relative;
    z-index: 10;
    max-width: 72rem;
    margin: 0 auto;
    padding: 0 1.5rem 5rem;
    width: 100%;
}
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(8px);
    border-radius: 9999px;
    padding: 6px 16px;
    margin-bottom: 1.5rem;
    font-size: 0.8125rem;
    color: rgba(209,250,229,0.9);
    font-weight: 500;
    letter-spacing: 0.02em;
}
.hero-title {
    font-size: clamp(3rem, 8vw, 6rem);
    font-weight: 900;
    line-height: 1.0;
    color: #fff;
    letter-spacing: -0.03em;
    margin: 0 0 1.25rem;
}
.hero-title span { color: #74c69d; }
.hero-sub {
    font-size: clamp(1rem, 2vw, 1.2rem);
    color: rgba(209,250,229,0.7);
    max-width: 34rem;
    line-height: 1.7;
    margin: 0 0 2.5rem;
}
.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
}
.btn-primary {
    background: #2d6a4f;
    color: #fff;
    font-weight: 700;
    padding: 14px 28px;
    border-radius: 9999px;
    font-size: 0.9375rem;
    text-decoration: none;
    transition: background 0.2s, transform 0.15s;
    box-shadow: 0 4px 20px rgba(45,106,79,0.4);
}
.btn-primary:hover { background: #40916c; transform: translateY(-1px); }
.btn-ghost {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.25);
    color: #fff;
    font-weight: 600;
    padding: 14px 28px;
    border-radius: 9999px;
    font-size: 0.9375rem;
    text-decoration: none;
    backdrop-filter: blur(4px);
    transition: background 0.2s;
}
.btn-ghost:hover { background: rgba(255,255,255,0.2); }

/* Scroll indicator */
.scroll-hint {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.4);
    font-size: 0.75rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}
.scroll-arrow {
    width: 28px; height: 28px;
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    animation: bounce 2s infinite;
}
@keyframes bounce {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(6px); }
}

/* ── SECTION HEADERS ── */
.section-tag {
    display: inline-block;
    font-size: 0.7rem;
    font-weight: 800;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: #2d6a4f;
    margin-bottom: 0.75rem;
}
.divider-green {
    width: 40px; height: 3px;
    background: #2d6a4f;
    border-radius: 9999px;
    margin: 0.875rem 0 1.25rem;
}

/* ── PLANT CARDS ── */
.plant-grid-home {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}
@media(min-width: 768px) { .plant-grid-home { grid-template-columns: repeat(4, 1fr); } }

.plant-card-home {
    background: #fff;
    border-radius: 1.125rem;
    border: 1px solid #f0f0f0;
    overflow: hidden;
    text-decoration: none;
    display: block;
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
}
.plant-card-home:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(0,0,0,0.10); }
.plant-card-home-img {
    width: 100%; height: 160px;
    object-fit: cover; display: block;
    transition: transform 0.4s;
}
.plant-card-home:hover .plant-card-home-img { transform: scale(1.04); }
.plant-card-home-imgwrap { overflow: hidden; position: relative; height: 160px; }

/* ── UMKM CARDS ── */
.umkm-grid-home {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}
@media(min-width: 640px) { .umkm-grid-home { grid-template-columns: repeat(3, 1fr); } }

.umkm-card-home {
    background: #fff;
    border-radius: 1.125rem;
    border: 1px solid #f0f0f0;
    overflow: hidden;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    transition: transform 0.2s, box-shadow 0.2s;
}
.umkm-card-home:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(0,0,0,0.10); }

/* ── GALERI ── */
.galeri-grid {
    display: grid;
    gap: 10px;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: 220px 220px;
}
@media(min-width: 768px) {
    .galeri-grid {
        grid-template-columns: 1.6fr 1fr 1fr;
        grid-template-rows: 240px 240px;
    }
    .galeri-item-main { grid-row: span 2; }
}
.galeri-item {
    border-radius: 1rem;
    overflow: hidden;
    position: relative;
    background: #e5e7eb;
}
.galeri-item img {
    width: 100%; height: 100%;
    object-fit: cover; display: block;
    transition: transform 0.4s;
}
.galeri-item:hover img { transform: scale(1.04); }

/* ── VISI MISI ── */
.vm-section {
    background: linear-gradient(160deg, #1a3d2b 0%, #2d6a4f 100%);
    position: relative;
    overflow: hidden;
}
.vm-section::before {
    content: '';
    position: absolute;
    right: -10%; top: -20%;
    width: 500px; height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(116,198,157,0.15) 0%, transparent 65%);
    pointer-events: none;
}
.vm-visi-card {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 1.5rem;
    padding: 2.5rem;
    backdrop-filter: blur(8px);
    position: relative;
}
.vm-quote-mark {
    font-size: 8rem;
    line-height: 0.8;
    color: rgba(116,198,157,0.25);
    font-family: Georgia, serif;
    position: absolute;
    top: 1rem; left: 2rem;
    pointer-events: none;
}
.misi-item-vm {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
    padding: 1rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}
.misi-item-vm:last-child { border-bottom: none; }
.misi-num-vm {
    min-width: 32px; height: 32px;
    border-radius: 50%;
    background: rgba(116,198,157,0.2);
    border: 1px solid rgba(116,198,157,0.4);
    color: #74c69d;
    font-size: 0.8125rem;
    font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

/* ── RW CARDS ── */
.rw-card-home {
    background: #fff;
    border-radius: 1.25rem;
    border: 1px solid #f0f0f0;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    overflow: hidden;
    text-decoration: none;
    display: block;
    transition: transform 0.2s, box-shadow 0.2s;
}
.rw-card-home:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(0,0,0,0.10); }
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════════════
     HERO
══════════════════════════════════════════════ --}}
<section class="hero-section">
    <div class="hero-photo" id="hero-photo"></div>
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <div class="hero-badge">
            <span style="width:7px;height:7px;background:#74c69d;border-radius:50%;display:inline-block;flex-shrink:0;"></span>
            Kota Surabaya &middot; Jawa Timur
        </div>
        <h1 class="hero-title">
            Kelurahan<br><span>Mojo 2</span>
        </h1>
        <p class="hero-sub">
            Portal warga RW 9 sampai 13 — tempat cari info tanaman, UMKM, dan profil pengurus di satu tempat.
        </p>
        <div class="hero-actions">
            <a href="#tanaman" class="btn-primary">Lihat Tanaman</a>
            <a href="#umkm" class="btn-ghost">UMKM Warga</a>
        </div>
    </div>

    <div class="scroll-hint">
        <div class="scroll-arrow">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     STATISTIK
══════════════════════════════════════════════ --}}
<section style="background:#f9fafb;border-top:1px solid #f0f0f0;border-bottom:1px solid #f0f0f0;padding:0 1.5rem;">
    <div style="max-width:72rem;margin:0 auto;">
        <div style="display:grid;grid-template-columns:repeat(2,1fr);" class="stats-grid-4">
            <style>@media(min-width:640px){.stats-grid-4{grid-template-columns:repeat(4,1fr);}}</style>
            <div style="text-align:center;padding:2rem 1rem;border-right:1px solid #f0f0f0;">
                <div style="font-size:3rem;font-weight:900;color:#111827;line-height:1;letter-spacing:-0.03em;">
                    <span class="stat-counter" data-target="5">0</span>
                </div>
                <div style="color:#6b7280;font-size:0.875rem;margin-top:6px;font-weight:500;">Rukun Warga</div>
            </div>
            <div style="text-align:center;padding:2rem 1rem;border-right:1px solid #f0f0f0;">
                <div style="font-size:3rem;font-weight:900;line-height:1;letter-spacing:-0.03em;">
                    <span class="stat-counter" data-target="{{ $plantCount }}" style="color:#2d6a4f;">0</span>
                </div>
                <div style="color:#6b7280;font-size:0.875rem;margin-top:6px;font-weight:500;">Tanaman Terdata</div>
            </div>
            <div style="text-align:center;padding:2rem 1rem;border-right:1px solid #f0f0f0;">
                <div style="font-size:3rem;font-weight:900;line-height:1;letter-spacing:-0.03em;">
                    <span class="stat-counter" data-target="{{ $umkmCount }}" style="color:#2d6a4f;">0</span>
                </div>
                <div style="color:#6b7280;font-size:0.875rem;margin-top:6px;font-weight:500;">UMKM Aktif</div>
            </div>
            <div style="text-align:center;padding:2rem 1rem;">
                <div style="font-size:3rem;font-weight:900;color:#111827;line-height:1;letter-spacing:-0.03em;">
                    <span class="stat-counter" data-target="5">0</span><span style="font-size:2rem;color:#2d6a4f;">RW</span>
                </div>
                <div style="color:#6b7280;font-size:0.875rem;margin-top:6px;font-weight:500;">Terdigitalisasi</div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     PENGUMUMAN
══════════════════════════════════════════════ --}}
@if($pengumumans->count())
<section style="background:#fff;padding:3rem 1.5rem;border-top:1px solid #f0f0f0;">
    <div style="max-width:72rem;margin:0 auto;">

        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:1.5rem;">
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:36px;height:36px;background:#eff6ff;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.125rem;flex-shrink:0;">📢</div>
                <div>
                    <div style="font-size:0.68rem;font-weight:800;letter-spacing:0.13em;text-transform:uppercase;color:#2563eb;">Info Kelurahan</div>
                    <h2 style="font-size:1.1875rem;font-weight:900;color:#111827;margin:0;letter-spacing:-0.01em;">Pengumuman Terbaru</h2>
                </div>
            </div>
            <a href="{{ route('pengumuman.index') }}"
               style="display:inline-flex;align-items:center;gap:5px;font-size:0.8125rem;font-weight:600;color:#2563eb;text-decoration:none;background:#eff6ff;padding:7px 14px;border-radius:9999px;transition:background 0.15s;"
               onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                Lihat Semua
                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <style>
        .pengumuman-row { display:flex;align-items:flex-start;justify-content:space-between;gap:1.25rem;padding:1rem 1.25rem;border-left:3px solid var(--kc);text-decoration:none;transition:background 0.15s; }
        .pengumuman-row:hover { background:#f0faf4; }
        .pengumuman-row:first-child { border-radius:0.75rem 0.75rem 0 0; }
        .pengumuman-row:last-child  { border-radius:0 0 0.75rem 0.75rem; }
        </style>

        <div style="border:1px solid #f0f0f0;border-radius:0.75rem;overflow:hidden;background:#f9fafb;">
            @foreach($pengumumans as $p)
            @php
            $kColors = ['Info'=>'#2563eb','Kegiatan'=>'#2d6a4f','Kesehatan'=>'#dc2626','Administrasi'=>'#d97706'];
            $kColor  = $kColors[$p->kategori] ?? '#6b7280';
            @endphp
            <a href="{{ route('pengumuman.show', $p) }}"
               class="pengumuman-row {{ !$loop->last ? 'border-b border-gray-100' : '' }}"
               style="--kc:{{ $kColor }};background:{{ $loop->odd ? '#fff' : '#fafafa' }};">
                <div style="flex:1;min-width:0;">
                    <div style="display:flex;align-items:center;flex-wrap:wrap;gap:5px;margin-bottom:3px;">
                        @if($p->is_penting)
                        <span style="font-size:0.58rem;font-weight:800;letter-spacing:0.05em;text-transform:uppercase;background:#fef2f2;color:#dc2626;border:1px solid #fecaca;padding:1px 7px;border-radius:9999px;">Penting</span>
                        @endif
                        <span style="font-size:0.62rem;font-weight:700;padding:1px 8px;border-radius:9999px;background:{{ $kColor }}18;color:{{ $kColor }};">{{ $p->kategori }}</span>
                    </div>
                    <div style="font-weight:700;font-size:0.9375rem;color:#111827;margin-bottom:2px;">{{ $p->judul }}</div>
                    <div style="font-size:0.8rem;color:#6b7280;line-height:1.5;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;">{{ $p->konten }}</div>
                </div>
                <div style="text-align:right;flex-shrink:0;padding-top:1px;">
                    <div style="font-size:0.8rem;font-weight:700;color:#374151;white-space:nowrap;">{{ $p->tanggal->format('d M') }}</div>
                    <div style="font-size:0.7rem;color:#9ca3af;">{{ $p->tanggal->format('Y') }}</div>
                </div>
            </a>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════
     TENTANG KELURAHAN
══════════════════════════════════════════════ --}}
<section id="tentang" style="background:#fff;padding:5.5rem 1.5rem;">
    <div style="max-width:72rem;margin:0 auto;display:grid;gap:4rem;grid-template-columns:1fr;" class="md-two-col">
        <style>@media(min-width:768px){.md-two-col{grid-template-columns:1fr 1fr;align-items:center;}}</style>

        <div>
            <div class="section-tag">Tentang Kami</div>
            <h2 style="font-size:clamp(1.875rem,4vw,2.75rem);font-weight:900;color:#111827;line-height:1.1;letter-spacing:-0.02em;margin:0 0 0.5rem;">
                Satu kelurahan,<br>banyak cerita
            </h2>
            <div class="divider-green"></div>
            <p style="color:#4b5563;font-size:0.9375rem;line-height:1.85;margin:0 0 1.125rem;">
                Kelurahan Mojo 2 ada di Kecamatan Gubeng, Surabaya. Lima Rukun Warga — RW 9 sampai 13 — dengan ratusan kepala keluarga yang sudah lama saling kenal dan bergotong royong.
            </p>
            <p style="color:#6b7280;font-size:0.9rem;line-height:1.8;margin:0 0 2rem;">
                Di sini banyak tanaman obat yang ditanam di depan rumah, ada juga usaha-usaha kecil yang sudah turun-temurun. Website ini dibuat supaya semua itu bisa ditemukan dengan mudah.
            </p>
            <div style="display:flex;flex-wrap:wrap;gap:1rem;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:40px;height:40px;background:#f0faf4;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg style="width:1.125rem;height:1.125rem;color:#2d6a4f;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div style="font-size:0.75rem;color:#9ca3af;">Lokasi</div>
                        <div style="font-size:0.875rem;font-weight:600;color:#374151;">Kec. Gubeng, Surabaya</div>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:40px;height:40px;background:#f0faf4;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg style="width:1.125rem;height:1.125rem;color:#2d6a4f;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <div>
                        <div style="font-size:0.75rem;color:#9ca3af;">Rukun Warga</div>
                        <div style="font-size:0.875rem;font-weight:600;color:#374151;">RW 9 — RW 13</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Photo grid --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;grid-template-rows:200px 200px;gap:10px;">
            <div style="border-radius:1.25rem;overflow:hidden;grid-row:span 2;background:#e5e7eb;position:relative;">
                <img src="/images/about-1.jpg" alt="Kelurahan Mojo 2"
                     style="width:100%;height:100%;object-fit:cover;"
                     onerror="this.parentElement.innerHTML='<div style=\'width:100%;height:100%;background:linear-gradient(135deg,#1a3d2b,#2d6a4f);display:flex;align-items:center;justify-content:center;\'><span style=\'font-size:3rem;\'>🏘️</span></div>'">
            </div>
            <div style="border-radius:1.25rem;overflow:hidden;background:#e5e7eb;">
                <img src="/images/about-2.jpg" alt="Warga"
                     style="width:100%;height:100%;object-fit:cover;"
                     onerror="this.parentElement.innerHTML='<div style=\'width:100%;height:100%;background:linear-gradient(135deg,#40916c,#52b788);display:flex;align-items:center;justify-content:center;\'><span style=\'font-size:2.5rem;\'>👥</span></div>'">
            </div>
            <div style="border-radius:1.25rem;overflow:hidden;background:#e5e7eb;">
                <img src="/images/about-3.jpg" alt="Kegiatan"
                     style="width:100%;height:100%;object-fit:cover;"
                     onerror="this.parentElement.innerHTML='<div style=\'width:100%;height:100%;background:linear-gradient(135deg,#74c69d,#95d5b2);display:flex;align-items:center;justify-content:center;\'><span style=\'font-size:2.5rem;\'>🌿</span></div>'">
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     TANAMAN WARGA
══════════════════════════════════════════════ --}}
<section id="tanaman" style="background:#f8fafc;padding:5rem 1.5rem;border-top:1px solid #f0f0f0;">
    <div style="max-width:72rem;margin:0 auto;">

        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2.5rem;">
            <div>
                <div class="section-tag">Flora & Toga</div>
                <h2 style="font-size:clamp(1.75rem,3.5vw,2.5rem);font-weight:900;color:#111827;line-height:1.1;letter-spacing:-0.02em;margin:0.25rem 0 0.625rem;">
                    Tanaman di Sini
                </h2>
                <p style="color:#6b7280;font-size:0.9rem;margin:0;max-width:32rem;line-height:1.6;">
                    Dari halaman rumah warga sampai pekarangan — {{ $plantCount }} jenis tanaman sudah terdata lengkap.
                </p>
            </div>
            <a href="{{ route('tanaman.index') }}"
               style="display:inline-flex;align-items:center;gap:6px;background:#2d6a4f;color:#fff;font-weight:700;font-size:0.875rem;padding:10px 20px;border-radius:9999px;text-decoration:none;white-space:nowrap;transition:background 0.2s;"
               onmouseover="this.style.background='#40916c'" onmouseout="this.style.background='#2d6a4f'">
                Lihat Semua
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M7 7h10v10"/></svg>
            </a>
        </div>

        @if($plants->count())
        <div class="plant-grid-home">
            @foreach($plants as $plant)
            <a href="{{ route('tanaman.show', $plant) }}" class="plant-card-home">
                <div class="plant-card-home-imgwrap">
                    @if($plant->foto)
                        <img src="{{ Storage::url($plant->foto) }}" alt="{{ $plant->nama }}" class="plant-card-home-img">
                    @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#1b4332,#2d6a4f);display:flex;align-items:center;justify-content:center;font-size:3rem;">🌿</div>
                    @endif
                    @if($plant->jenis)
                    <div style="position:absolute;top:8px;left:8px;background:rgba(45,106,79,0.85);backdrop-filter:blur(4px);color:#fff;font-size:0.65rem;font-weight:700;padding:3px 9px;border-radius:9999px;letter-spacing:0.04em;">
                        {{ $plant->jenis }}
                    </div>
                    @endif
                </div>
                <div style="padding:0.875rem 1rem 1rem;">
                    <div style="font-weight:800;font-size:0.9375rem;color:#111827;margin-bottom:2px;">{{ $plant->nama }}</div>
                    @if($plant->nama_latin)
                    <div style="font-size:0.75rem;color:#9ca3af;font-style:italic;">{{ $plant->nama_latin }}</div>
                    @endif
                    @if($plant->manfaat)
                    <div style="font-size:0.8rem;color:#6b7280;margin-top:6px;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                        {{ Str::limit(collect(explode("\n", $plant->manfaat))->first(), 70) }}
                    </div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div style="text-align:center;padding:4rem 0;color:#9ca3af;">
            <div style="font-size:3rem;margin-bottom:1rem;">🌱</div>
            <p style="font-size:0.9rem;">Belum ada tanaman yang ditambahkan.</p>
        </div>
        @endif

    </div>
</section>

{{-- ══════════════════════════════════════════════
     UMKM WARGA
══════════════════════════════════════════════ --}}
<section id="umkm" style="background:#fff;padding:5rem 1.5rem;border-top:1px solid #f0f0f0;">
    <div style="max-width:72rem;margin:0 auto;">

        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2.5rem;">
            <div>
                <div style="display:inline-block;font-size:0.7rem;font-weight:800;letter-spacing:0.14em;text-transform:uppercase;color:#d97706;margin-bottom:0.75rem;">Ekonomi Lokal</div>
                <h2 style="font-size:clamp(1.75rem,3.5vw,2.5rem);font-weight:900;color:#111827;line-height:1.1;letter-spacing:-0.02em;margin:0.25rem 0 0.625rem;">
                    UMKM Warga
                </h2>
                <p style="color:#6b7280;font-size:0.9rem;margin:0;max-width:32rem;line-height:1.6;">
                    {{ $umkmCount }} usaha yang dijalankan sendiri oleh warga — dari makanan sampai jasa.
                </p>
            </div>
            <a href="{{ route('umkm.index') }}"
               style="display:inline-flex;align-items:center;gap:6px;background:#d97706;color:#fff;font-weight:700;font-size:0.875rem;padding:10px 20px;border-radius:9999px;text-decoration:none;white-space:nowrap;transition:background 0.2s;"
               onmouseover="this.style.background='#b45309'" onmouseout="this.style.background='#d97706'">
                Lihat Semua
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M7 7h10v10"/></svg>
            </a>
        </div>

        @if($umkm->count())
        <div class="umkm-grid-home">
            @foreach($umkm as $u)
            <div class="umkm-card-home" onclick="window.location.href='{{ route('umkm.show', $u) }}'" style="cursor:pointer;">
                {{-- Foto --}}
                <div style="height:180px;overflow:hidden;position:relative;flex-shrink:0;">
                    @if($u->foto)
                        <img src="{{ Storage::url($u->foto) }}" alt="{{ $u->nama_usaha }}"
                             style="width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.4s;">
                    @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#431407,#c2410c);display:flex;align-items:center;justify-content:center;font-size:3rem;">🏪</div>
                    @endif
                    @if($u->jenis_usaha)
                    <div style="position:absolute;top:10px;left:10px;background:rgba(0,0,0,0.5);backdrop-filter:blur(6px);color:#fff;font-size:0.65rem;font-weight:700;padding:3px 9px;border-radius:9999px;">
                        {{ $u->jenis_usaha }}
                    </div>
                    @endif
                </div>

                {{-- Info --}}
                <div style="padding:1rem 1.125rem 1.125rem;display:flex;flex-direction:column;flex:1;">
                    <div style="font-weight:800;font-size:0.9375rem;color:#111827;margin-bottom:3px;">{{ $u->nama_usaha }}</div>
                    @if($u->nama_pemilik)
                    <div style="font-size:0.8rem;color:#9ca3af;margin-bottom:8px;">oleh {{ $u->nama_pemilik }}</div>
                    @endif
                    @if($u->deskripsi)
                    <p style="font-size:0.8125rem;color:#6b7280;line-height:1.6;margin:0 0 12px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $u->deskripsi }}</p>
                    @endif

                    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto;padding-top:10px;border-top:1px solid #f3f4f6;">
                        @if($u->jam_buka)
                        <span style="font-size:0.75rem;color:#6b7280;">🕐 {{ $u->jam_buka }}</span>
                        @else
                        <span></span>
                        @endif
                        @if($u->no_telepon)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $u->no_telepon) }}"
                           target="_blank" onclick="event.stopPropagation()"
                           style="display:inline-flex;align-items:center;gap:5px;background:#22c55e;color:#fff;font-size:0.7rem;font-weight:700;padding:5px 11px;border-radius:9999px;text-decoration:none;">
                            <svg style="width:0.75rem;height:0.75rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            WA
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div style="text-align:center;padding:4rem 0;color:#9ca3af;">
            <div style="font-size:3rem;margin-bottom:1rem;">🏪</div>
            <p style="font-size:0.9rem;">Belum ada UMKM yang ditambahkan.</p>
        </div>
        @endif

    </div>
</section>

{{-- ══════════════════════════════════════════════
     AGENDA KEGIATAN (widget)
══════════════════════════════════════════════ --}}
@if($agendas->count())
<section style="background:#f0faf4;padding:3rem 1.5rem;border-top:1px solid #d1fae5;">
    <div style="max-width:72rem;margin:0 auto;">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:1.5rem;">
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:36px;height:36px;background:#dcfce7;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.125rem;flex-shrink:0;">📅</div>
                <div>
                    <div style="font-size:0.68rem;font-weight:800;letter-spacing:0.13em;text-transform:uppercase;color:#2d6a4f;">Jadwal</div>
                    <h2 style="font-size:1.1875rem;font-weight:900;color:#111827;margin:0;letter-spacing:-0.01em;">Agenda Mendatang</h2>
                </div>
            </div>
            <a href="{{ route('agenda.index') }}"
               style="display:inline-flex;align-items:center;gap:5px;font-size:0.8125rem;font-weight:600;color:#2d6a4f;text-decoration:none;background:#dcfce7;padding:7px 14px;border-radius:9999px;transition:background 0.15s;"
               onmouseover="this.style.background='#bbf7d0'" onmouseout="this.style.background='#dcfce7'">
                Lihat Semua
                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div style="display:grid;gap:0.75rem;grid-template-columns:1fr;" class="agenda-widget-grid">
            <style>@media(min-width:640px){.agenda-widget-grid{grid-template-columns:repeat(2,1fr);}}
            @media(min-width:1024px){.agenda-widget-grid{grid-template-columns:repeat(4,1fr);}}</style>
            @foreach($agendas as $a)
            @php
                $agBadgeColors = ['Kesehatan'=>'#dc2626','Sosial'=>'#2563eb','Rapat'=>'#d97706','Olahraga'=>'#16a34a','Pendidikan'=>'#7c3aed','Lainnya'=>'#6b7280'];
                $agColor = $agBadgeColors[$a->kategori] ?? '#6b7280';
            @endphp
            <a href="{{ route('agenda.index') }}" style="display:flex;align-items:stretch;background:#fff;border-radius:0.875rem;overflow:hidden;border:1px solid #d1fae5;text-decoration:none;transition:box-shadow 0.2s;"
               onmouseover="this.style.boxShadow='0 4px 16px rgba(45,106,79,0.12)'" onmouseout="this.style.boxShadow=''">
                <div style="background:{{ $agColor }};color:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:0.875rem;min-width:58px;flex-shrink:0;">
                    <span style="font-size:1.5rem;font-weight:900;line-height:1;">{{ $a->tanggal->format('d') }}</span>
                    <span style="font-size:0.625rem;font-weight:700;text-transform:uppercase;opacity:0.85;">{{ $a->tanggal->translatedFormat('M') }}</span>
                </div>
                <div style="padding:0.75rem 1rem;flex:1;min-width:0;">
                    <div style="font-weight:700;font-size:0.875rem;color:#111827;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $a->judul }}</div>
                    @if($a->lokasi)
                    <div style="font-size:0.75rem;color:#6b7280;margin-top:3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">📍 {{ $a->lokasi }}</div>
                    @endif
                    @if($a->waktu)
                    <div style="font-size:0.75rem;color:#6b7280;margin-top:2px;">🕐 {{ $a->waktu }}</div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════
     GALERI KEGIATAN (dinamis)
══════════════════════════════════════════════ --}}
@if($galeris->count())
<section style="background:#f8fafc;padding:5rem 1.5rem;border-top:1px solid #f0f0f0;">
    <div style="max-width:72rem;margin:0 auto;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2.5rem;">
            <div>
                <div class="section-tag">Kegiatan</div>
                <h2 style="font-size:clamp(1.75rem,3.5vw,2.5rem);font-weight:900;color:#111827;line-height:1.1;letter-spacing:-0.02em;margin:0.25rem 0 0;">
                    Galeri Foto
                </h2>
            </div>
            <a href="{{ route('galeri.index') }}"
               style="display:inline-flex;align-items:center;gap:6px;background:#2d6a4f;color:#fff;font-weight:700;font-size:0.875rem;padding:10px 20px;border-radius:9999px;text-decoration:none;white-space:nowrap;transition:background 0.2s;"
               onmouseover="this.style.background='#40916c'" onmouseout="this.style.background='#2d6a4f'">
                Lihat Semua
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M7 7h10v10"/></svg>
            </a>
        </div>

        @php $gGrid = $galeris->take(5); @endphp
        <div class="galeri-grid">
            @foreach($gGrid as $idx => $g)
            <div class="galeri-item {{ $idx === 0 ? 'galeri-item-main' : '' }}"
                 onclick="window.location.href='{{ route('galeri.index') }}'" style="cursor:pointer;">
                <img src="{{ Storage::url($g->foto) }}" alt="{{ $g->judul }}" loading="lazy">
                @if($idx === 0 && $g->judul)
                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.4),transparent);display:flex;align-items:flex-end;padding:1.25rem;">
                    <span style="color:#fff;font-weight:700;font-size:0.9375rem;">{{ $g->judul }}</span>
                </div>
                @endif
                @if($g->kategori)
                <span style="position:absolute;top:10px;left:10px;background:rgba(0,0,0,0.55);color:#fff;font-size:0.6rem;font-weight:700;padding:2px 8px;border-radius:9999px;">{{ $g->kategori }}</span>
                @endif
            </div>
            @endforeach
            @for($i = $gGrid->count(); $i < 5; $i++)
            <div class="galeri-item {{ $i === 0 ? 'galeri-item-main' : '' }}"
                 style="background:linear-gradient(135deg,#1a3d2b,#2d6a4f);display:flex;align-items:center;justify-content:center;">
                <span style="font-size:2.5rem;">🖼️</span>
            </div>
            @endfor
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════
     VISI & MISI
══════════════════════════════════════════════ --}}
<section class="vm-section" style="padding:5.5rem 1.5rem;">
    <div style="position:relative;z-index:10;max-width:72rem;margin:0 auto;">

        <div style="text-align:center;margin-bottom:3.5rem;">
            <div style="font-size:0.7rem;font-weight:800;letter-spacing:0.14em;text-transform:uppercase;color:#74c69d;margin-bottom:1rem;">Arah & Tujuan</div>
            <h2 style="font-size:clamp(2rem,4vw,2.75rem);font-weight:900;color:#fff;margin:0;letter-spacing:-0.02em;">Visi & Misi Kelurahan</h2>
        </div>

        <div style="display:grid;gap:2rem;grid-template-columns:1fr;" class="vm-grid">
            <style>@media(min-width:768px){.vm-grid{grid-template-columns:1fr 1fr;align-items:start;}}</style>

            <div class="vm-visi-card">
                <div class="vm-quote-mark">"</div>
                <div style="font-size:0.7rem;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#74c69d;margin-bottom:1.25rem;position:relative;z-index:1;">Visi</div>
                <p style="font-size:1.1rem;font-weight:600;color:#fff;line-height:1.75;font-style:italic;position:relative;z-index:1;margin:0 0 1.5rem;padding-top:1rem;">
                    "Terwujudnya Kelurahan Mojo 2 yang sejahtera, berdaya saing, dan berbudaya menuju masyarakat yang mandiri dan berkualitas."
                </p>
                <div style="width:40px;height:3px;background:#74c69d;border-radius:9999px;position:relative;z-index:1;"></div>
            </div>

            <div>
                <div style="font-size:0.7rem;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#74c69d;margin-bottom:1.25rem;">Misi</div>
                @php
                $misiList = [
                    'Meningkatkan kualitas pelayanan publik yang prima dan transparan kepada seluruh warga.',
                    'Mendorong pemberdayaan ekonomi masyarakat melalui UMKM dan potensi lokal.',
                    'Memperkuat kerukunan dan gotong royong antar warga lintas RW.',
                    'Menjaga kelestarian lingkungan dan ruang terbuka hijau di wilayah kelurahan.',
                    'Meningkatkan kualitas pendidikan dan kesehatan warga secara merata.',
                ];
                @endphp
                @foreach($misiList as $i => $misi)
                <div class="misi-item-vm">
                    <div class="misi-num-vm">{{ $i + 1 }}</div>
                    <p style="color:rgba(255,255,255,0.8);font-size:0.9375rem;line-height:1.7;margin:3px 0 0;">{{ $misi }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     DIREKTORI RW
══════════════════════════════════════════════ --}}
<section id="rw-list" style="background:#f9fafb;padding:5rem 1.5rem;border-top:1px solid #f0f0f0;">
    <div style="max-width:72rem;margin:0 auto;">
        <div style="text-align:center;margin-bottom:2.5rem;">
            <div class="section-tag">Direktori</div>
            <h2 style="font-size:clamp(1.75rem,3vw,2.25rem);font-weight:900;color:#111827;letter-spacing:-0.02em;margin:0.5rem 0 0.5rem;">
                Profil Rukun Warga
            </h2>
            <p style="color:#9ca3af;font-size:0.875rem;margin:0;">Klik untuk melihat profil lengkap</p>
        </div>

        <div style="display:grid;gap:0.875rem;grid-template-columns:repeat(2,1fr);" class="rw-compact-grid">
            <style>@media(min-width:768px){ .rw-compact-grid{ grid-template-columns:repeat(5,1fr); } }</style>

            @foreach([9, 10, 11, 12, 13] as $rw)
            @php $profile = $rwProfiles->get($rw); $isRw10 = $rw === 10; @endphp
            <a href="{{ route('rw.profile', $rw) }}" class="rw-card-home" style="text-align:center;position:relative;">
                <div style="height:3px;background:{{ $isRw10 ? 'linear-gradient(90deg,#f59e0b,#d97706)' : 'linear-gradient(90deg,#2d6a4f,#40916c)' }};"></div>
                <div style="padding:1.5rem 1rem 1rem;">
                    <div style="width:3.25rem;height:3.25rem;border-radius:1rem;background:{{ $isRw10 ? '#fffbeb' : '#f0faf4' }};border:1.5px solid {{ $isRw10 ? '#fde68a' : '#d1fae5' }};display:flex;align-items:center;justify-content:center;font-size:1.375rem;font-weight:900;color:{{ $isRw10 ? '#d97706' : '#2d6a4f' }};margin:0 auto 0.875rem;">
                        {{ $rw }}
                    </div>
                    <div style="font-weight:800;font-size:1rem;color:#111827;margin-bottom:4px;">RW {{ $rw }}</div>
                    <div style="font-size:0.75rem;color:#9ca3af;margin-bottom:0.875rem;line-height:1.4;">
                        {{ $profile?->nama_ketua ? $profile->nama_ketua : 'Mojo 2' }}
                    </div>
                    @if($isRw10)
                    <span style="display:inline-block;font-size:0.65rem;font-weight:700;background:#fffbeb;color:#d97706;border:1px solid #fde68a;padding:2px 8px;border-radius:9999px;margin-bottom:0.75rem;">
                        ⭐ Unggulan
                    </span><br>
                    @endif
                    <span style="font-size:0.8125rem;font-weight:700;color:{{ $isRw10 ? '#d97706' : '#2d6a4f' }};">
                        Lihat Profil →
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
    const photo = document.getElementById('hero-photo');
    if (photo) setTimeout(() => photo.classList.add('loaded'), 100);

    // ── COUNTER ANIMASI ──
    (function () {
        const counters = document.querySelectorAll('.stat-counter');
        if (!counters.length) return;

        function animateCount(el) {
            const target = parseInt(el.dataset.target, 10);
            if (target === 0) { el.textContent = '0'; return; }
            const duration = 1200;
            const startTime = performance.now();
            function step(now) {
                const elapsed = now - startTime;
                const progress = Math.min(elapsed / duration, 1);
                // easeOutCubic
                const ease = 1 - Math.pow(1 - progress, 3);
                el.textContent = Math.round(ease * target);
                if (progress < 1) requestAnimationFrame(step);
                else el.textContent = target;
            }
            requestAnimationFrame(step);
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCount(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(c => observer.observe(c));
    })();
</script>
@endpush

@endsection

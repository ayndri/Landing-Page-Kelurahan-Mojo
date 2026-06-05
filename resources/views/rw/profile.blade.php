@extends('layouts.app')
@section('title', 'Profil RW '.$rw.' — Kelurahan Mojo 2')

@push('styles')
<style>
/* ── HERO ── */
.rw-hero {
    position: relative;
    overflow: hidden;
    background: linear-gradient(150deg, #0f2d1e 0%, #1a3d2b 40%, #2d6a4f 100%);
}
.rw-hero-orb1 {
    position: absolute;
    right: -100px; top: -100px;
    width: 500px; height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(245,158,11,0.12) 0%, transparent 70%);
    pointer-events: none;
}
.rw-hero-orb2 {
    position: absolute;
    left: -80px; bottom: -80px;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(27,67,50,0.6) 0%, transparent 70%);
    pointer-events: none;
}
.rw-hero-inner {
    position: relative;
    z-index: 10;
    max-width: 72rem;
    margin: 0 auto;
    padding: 4rem 1.5rem 6rem;
}

/* ── GRID LAYOUTS ── */
.profile-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}
@media (min-width: 1024px) {
    .profile-grid { grid-template-columns: 300px 1fr; }
}
.section-2col {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}
@media (min-width: 768px) {
    .section-2col { grid-template-columns: 1fr 1fr; }
}
.pengurus-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}
@media (min-width: 640px) {
    .pengurus-grid { grid-template-columns: 1fr 1fr; }
}
@media (min-width: 1024px) {
    .pengurus-grid { grid-template-columns: repeat(3, 1fr); }
}
.preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1.25rem;
}

/* ── CARDS ── */
.card {
    background: #fff;
    border-radius: 1.25rem;
    border: 1px solid #f0f0f0;
    box-shadow: 0 2px 16px rgba(0,0,0,0.05);
    overflow: hidden;
}
.card-header {
    padding: 1.125rem 1.5rem;
    border-bottom: 1px solid #f3f4f6;
    font-weight: 700;
    font-size: 0.875rem;
    color: #374151;
    display: flex;
    align-items: center;
    gap: 8px;
}
.card-body { padding: 1.5rem; }

.section-tag {
    font-size: 0.6875rem;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #b45309;
    background: #fffbeb;
    border: 1px solid #fde68a;
    padding: 5px 14px;
    border-radius: 9999px;
    display: inline-block;
    margin-bottom: 14px;
}

/* ── VISI BOX ── */
.visi-box {
    background: linear-gradient(135deg, #78350f, #92400e);
    border-radius: 1.5rem;
    padding: 2.5rem;
    position: relative;
    overflow: hidden;
}
.visi-box::before {
    content: '"';
    position: absolute;
    top: -1.5rem; left: 1.5rem;
    font-size: 10rem;
    color: rgba(245,158,11,0.15);
    font-family: Georgia, serif;
    line-height: 1;
    pointer-events: none;
}
.visi-box::after {
    content: '';
    position: absolute;
    right: -60px; bottom: -60px;
    width: 240px; height: 240px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(245,158,11,0.08) 0%, transparent 70%);
    pointer-events: none;
}

/* ── MISI ── */
.misi-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #fef3c7;
}
.misi-item:last-child { border-bottom: none; }
.misi-num {
    width: 32px; height: 32px;
    background: linear-gradient(135deg, #d97706, #f59e0b);
    color: #fff;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.8125rem;
    font-weight: 800;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(217,119,6,0.3);
}

/* ── PENGURUS ── */
.pengurus-card {
    background: #fff;
    border-radius: 1rem;
    border: 1px solid #f0f0f0;
    padding: 1.5rem;
    text-align: center;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    transition: transform 0.2s, box-shadow 0.2s;
}
.pengurus-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.09);
}
.pengurus-avatar {
    width: 4rem; height: 4rem;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem;
    margin: 0 auto 1rem;
}

/* ── STAT PILLS ── */
.stat-pill {
    background: rgba(245,158,11,0.15);
    border: 1px solid rgba(245,158,11,0.3);
    border-radius: 1rem;
    padding: 1rem 1.5rem;
    backdrop-filter: blur(8px);
    text-align: center;
    min-width: 110px;
}

/* ── INFO ROW ── */
.info-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f3f4f6;
}
.info-row:last-child { border-bottom: none; }

/* ── PREVIEW CARDS ── */
.preview-card {
    background: #fff;
    border-radius: 1.25rem;
    border: 1px solid #f0f0f0;
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
    display: block;
    text-decoration: none;
}
.preview-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.10);
}

.kegiatan-img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    display: block;
    border-radius: 1rem;
}
</style>
@endpush

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="rw-hero text-white">
    <div class="rw-hero-orb1"></div>
    <div class="rw-hero-orb2"></div>

    <div class="rw-hero-inner">
        {{-- Breadcrumb --}}
        <div style="font-size:0.8rem;color:rgba(209,250,229,0.65);margin-bottom:2.5rem;display:flex;align-items:center;gap:8px;">
            <a href="{{ route('home') }}" style="color:rgba(209,250,229,0.65);text-decoration:none;"
               onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(209,250,229,0.65)'">Beranda</a>
            <span style="opacity:0.4;">/</span>
            <span>RW {{ $rw }}</span>
        </div>

        <div style="display:flex;align-items:flex-start;gap:2rem;flex-wrap:wrap;">
            {{-- RW Badge --}}
            <div style="width:6rem;height:6rem;border-radius:1.5rem;background:rgba(245,158,11,0.2);border:2px solid rgba(245,158,11,0.4);display:flex;align-items:center;justify-content:center;flex-shrink:0;backdrop-filter:blur(6px);">
                <span style="font-size:2.5rem;font-weight:900;color:#fcd34d;">{{ $rw }}</span>
            </div>

            <div>
                <div style="font-size:0.7rem;font-weight:800;letter-spacing:0.14em;text-transform:uppercase;color:rgba(252,211,77,0.8);margin-bottom:6px;">
                    Rukun Warga · Kelurahan Mojo 2
                </div>
                <h1 style="font-size:clamp(2.5rem,6vw,4rem);font-weight:900;line-height:1;margin:0 0 10px;letter-spacing:-0.03em;">
                    RW <span style="color:#fcd34d;">{{ $rw }}</span>
                </h1>
                <p style="color:rgba(209,250,229,0.6);font-size:0.9375rem;margin:0;">
                    Kecamatan Gubeng &middot; Kota Surabaya
                </p>
                @if($profile && $profile->nama_ketua)
                <div style="display:inline-flex;align-items:center;gap:8px;margin-top:12px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:9999px;padding:6px 14px;font-size:0.8125rem;color:rgba(209,250,229,0.85);">
                    <span>🎖️</span>
                    <span>Ketua: <strong style="color:#fff;">{{ $profile->nama_ketua }}</strong></span>
                </div>
                @endif
            </div>

            {{-- Feature chips --}}
            <div style="margin-left:auto;display:flex;flex-direction:column;gap:8px;align-items:flex-end;">
                <a href="{{ route('tanaman.index') }}" style="display:flex;align-items:center;gap:6px;background:rgba(245,158,11,0.12);border:1px solid rgba(245,158,11,0.25);border-radius:9999px;padding:7px 16px;font-size:0.8rem;color:#fcd34d;font-weight:600;text-decoration:none;">🌿 Tanaman</a>
                <a href="{{ route('umkm.index') }}" style="display:flex;align-items:center;gap:6px;background:rgba(245,158,11,0.12);border:1px solid rgba(245,158,11,0.25);border-radius:9999px;padding:7px 16px;font-size:0.8rem;color:#fcd34d;font-weight:600;text-decoration:none;">🏪 UMKM</a>
                <a href="{{ route('rw.peta', $rw) }}" style="display:flex;align-items:center;gap:6px;background:rgba(245,158,11,0.12);border:1px solid rgba(245,158,11,0.25);border-radius:9999px;padding:7px 16px;font-size:0.8rem;color:#fcd34d;font-weight:600;text-decoration:none;">🗺️ Peta RW {{ $rw }}</a>
            </div>
        </div>

        {{-- Stats --}}
        @if($profile && ($profile->jumlah_kk || $profile->jumlah_penduduk || $profile->no_telepon))
        <div style="display:flex;flex-wrap:wrap;gap:1rem;margin-top:3rem;">
            @if($profile->jumlah_kk)
            <div class="stat-pill">
                <div style="font-size:1.75rem;font-weight:900;color:#fcd34d;line-height:1;">{{ number_format($profile->jumlah_kk) }}</div>
                <div style="font-size:0.7rem;color:rgba(209,250,229,0.65);margin-top:4px;font-weight:600;letter-spacing:0.05em;text-transform:uppercase;">Kepala Keluarga</div>
            </div>
            @endif
            @if($profile->jumlah_penduduk)
            <div class="stat-pill">
                <div style="font-size:1.75rem;font-weight:900;color:#fcd34d;line-height:1;">{{ number_format($profile->jumlah_penduduk) }}</div>
                <div style="font-size:0.7rem;color:rgba(209,250,229,0.65);margin-top:4px;font-weight:600;letter-spacing:0.05em;text-transform:uppercase;">Penduduk</div>
            </div>
            @endif
            @if($profile->no_telepon)
            <div class="stat-pill">
                <div style="font-size:1rem;font-weight:700;color:#fcd34d;line-height:1.4;">{{ $profile->no_telepon }}</div>
                <div style="font-size:0.7rem;color:rgba(209,250,229,0.65);margin-top:4px;font-weight:600;letter-spacing:0.05em;text-transform:uppercase;">Telepon</div>
            </div>
            @endif
        </div>
        @endif
    </div>

    {{-- Wave --}}
    <svg style="display:block;width:100%;margin-top:-1px;" viewBox="0 0 1440 72" preserveAspectRatio="none" fill="none">
        <path d="M0,40 C240,72 480,10 720,36 C960,62 1200,20 1440,40 L1440,72 L0,72 Z" fill="#f8fafc"/>
    </svg>
</section>

@if($profile)

{{-- ═══ TENTANG / PROFIL ═══ --}}
<section style="background:#f8fafc;padding:4rem 1.5rem;">
    <div style="max-width:72rem;margin:0 auto;">
        <div class="profile-grid">

            {{-- ── SIDEBAR ── --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;">

                {{-- Foto Ketua --}}
                @if($profile->foto_ketua)
                <div class="card" style="text-align:center;padding:2rem;">
                    <img src="{{ Storage::url($profile->foto_ketua) }}" alt="Ketua RW {{ $rw }}"
                         style="width:8rem;height:8rem;border-radius:50%;object-fit:cover;border:4px solid #f59e0b;margin:0 auto 1rem;display:block;">
                    <div style="font-weight:800;font-size:1.0625rem;color:#111827;">{{ $profile->nama_ketua ?? '-' }}</div>
                    <div style="font-size:0.8rem;color:#9ca3af;margin-top:4px;font-weight:500;">Ketua RW {{ $rw }}</div>
                </div>
                @else
                <div class="card" style="text-align:center;padding:2rem;">
                    <div style="width:8rem;height:8rem;border-radius:50%;background:linear-gradient(135deg,#fffbeb,#fef3c7);border:4px solid #f59e0b;margin:0 auto 1rem;display:flex;align-items:center;justify-content:center;font-size:2.5rem;">🎖️</div>
                    <div style="font-weight:800;font-size:1.0625rem;color:#111827;">{{ $profile->nama_ketua ?? '—' }}</div>
                    <div style="font-size:0.8rem;color:#9ca3af;margin-top:4px;font-weight:500;">Ketua RW {{ $rw }}</div>
                </div>
                @endif

                {{-- Info & Kontak --}}
                <div class="card">
                    <div class="card-header">
                        <svg style="width:1rem;height:1rem;color:#d97706;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Informasi
                    </div>
                    <div class="card-body" style="display:flex;flex-direction:column;gap:0;">
                        @if($profile->jumlah_kk)
                        <div class="info-row">
                            <span style="font-size:0.875rem;color:#6b7280;">Kepala Keluarga</span>
                            <span style="font-weight:800;font-size:1.0625rem;color:#d97706;">{{ number_format($profile->jumlah_kk) }}</span>
                        </div>
                        @endif
                        @if($profile->jumlah_penduduk)
                        <div class="info-row">
                            <span style="font-size:0.875rem;color:#6b7280;">Penduduk</span>
                            <span style="font-weight:800;font-size:1.0625rem;color:#d97706;">{{ number_format($profile->jumlah_penduduk) }}</span>
                        </div>
                        @endif
                        @if($profile->no_telepon)
                        <div class="info-row">
                            <span style="font-size:0.875rem;color:#6b7280;">Telepon</span>
                            <span style="font-size:0.875rem;font-weight:600;color:#374151;">{{ $profile->no_telepon }}</span>
                        </div>
                        @endif
                        @if($profile->alamat)
                        <div style="padding:0.75rem 0;">
                            <div style="font-size:0.8rem;color:#9ca3af;font-weight:500;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Alamat</div>
                            <div style="font-size:0.875rem;color:#374151;line-height:1.6;">{{ $profile->alamat }}</div>
                        </div>
                        @endif
                        @if(!$profile->jumlah_kk && !$profile->jumlah_penduduk && !$profile->no_telepon && !$profile->alamat)
                        <p style="font-size:0.875rem;color:#9ca3af;text-align:center;padding:0.5rem 0;">Belum ada informasi.</p>
                        @endif
                    </div>
                </div>

                {{-- QR Code --}}
                <div class="card" style="text-align:center;padding:1.5rem;">
                    <div style="font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9ca3af;margin-bottom:0.75rem;">QR Code Halaman Ini</div>
                    <div id="qr-rw" style="display:inline-block;padding:10px;background:#fff;border:2px solid #f0f0f0;border-radius:12px;line-height:0;">
                        {!! QrCode::size(140)->color(120, 53, 15)->backgroundColor(255, 255, 255)->generate(route('rw.profile', $rw)) !!}
                    </div>
                    <p style="font-size:0.7rem;color:#d1d5db;margin-top:0.75rem;margin-bottom:0.875rem;">Scan untuk buka profil RW {{ $rw }}</p>
                    <div style="display:flex;gap:0.5rem;">
                        <button onclick="downloadProfileQr()"
                                style="flex:1;display:flex;align-items:center;justify-content:center;gap:5px;background:#d97706;color:#fff;font-weight:700;font-size:0.75rem;padding:0.5rem 0.75rem;border-radius:0.625rem;border:none;cursor:pointer;transition:background 0.15s;"
                                onmouseover="this.style.background='#f59e0b'" onmouseout="this.style.background='#d97706'">
                            <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Download
                        </button>
                        <button onclick="shareProfileQr(this)"
                                style="flex:1;display:flex;align-items:center;justify-content:center;gap:5px;background:#fffbeb;color:#b45309;font-weight:700;font-size:0.75rem;padding:0.5rem 0.75rem;border-radius:0.625rem;border:1px solid #fde68a;cursor:pointer;transition:background 0.15s;"
                                onmouseover="this.style.background='#fef3c7'" onmouseout="this.style.background='#fffbeb'">
                            <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                            Bagikan
                        </button>
                    </div>
                </div>

                {{-- Pengurus singkat --}}
                <div class="card">
                    <div class="card-header">
                        <svg style="width:1rem;height:1rem;color:#d97706;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Struktur Pengurus
                    </div>
                    <div class="card-body" style="display:flex;flex-direction:column;gap:0.875rem;">
                        @foreach([
                            ['Ketua', $profile->nama_ketua, '🎖️', 'linear-gradient(135deg,#fffbeb,#fef3c7)', '#d97706'],
                            ['Sekretaris', $profile->sekretaris, '📋', 'linear-gradient(135deg,#eff6ff,#dbeafe)', '#2563eb'],
                            ['Bendahara', $profile->bendahara, '💼', 'linear-gradient(135deg,#f0fdf4,#dcfce7)', '#16a34a'],
                        ] as [$jabatan, $nama, $icon, $bg, $color])
                        <div style="display:flex;align-items:center;gap:0.875rem;padding:0.875rem;border-radius:0.875rem;background:#f9fafb;border:1px solid #f3f4f6;">
                            <div style="width:2.75rem;height:2.75rem;border-radius:50%;background:{{ $bg }};display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;">
                                {{ $icon }}
                            </div>
                            <div style="min-width:0;">
                                <div style="font-size:0.7rem;color:#9ca3af;font-weight:600;letter-spacing:0.04em;text-transform:uppercase;">{{ $jabatan }}</div>
                                <div style="font-weight:700;color:#111827;font-size:0.9rem;margin-top:1px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $nama ?? '—' }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- ── MAIN CONTENT ── --}}
            <div style="display:flex;flex-direction:column;gap:2rem;">

                {{-- Tentang --}}
                @if($profile->deskripsi)
                <div>
                    <span class="section-tag">Tentang RW {{ $rw }}</span>
                    <div class="card">
                        <div class="card-body">
                            <p style="color:#4b5563;line-height:1.9;font-size:0.9375rem;margin:0;white-space:pre-line;">{{ $profile->deskripsi }}</p>
                        </div>
                    </div>
                </div>
                @else
                <div>
                    <span class="section-tag">Tentang RW {{ $rw }}</span>
                    <div class="card">
                        <div class="card-body">
                            <p style="color:#4b5563;line-height:1.9;font-size:0.9375rem;margin:0;">
                                RW {{ $rw }} merupakan salah satu Rukun Warga di wilayah Kelurahan Mojo 2, Kecamatan Gubeng, Kota Surabaya.
                                Bersama warga yang aktif dan kompak, RW {{ $rw }} terus berupaya mewujudkan lingkungan yang bersih, aman, dan nyaman untuk semua.
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Visi --}}
                @if($profile->visi)
                <div>
                    <span class="section-tag">Visi</span>
                    <div class="visi-box">
                        <svg style="width:2rem;height:2rem;color:rgba(245,158,11,0.5);margin-bottom:1rem;position:relative;z-index:1;" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                        <p style="color:#fef3c7;font-size:1.125rem;font-weight:600;line-height:1.75;font-style:italic;position:relative;z-index:1;margin:0;">
                            {{ $profile->visi }}
                        </p>
                        <div style="height:1px;background:rgba(245,158,11,0.2);margin:1.5rem 0 0;position:relative;z-index:1;"></div>
                        <div style="font-size:0.75rem;color:rgba(252,211,77,0.6);font-weight:600;letter-spacing:0.08em;text-transform:uppercase;margin-top:0.875rem;position:relative;z-index:1;">
                            Visi RW {{ $rw }} · Kelurahan Mojo 2
                        </div>
                    </div>
                </div>
                @endif

                {{-- Misi --}}
                @if($profile->misi)
                @php $misiItems = array_filter(array_map('trim', explode("\n", $profile->misi))); @endphp
                @if(count($misiItems))
                <div>
                    <span class="section-tag">Misi</span>
                    <div class="card">
                        <div class="card-body" style="padding-top:1rem;padding-bottom:1rem;">
                            @foreach($misiItems as $i => $item)
                            <div class="misi-item">
                                <div class="misi-num">{{ $i + 1 }}</div>
                                <p style="color:#374151;font-size:0.9375rem;line-height:1.7;margin:2px 0 0;">{{ ltrim($item, '-. ') }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @endif

                {{-- Agenda mendatang per-RW --}}
                @if($agendas->count())
                <div>
                    <span class="section-tag">Agenda Mendatang</span>
                    <div style="display:flex;flex-direction:column;gap:0.75rem;">
                        @foreach($agendas as $a)
                        @php
                            $agColors = ['Kesehatan'=>'#dc2626','Sosial'=>'#2563eb','Rapat'=>'#d97706','Olahraga'=>'#16a34a','Pendidikan'=>'#7c3aed','Lainnya'=>'#6b7280'];
                            $agColor  = $agColors[$a->kategori] ?? '#6b7280';
                        @endphp
                        <div style="display:flex;align-items:stretch;background:#fff;border-radius:0.875rem;overflow:hidden;border:1px solid #f0f0f0;box-shadow:0 1px 6px rgba(0,0,0,0.04);">
                            <div style="background:{{ $agColor }};color:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:0.875rem;min-width:56px;flex-shrink:0;">
                                <span style="font-size:1.375rem;font-weight:900;line-height:1;">{{ $a->tanggal->format('d') }}</span>
                                <span style="font-size:0.6rem;font-weight:700;text-transform:uppercase;opacity:0.85;">{{ $a->tanggal->format('M') }}</span>
                            </div>
                            <div style="padding:0.75rem 1rem;flex:1;min-width:0;">
                                <div style="font-weight:700;font-size:0.875rem;color:#111827;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $a->judul }}</div>
                                <div style="display:flex;flex-wrap:wrap;gap:8px;margin-top:3px;">
                                    @if($a->waktu)<span style="font-size:0.75rem;color:#6b7280;">🕐 {{ $a->waktu }}</span>@endif
                                    @if($a->lokasi)<span style="font-size:0.75rem;color:#6b7280;">📍 {{ $a->lokasi }}</span>@endif
                                    @if(!$a->rw_number)<span style="font-size:0.65rem;font-weight:700;background:#fffbeb;color:#b45309;padding:1px 7px;border-radius:9999px;">Kelurahan</span>@endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('agenda.index') }}" style="display:inline-flex;align-items:center;gap:4px;margin-top:0.875rem;font-size:0.8125rem;font-weight:600;color:#b45309;text-decoration:none;"
                       onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                        Lihat semua agenda →
                    </a>
                </div>
                @endif

                {{-- Foto Kegiatan --}}
                @if($profile->foto_kegiatan)
                <div>
                    <span class="section-tag">Kegiatan</span>
                    <div style="position:relative;border-radius:1.25rem;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.12);">
                        <img src="{{ Storage::url($profile->foto_kegiatan) }}" alt="Kegiatan RW {{ $rw }}"
                             class="kegiatan-img"
                             onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                        <div style="display:none;width:100%;height:260px;background:linear-gradient(135deg,#78350f,#92400e);align-items:center;justify-content:center;font-size:3rem;border-radius:1.25rem;">🏘️</div>
                        <div style="position:absolute;bottom:0;left:0;right:0;padding:1.5rem 2rem;background:linear-gradient(to top,rgba(10,30,18,0.8),transparent);">
                            <span style="color:#fff;font-size:0.9375rem;font-weight:700;">Dokumentasi Kegiatan RW {{ $rw }}</span>
                            <p style="color:rgba(252,211,77,0.7);font-size:0.8125rem;margin:2px 0 0;">Kelurahan Mojo 2 · Kota Surabaya</p>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

{{-- ═══ PENGURUS LENGKAP ═══ --}}
<section style="background:#fff;padding:4rem 1.5rem;">
    <div style="max-width:72rem;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3rem;">
            <span class="section-tag">Kepengurusan</span>
            <h2 style="font-size:clamp(1.75rem,3.5vw,2.375rem);font-weight:900;color:#111827;letter-spacing:-0.02em;margin:0.5rem 0 0.875rem;line-height:1.2;">
                Pengurus RW {{ $rw }}
            </h2>
            <p style="color:#6b7280;font-size:0.9375rem;max-width:32rem;margin:0 auto;line-height:1.7;">
                Struktur kepengurusan yang aktif melayani warga RW {{ $rw }}.
            </p>
        </div>

        <div class="pengurus-grid">
            @foreach([
                ['Ketua RW', $profile->nama_ketua, '🎖️', 'linear-gradient(135deg,#fffbeb,#fde68a)', '#d97706'],
                ['Sekretaris', $profile->sekretaris, '📋', 'linear-gradient(135deg,#eff6ff,#bfdbfe)', '#1d4ed8'],
                ['Bendahara', $profile->bendahara, '💼', 'linear-gradient(135deg,#f0fdf4,#bbf7d0)', '#15803d'],
            ] as [$jabatan, $nama, $icon, $bg, $color])
            <div class="pengurus-card">
                <div class="pengurus-avatar" style="background:{{ $bg }};border:2px solid {{ $color }}20;">{{ $icon }}</div>
                <div style="font-size:0.7rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:{{ $color }};margin-bottom:6px;">{{ $jabatan }}</div>
                <div style="font-weight:800;font-size:1rem;color:#111827;">{{ $nama ?? '—' }}</div>
                @if($nama)
                <div style="font-size:0.8rem;color:#9ca3af;margin-top:4px;">RW {{ $rw }} · Mojo 2</div>
                @else
                <div style="font-size:0.8rem;color:#d1d5db;margin-top:4px;font-style:italic;">Belum diisi</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

@endif

{{-- ═══ POTENSI WILAYAH ═══ --}}
<section style="background:#f8fafc;padding:4rem 1.5rem;">
    <div style="max-width:72rem;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3rem;">
            <span class="section-tag">Potensi</span>
            <h2 style="font-size:clamp(1.75rem,3.5vw,2.375rem);font-weight:900;color:#111827;letter-spacing:-0.02em;margin:0.5rem 0 0.875rem;line-height:1.2;">
                Potensi Wilayah RW {{ $rw }}
            </h2>
            <p style="color:#6b7280;font-size:0.9375rem;max-width:34rem;margin:0 auto;line-height:1.7;">
                Keunggulan dan potensi yang dimiliki warga RW {{ $rw }} dalam mendukung kemajuan kelurahan.
            </p>
        </div>

        <div class="section-2col">
            <a href="{{ route('tanaman.index') }}" class="card" style="padding:2rem;display:flex;gap:1.25rem;align-items:flex-start;text-decoration:none;transition:transform 0.2s,box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,0.10)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div style="width:3rem;height:3rem;border-radius:0.875rem;background:linear-gradient(135deg,#f0fdf4,#dcfce7);display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;">🌿</div>
                <div>
                    <div style="font-weight:800;font-size:1rem;color:#111827;margin-bottom:6px;">Tanaman & TOGA</div>
                    <p style="font-size:0.875rem;color:#6b7280;line-height:1.7;margin:0 0 10px;">Tanaman obat keluarga dan tanaman hias warga RW {{ $rw }} terdata dengan QR Code dan titik lokasi pada peta interaktif.</p>
                    <span style="font-size:0.8rem;font-weight:700;color:#16a34a;">Jelajahi Tanaman →</span>
                </div>
            </a>
            <a href="{{ route('umkm.index') }}" class="card" style="padding:2rem;display:flex;gap:1.25rem;align-items:flex-start;text-decoration:none;transition:transform 0.2s,box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,0.10)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div style="width:3rem;height:3rem;border-radius:0.875rem;background:linear-gradient(135deg,#fffbeb,#fef3c7);display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;">🏪</div>
                <div>
                    <div style="font-weight:800;font-size:1rem;color:#111827;margin-bottom:6px;">UMKM Warga</div>
                    <p style="font-size:0.875rem;color:#6b7280;line-height:1.7;margin:0 0 10px;">Usaha mikro kecil menengah warga RW {{ $rw }} — kuliner, fashion, kerajinan, dan jasa yang terus berkembang.</p>
                    <span style="font-size:0.8rem;font-weight:700;color:#d97706;">Jelajahi UMKM →</span>
                </div>
            </a>
            <a href="{{ route('rw.peta', $rw) }}" class="card" style="padding:2rem;display:flex;gap:1.25rem;align-items:flex-start;text-decoration:none;transition:transform 0.2s,box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,0.10)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div style="width:3rem;height:3rem;border-radius:0.875rem;background:linear-gradient(135deg,#eff6ff,#dbeafe);display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;">🗺️</div>
                <div>
                    <div style="font-weight:800;font-size:1rem;color:#111827;margin-bottom:6px;">Peta RW {{ $rw }}</div>
                    <p style="font-size:0.875rem;color:#6b7280;line-height:1.7;margin:0 0 10px;">Visualisasi sebaran tanaman dan UMKM warga RW {{ $rw }} pada peta OpenStreetMap berbasis Leaflet.</p>
                    <span style="font-size:0.8rem;font-weight:700;color:#2563eb;">Buka Peta RW {{ $rw }} →</span>
                </div>
            </a>
            <div class="card" style="padding:2rem;display:flex;gap:1.25rem;align-items:flex-start;">
                <div style="width:3rem;height:3rem;border-radius:0.875rem;background:linear-gradient(135deg,#fdf4ff,#fae8ff);display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;">🤝</div>
                <div>
                    <div style="font-weight:800;font-size:1rem;color:#111827;margin-bottom:6px;">Gotong Royong</div>
                    <p style="font-size:0.875rem;color:#6b7280;line-height:1.7;margin:0;">Semangat kebersamaan warga RW {{ $rw }} tercermin dalam kegiatan sosial, kebersihan, dan pos ronda aktif.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ PREVIEW TANAMAN RW ═══ --}}
<section style="background:#fff;padding:4rem 1.5rem;">
    <div style="max-width:72rem;margin:0 auto;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2.5rem;flex-wrap:wrap;gap:1rem;">
            <div>
                <span class="section-tag">Flora & TOGA</span>
                <h2 style="font-size:clamp(1.5rem,3vw,2rem);font-weight:900;color:#111827;margin:0.5rem 0 0;line-height:1.2;">Tanaman RW {{ $rw }}</h2>
            </div>
            <a href="{{ route('tanaman.index') }}"
               style="font-size:0.875rem;font-weight:700;color:#16a34a;text-decoration:none;display:flex;align-items:center;gap:6px;padding:10px 20px;border:1.5px solid #d1fae5;border-radius:9999px;background:#f0fdf4;">
                Lihat Semua →
            </a>
        </div>
        @if($plants->count())
        <div class="preview-grid">
            @foreach($plants as $plant)
            <a href="{{ route('tanaman.show', $plant) }}" class="preview-card">
                @if($plant->foto)
                    <img src="{{ Storage::url($plant->foto) }}" alt="{{ $plant->nama }}"
                         style="width:100%;height:160px;object-fit:cover;display:block;">
                @else
                    <div style="width:100%;height:160px;background:linear-gradient(135deg,#1b4332,#2d6a4f);display:flex;align-items:center;justify-content:center;font-size:3rem;">🌿</div>
                @endif
                <div style="padding:1rem;">
                    <div style="font-weight:700;color:#111827;font-size:0.9375rem;">{{ $plant->nama }}</div>
                    @if($plant->nama_latin)
                    <div style="font-size:0.75rem;color:#9ca3af;font-style:italic;margin-top:2px;">{{ $plant->nama_latin }}</div>
                    @endif
                    @if($plant->jenis)
                    <span style="display:inline-block;font-size:0.7rem;font-weight:600;background:#f0faf4;color:#2d6a4f;border:1px solid #d1fae5;padding:3px 8px;border-radius:9999px;margin-top:8px;">{{ $plant->jenis }}</span>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div style="text-align:center;padding:3rem 1rem;background:#f8fafc;border:1px dashed #e5e7eb;border-radius:1.25rem;">
            <div style="font-size:2.5rem;margin-bottom:0.75rem;">🌱</div>
            <h3 style="font-size:1.0625rem;font-weight:800;color:#374151;margin:0 0 6px;">Belum ada tanaman RW {{ $rw }}</h3>
            <p style="color:#9ca3af;font-size:0.875rem;margin:0;">Data tanaman warga RW {{ $rw }} belum ditambahkan oleh pengurus.</p>
        </div>
        @endif
    </div>
</section>

{{-- ═══ PREVIEW UMKM RW ═══ --}}
<section style="background:#f8fafc;padding:4rem 1.5rem;">
    <div style="max-width:72rem;margin:0 auto;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2.5rem;flex-wrap:wrap;gap:1rem;">
            <div>
                <span class="section-tag">Ekonomi Lokal</span>
                <h2 style="font-size:clamp(1.5rem,3vw,2rem);font-weight:900;color:#111827;margin:0.5rem 0 0;line-height:1.2;">UMKM RW {{ $rw }}</h2>
            </div>
            <a href="{{ route('umkm.index') }}"
               style="font-size:0.875rem;font-weight:700;color:#d97706;text-decoration:none;display:flex;align-items:center;gap:6px;padding:10px 20px;border:1.5px solid #fde68a;border-radius:9999px;background:#fffbeb;">
                Lihat Semua →
            </a>
        </div>
        @if($umkm->count())
        <div class="preview-grid">
            @foreach($umkm as $u)
            <a href="{{ route('umkm.show', $u) }}" class="preview-card">
                @if($u->foto)
                    <img src="{{ Storage::url($u->foto) }}" alt="{{ $u->nama_usaha }}"
                         style="width:100%;height:160px;object-fit:cover;display:block;">
                @else
                    <div style="width:100%;height:160px;background:linear-gradient(135deg,#78350f,#b45309);display:flex;align-items:center;justify-content:center;font-size:3rem;">🏪</div>
                @endif
                <div style="padding:1rem;">
                    <div style="font-weight:700;color:#111827;font-size:0.9375rem;">{{ $u->nama_usaha }}</div>
                    @if($u->nama_pemilik)
                    <div style="font-size:0.75rem;color:#9ca3af;margin-top:2px;">oleh {{ $u->nama_pemilik }}</div>
                    @endif
                    @if($u->jenis_usaha)
                    <span style="display:inline-block;font-size:0.7rem;font-weight:600;background:#fffbeb;color:#d97706;border:1px solid #fde68a;padding:3px 8px;border-radius:9999px;margin-top:8px;">{{ $u->jenis_usaha }}</span>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div style="text-align:center;padding:3rem 1rem;background:#fff;border:1px dashed #e5e7eb;border-radius:1.25rem;">
            <div style="font-size:2.5rem;margin-bottom:0.75rem;">🏪</div>
            <h3 style="font-size:1.0625rem;font-weight:800;color:#374151;margin:0 0 6px;">Belum ada UMKM RW {{ $rw }}</h3>
            <p style="color:#9ca3af;font-size:0.875rem;margin:0;">Data UMKM warga RW {{ $rw }} belum ditambahkan oleh pengurus.</p>
        </div>
        @endif
    </div>
</section>

@if(!$profile)
{{-- ═══ EMPTY PROFILE NOTICE ═══ --}}
<section style="background:#fff;padding:4rem 1.5rem;">
    <div style="max-width:28rem;margin:0 auto;text-align:center;">
        <div style="width:6rem;height:6rem;border-radius:2rem;background:#fffbeb;border:2px dashed #f59e0b;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;font-size:2.5rem;color:#d97706;font-weight:900;">{{ $rw }}</div>
        <h3 style="font-size:1.5rem;font-weight:900;color:#111827;margin:0 0 10px;">Profil Belum Tersedia</h3>
        <p style="color:#9ca3af;font-size:0.9375rem;line-height:1.75;margin:0;">
            Admin RW {{ $rw }} belum mengisi profil. Bagian tanaman, UMKM, dan peta di atas akan terisi seiring data ditambahkan.
        </p>
    </div>
</section>
@endif

{{-- ═══ CTA / BOTTOM ═══ --}}
<section style="background:linear-gradient(150deg,#0f2d1e 0%,#1a3d2b 50%,#2d6a4f 100%);padding:5rem 1.5rem;text-align:center;">
    <div style="max-width:36rem;margin:0 auto;">
        <div style="width:4rem;height:4rem;border-radius:1rem;background:rgba(245,158,11,0.15);border:1px solid rgba(245,158,11,0.3);display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;font-size:1.75rem;">🏘️</div>
        <h3 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:900;color:#fff;letter-spacing:-0.02em;margin:0 0 1rem;line-height:1.2;">
            Bagian dari Kelurahan Mojo 2
        </h3>
        <p style="color:rgba(209,250,229,0.65);font-size:0.9375rem;line-height:1.75;margin:0 0 2rem;">
            RW {{ $rw }} adalah bagian tak terpisahkan dari Kelurahan Mojo 2 yang terus berkembang bersama warganya.
        </p>
        <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;">
            <a href="{{ route('home') }}"
               style="display:inline-flex;align-items:center;gap:8px;background:#2d6a4f;color:#fff;font-weight:700;padding:12px 24px;border-radius:9999px;font-size:0.875rem;text-decoration:none;border:1px solid #40916c;transition:background 0.2s;"
               onmouseover="this.style.background='#40916c'" onmouseout="this.style.background='#2d6a4f'">
                ← Kembali ke Beranda
            </a>
            <a href="{{ route('home') }}#rw-list"
               style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.1);color:rgba(209,250,229,0.85);font-weight:600;padding:12px 24px;border-radius:9999px;font-size:0.875rem;text-decoration:none;border:1px solid rgba(255,255,255,0.15);">
                Lihat RW Lainnya →
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
    const _pQrUrl = '{{ route('rw.profile', $rw) }}';
    const _pQrRw  = {{ $rw }};

    function downloadProfileQr() {
        const svg = document.querySelector('#qr-rw svg');
        if (!svg) return;
        const S = 220, LH = 56;
        const out = document.createElement('canvas');
        out.width = S; out.height = S + LH;
        const ctx = out.getContext('2d');
        const svgData = new XMLSerializer().serializeToString(svg);
        const blob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
        const url = URL.createObjectURL(blob);
        const img = new Image();
        img.onload = function () {
            ctx.fillStyle = '#fff';
            ctx.fillRect(0, 0, S, S + LH);
            ctx.drawImage(img, 0, 0, S, S);
            ctx.fillStyle = '#78350f';
            ctx.fillRect(0, S, S, LH);
            ctx.textAlign = 'center';
            ctx.fillStyle = '#fff';
            ctx.font = 'bold 14px Arial';
            ctx.fillText('RW ' + _pQrRw + ' — Kelurahan Mojo 2', S / 2, S + 23);
            ctx.font = '11px Arial';
            ctx.fillStyle = 'rgba(255,255,255,0.6)';
            ctx.fillText('Kota Surabaya', S / 2, S + 41);
            const a = document.createElement('a');
            a.download = 'QR-RW-' + _pQrRw + '-Mojo2.png';
            a.href = out.toDataURL('image/png');
            a.click();
            URL.revokeObjectURL(url);
        };
        img.src = url;
    }

    function shareProfileQr(btn) {
        if (navigator.share) {
            navigator.share({
                title: 'Profil RW ' + _pQrRw + ' — Kelurahan Mojo 2',
                text: 'Lihat profil RW ' + _pQrRw + ' Kelurahan Mojo 2, Kota Surabaya.',
                url: _pQrUrl,
            }).catch(() => {});
        } else {
            navigator.clipboard.writeText(_pQrUrl).then(() => {
                const orig = btn.innerHTML;
                btn.textContent = '✓ Link disalin!';
                setTimeout(() => { btn.innerHTML = orig; }, 2000);
            });
        }
    }
</script>
@endpush

@endsection

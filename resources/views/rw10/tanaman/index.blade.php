@extends('layouts.app')
@section('title', 'Tanaman RW 10 — Kelurahan Mojo 2')

@push('styles')
<style>
/* ── HERO ── */
.tanaman-hero {
    position: relative;
    overflow: hidden;
    background: linear-gradient(150deg, #0f2d1e 0%, #1a3d2b 45%, #2d6a4f 100%);
}
.tanaman-hero-inner {
    position: relative;
    z-index: 10;
    max-width: 72rem;
    margin: 0 auto;
    padding: 4rem 1.5rem 5rem;
}
.tanaman-hero-orb {
    position: absolute;
    right: -80px; top: -80px;
    width: 480px; height: 480px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(116,198,157,0.12) 0%, transparent 70%);
    pointer-events: none;
}

/* ── SEARCH ── */
.search-wrap {
    display: flex;
    gap: 10px;
    max-width: 36rem;
}
.search-input {
    flex: 1;
    background: rgba(255,255,255,0.1);
    border: 1.5px solid rgba(255,255,255,0.2);
    border-radius: 9999px;
    padding: 12px 20px;
    font-size: 0.9rem;
    color: #fff;
    outline: none;
    backdrop-filter: blur(8px);
    transition: border-color 0.2s, background 0.2s;
}
.search-input::placeholder { color: rgba(255,255,255,0.45); }
.search-input:focus {
    border-color: rgba(116,198,157,0.7);
    background: rgba(255,255,255,0.15);
}
.search-btn {
    background: #2d6a4f;
    color: #fff;
    font-weight: 700;
    font-size: 0.875rem;
    padding: 12px 24px;
    border-radius: 9999px;
    border: none;
    cursor: pointer;
    transition: background 0.2s;
    flex-shrink: 0;
}
.search-btn:hover { background: #40916c; }

/* ── FILTER BAR ── */
.filter-bar {
    background: #fff;
    border-bottom: 1px solid #f0f0f0;
    position: sticky;
    top: 64px;
    z-index: 40;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}
.filter-bar-inner {
    max-width: 72rem;
    margin: 0 auto;
    padding: 0.875rem 1.5rem;
    display: flex;
    gap: 8px;
    overflow-x: auto;
    scrollbar-width: none;
}
.filter-bar-inner::-webkit-scrollbar { display: none; }
.filter-chip {
    white-space: nowrap;
    font-size: 0.8125rem;
    font-weight: 600;
    padding: 7px 16px;
    border-radius: 9999px;
    border: 1.5px solid #e5e7eb;
    color: #6b7280;
    background: transparent;
    cursor: pointer;
    transition: all 0.15s;
    flex-shrink: 0;
}
.filter-chip:hover { border-color: #2d6a4f; color: #2d6a4f; }
.filter-chip.active {
    background: #2d6a4f;
    border-color: #2d6a4f;
    color: #fff;
}

/* ── PLANT GRID ── */
.plant-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.25rem;
}
@media (min-width: 640px) {
    .plant-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (min-width: 1024px) {
    .plant-grid { grid-template-columns: repeat(4, 1fr); }
}

/* ── PLANT CARD ── */
.plant-card {
    background: #fff;
    border-radius: 1.25rem;
    border: 1px solid #f0f0f0;
    overflow: hidden;
    text-decoration: none;
    display: block;
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}
.plant-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.12);
}
.plant-card-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
}
.plant-card:hover .plant-card-img { transform: scale(1.05); }
.plant-card-img-wrap {
    overflow: hidden;
    position: relative;
    height: 180px;
}
.plant-card-body {
    padding: 1rem 1.125rem 1.25rem;
}
.plant-badge {
    display: inline-block;
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    padding: 3px 9px;
    border-radius: 9999px;
    background: #f0faf4;
    color: #2d6a4f;
    border: 1px solid #d1fae5;
    margin-bottom: 8px;
}
.plant-name {
    font-weight: 800;
    font-size: 1rem;
    color: #111827;
    line-height: 1.3;
    margin: 0 0 3px;
}
.plant-latin {
    font-size: 0.75rem;
    color: #9ca3af;
    font-style: italic;
    margin: 0 0 8px;
}
.plant-desc {
    font-size: 0.8125rem;
    color: #6b7280;
    line-height: 1.6;
    margin: 0 0 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.plant-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 10px;
    border-top: 1px solid #f3f4f6;
}
.plant-link {
    font-size: 0.8rem;
    font-weight: 700;
    color: #2d6a4f;
    display: flex;
    align-items: center;
    gap: 4px;
}
.plant-icon-btn {
    width: 2rem; height: 2rem;
    border-radius: 50%;
    background: #f0faf4;
    display: flex; align-items: center; justify-content: center;
    transition: background 0.2s;
    flex-shrink: 0;
}
.plant-card:hover .plant-icon-btn {
    background: #2d6a4f;
}
.plant-card:hover .plant-icon-btn svg {
    color: #fff;
}

/* ── MAP BADGE ── */
.map-badge {
    position: absolute;
    top: 10px; right: 10px;
    background: rgba(37,99,235,0.9);
    color: #fff;
    font-size: 0.65rem;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 9999px;
    display: flex;
    align-items: center;
    gap: 3px;
    backdrop-filter: blur(4px);
}
</style>
@endpush

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="tanaman-hero text-white">
    <div class="tanaman-hero-orb"></div>
    <div class="tanaman-hero-inner">

        {{-- Breadcrumb --}}
        <div style="font-size:0.8rem;color:rgba(209,250,229,0.6);margin-bottom:2rem;display:flex;align-items:center;gap:8px;">
            <a href="{{ route('home') }}" style="color:rgba(209,250,229,0.6);text-decoration:none;"
               onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(209,250,229,0.6)'">Beranda</a>
            <span style="opacity:0.4;">/</span>
            <span>Tanaman</span>
        </div>

        <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:2rem;">
            <div style="flex:1;min-width:280px;">
                <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.18);border-radius:9999px;padding:5px 14px;margin-bottom:1.25rem;font-size:0.75rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(209,250,229,0.85);">
                    🌿 Flora &amp; Toga
                </div>
                <h1 style="font-size:clamp(2.25rem,5vw,3.5rem);font-weight:900;line-height:1.05;letter-spacing:-0.03em;margin:0 0 1rem;">
                    Tanaman Warga<br>
                    <span style="color:#74c69d;">Kelurahan Mojo 2</span>
                </h1>
                <p style="color:rgba(209,250,229,0.65);font-size:0.9375rem;line-height:1.75;max-width:34rem;margin:0 0 2rem;">
                    Direktori lengkap tanaman obat keluarga dan tanaman hias warga Kelurahan Mojo 2,
                    dilengkapi QR Code dan lokasi peta interaktif.
                </p>

                {{-- Search --}}
                <div class="search-wrap" style="margin-bottom:1.5rem;">
                    <input id="search-input" type="text" class="search-input"
                           placeholder="Cari nama, jenis, atau manfaat...">
                    <button class="search-btn" onclick="doSearch()">Cari</button>
                </div>

                {{-- Action buttons --}}
                <div style="display:flex;flex-wrap:wrap;gap:10px;">
                    <button onclick="openQrScanner()"
                        style="display:flex;align-items:center;gap:8px;background:#fff;color:#2d6a4f;font-weight:700;font-size:0.875rem;padding:11px 20px;border-radius:9999px;border:none;cursor:pointer;box-shadow:0 2px 12px rgba(0,0,0,0.15);">
                        <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                        Scan QR Code
                    </button>
                    <a href="{{ route('peta') }}"
                        style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.12);color:#fff;font-weight:600;font-size:0.875rem;padding:11px 20px;border-radius:9999px;border:1px solid rgba(255,255,255,0.2);text-decoration:none;backdrop-filter:blur(8px);">
                        🗺️ Peta Flora
                    </a>
                </div>
            </div>

            {{-- Stats box --}}
            <div style="display:flex;flex-direction:column;gap:12px;flex-shrink:0;">
                <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:1.25rem;padding:1.5rem 2rem;text-align:center;backdrop-filter:blur(8px);">
                    <div style="font-size:3rem;font-weight:900;color:#74c69d;line-height:1;">{{ $plants->count() }}</div>
                    <div style="font-size:0.75rem;color:rgba(209,250,229,0.6);font-weight:600;letter-spacing:0.08em;text-transform:uppercase;margin-top:6px;">Jenis Tanaman</div>
                </div>
                @php $jenisCount = $plants->pluck('jenis')->filter()->unique()->count(); @endphp
                @if($jenisCount > 0)
                <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:1.25rem;padding:1.25rem 2rem;text-align:center;backdrop-filter:blur(8px);">
                    <div style="font-size:2rem;font-weight:900;color:#74c69d;line-height:1;">{{ $jenisCount }}</div>
                    <div style="font-size:0.75rem;color:rgba(209,250,229,0.6);font-weight:600;letter-spacing:0.08em;text-transform:uppercase;margin-top:6px;">Kategori</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Wave --}}
    <svg style="display:block;width:100%;margin-top:-1px;" viewBox="0 0 1440 60" preserveAspectRatio="none" fill="none">
        <path d="M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z" fill="#f8fafc"/>
    </svg>
</section>

{{-- ═══ FILTER BAR ═══ --}}
@php $jenis = $plants->pluck('jenis')->filter()->unique()->sort()->values(); @endphp
@if($jenis->count())
<div class="filter-bar">
    <div class="filter-bar-inner">
        <button class="filter-chip active" data-filter="semua" onclick="filterJenis('semua')">
            Semua <span style="opacity:0.65;">({{ $plants->count() }})</span>
        </button>
        @foreach($jenis as $j)
        <button class="filter-chip" data-filter="{{ $j }}" onclick="filterJenis('{{ $j }}')">
            {{ $j }} <span style="opacity:0.65;">({{ $plants->where('jenis', $j)->count() }})</span>
        </button>
        @endforeach
    </div>
</div>
@endif

{{-- ═══ GRID ═══ --}}
<div style="background:#f8fafc;min-height:60vh;padding:2.5rem 1.5rem 5rem;">
    <div style="max-width:72rem;margin:0 auto;">

        {{-- No result --}}
        <div id="no-result" style="display:none;text-align:center;padding:6rem 0;">
            <div style="font-size:3.5rem;margin-bottom:1rem;">🔍</div>
            <h3 style="font-weight:800;font-size:1.25rem;color:#374151;margin:0 0 8px;">Tidak ditemukan</h3>
            <p style="color:#9ca3af;font-size:0.9rem;">Coba kata kunci lain atau hapus filter.</p>
            <button onclick="showAll()" style="margin-top:1.5rem;background:#2d6a4f;color:#fff;font-weight:700;font-size:0.875rem;padding:10px 22px;border-radius:9999px;border:none;cursor:pointer;">Lihat Semua</button>
        </div>

        <div id="plant-grid" class="plant-grid">
            @forelse($plants as $plant)
            <a href="{{ route('tanaman.show', $plant) }}"
               class="plant-card"
               data-nama="{{ strtolower($plant->nama) }}"
               data-latin="{{ strtolower($plant->nama_latin ?? '') }}"
               data-jenis="{{ $plant->jenis }}"
               data-manfaat="{{ strtolower($plant->manfaat ?? '') }}">

                {{-- Image --}}
                <div class="plant-card-img-wrap">
                    @if($plant->foto)
                        <img src="{{ Storage::url($plant->foto) }}" alt="{{ $plant->nama }}" class="plant-card-img">
                    @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#1b4332 0%,#2d6a4f 50%,#40916c 100%);display:flex;align-items:center;justify-content:center;font-size:3.5rem;">🌿</div>
                    @endif

                    @if($plant->created_at->gt(now()->subDays(7)))
                    <div style="position:absolute;top:10px;left:10px;background:#f59e0b;color:#fff;font-size:0.6rem;font-weight:800;letter-spacing:0.06em;text-transform:uppercase;padding:3px 9px;border-radius:9999px;box-shadow:0 2px 6px rgba(245,158,11,0.4);">✨ Baru</div>
                    @endif
                    @if($plant->latitude && $plant->longitude)
                    <div class="map-badge">
                        <svg style="width:0.65rem;height:0.65rem;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                        Peta
                    </div>
                    @endif
                </div>

                {{-- Body --}}
                <div class="plant-card-body">
                    @if($plant->jenis)
                    <div class="plant-badge">{{ $plant->jenis }}</div>
                    @endif
                    <h3 class="plant-name">{{ $plant->nama }}</h3>
                    @if($plant->nama_latin)
                    <p class="plant-latin">{{ $plant->nama_latin }}</p>
                    @endif
                    @if($plant->deskripsi)
                    <p class="plant-desc">{{ $plant->deskripsi }}</p>
                    @endif

                    <div class="plant-footer">
                        <span class="plant-link">
                            Detail &amp; QR
                            <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M7 7h10v10"/></svg>
                        </span>
                        <div class="plant-icon-btn">
                            <svg style="width:0.875rem;height:0.875rem;color:#2d6a4f;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:5rem 0;">
                <div style="font-size:4rem;margin-bottom:1rem;">🌱</div>
                <h3 style="font-size:1.25rem;font-weight:800;color:#374151;margin:0 0 8px;">Belum ada data tanaman</h3>
                <p style="color:#9ca3af;font-size:0.9rem;">Belum ada tanaman yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentFilter = 'semua';

document.getElementById('search-input').addEventListener('input', function() {
    filterCards(this.value.toLowerCase().trim(), currentFilter);
});
document.getElementById('search-input').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') doSearch();
});

function doSearch() {
    filterCards(document.getElementById('search-input').value.toLowerCase().trim(), currentFilter);
}

function filterJenis(jenis) {
    currentFilter = jenis;
    document.querySelectorAll('.filter-chip').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.filter === jenis);
    });
    filterCards(document.getElementById('search-input').value.toLowerCase().trim(), jenis);
}

function showAll() {
    document.getElementById('search-input').value = '';
    filterJenis('semua');
}

function filterCards(query, jenis) {
    const cards = document.querySelectorAll('#plant-grid .plant-card');
    let visible = 0;
    cards.forEach(card => {
        const match =
            (!query || (card.dataset.nama||'').includes(query) || (card.dataset.latin||'').includes(query) || (card.dataset.manfaat||'').includes(query)) &&
            (jenis === 'semua' || (card.dataset.jenis||'') === jenis);
        card.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    document.getElementById('no-result').style.display = visible === 0 ? 'block' : 'none';
    document.getElementById('plant-grid').style.display = visible === 0 ? 'none' : '';
}
</script>
@endpush

@endsection

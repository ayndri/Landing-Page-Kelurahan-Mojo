@extends('layouts.app')
@section('title', 'UMKM Warga — Kelurahan Mojo 2')

@push('styles')
<style>
/* ── HERO ── */
.umkm-hero {
    position: relative;
    overflow: hidden;
    background: linear-gradient(150deg, #431407 0%, #7c2d12 40%, #c2410c 100%);
}
.umkm-hero-inner {
    position: relative;
    z-index: 10;
    max-width: 72rem;
    margin: 0 auto;
    padding: 4rem 1.5rem 5rem;
}
.umkm-hero-orb {
    position: absolute;
    right: -80px; top: -80px;
    width: 480px; height: 480px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(251,191,36,0.15) 0%, transparent 70%);
    pointer-events: none;
}
.umkm-hero-orb2 {
    position: absolute;
    left: -100px; bottom: -100px;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(120,45,12,0.5) 0%, transparent 70%);
    pointer-events: none;
}

/* ── SEARCH ── */
.search-wrap { display: flex; gap: 10px; max-width: 36rem; }
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
.search-input::placeholder { color: rgba(255,255,255,0.4); }
.search-input:focus { border-color: rgba(251,191,36,0.7); background: rgba(255,255,255,0.15); }
.search-btn {
    background: #d97706;
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
.search-btn:hover { background: #f59e0b; }

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
.filter-chip:hover { border-color: #d97706; color: #d97706; }
.filter-chip.active { background: #d97706; border-color: #d97706; color: #fff; }

/* ── UMKM GRID ── */
.umkm-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.25rem;
}
@media (min-width: 640px) { .umkm-grid { grid-template-columns: repeat(2, 1fr); } }
@media (min-width: 1024px) { .umkm-grid { grid-template-columns: repeat(3, 1fr); } }

/* ── UMKM CARD ── */
.umkm-card {
    background: #fff;
    border-radius: 1.25rem;
    border: 1px solid #f0f0f0;
    overflow: hidden;
    display: block;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}
.umkm-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.12);
}
.umkm-card-img-wrap { overflow: hidden; position: relative; height: 200px; display: block; }
.umkm-card-img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.4s; }
.umkm-card:hover .umkm-card-img { transform: scale(1.05); }
.umkm-card-body { padding: 1.125rem 1.25rem 1.25rem; }

.umkm-badge {
    display: inline-block;
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    padding: 3px 9px;
    border-radius: 9999px;
    background: #fff7ed;
    color: #c2410c;
    border: 1px solid #fed7aa;
    margin-bottom: 8px;
}
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
.prod-chip {
    display: inline-block;
    font-size: 0.7rem;
    font-weight: 500;
    padding: 3px 10px;
    border-radius: 9999px;
    background: #fff7ed;
    color: #c2410c;
    border: 1px solid #fed7aa;
}
.card-footer {
    display: flex;
    align-items: center;
    gap: 8px;
    padding-top: 10px;
    border-top: 1px solid #f3f4f6;
    margin-top: auto;
    flex-wrap: wrap;
}
.btn-wa {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #22c55e;
    color: #fff;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 9999px;
    text-decoration: none;
    transition: background 0.15s;
}
.btn-wa:hover { background: #16a34a; }
.btn-shopee {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #f97316;
    color: #fff;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 9999px;
    text-decoration: none;
    transition: background 0.15s;
}
.btn-shopee:hover { background: #ea580c; }
</style>
@endpush

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="umkm-hero text-white">
    <div class="umkm-hero-orb"></div>
    <div class="umkm-hero-orb2"></div>
    <div class="umkm-hero-inner">

        {{-- Breadcrumb --}}
        <div style="font-size:0.8rem;color:rgba(254,215,170,0.7);margin-bottom:2rem;display:flex;align-items:center;gap:8px;">
            <a href="{{ route('home') }}" style="color:rgba(254,215,170,0.7);text-decoration:none;"
               onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(254,215,170,0.7)'">Beranda</a>
            <span style="opacity:0.4;">/</span>
            <span>UMKM</span>
        </div>

        <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:2rem;">
            <div style="flex:1;min-width:280px;">
                <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(251,191,36,0.15);border:1px solid rgba(251,191,36,0.3);border-radius:9999px;padding:5px 14px;margin-bottom:1.25rem;font-size:0.75rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(254,215,170,0.9);">
                    🏪 Ekonomi Lokal
                </div>
                <h1 style="font-size:clamp(2.25rem,5vw,3.5rem);font-weight:900;line-height:1.05;letter-spacing:-0.03em;margin:0 0 1rem;">
                    UMKM Warga<br>
                    <span style="color:#fbbf24;">Kelurahan Mojo 2</span>
                </h1>
                <p style="color:rgba(254,215,170,0.65);font-size:0.9375rem;line-height:1.75;max-width:34rem;margin:0 0 2rem;">
                    Dukung ekonomi lokal — temukan produk dan jasa terbaik dari warga Kelurahan Mojo 2.
                </p>

                {{-- Search --}}
                <div class="search-wrap" style="margin-bottom:1.5rem;">
                    <input id="search-input" type="text" class="search-input" placeholder="Cari nama usaha, produk, atau pemilik...">
                    <button class="search-btn" onclick="doSearch()">Cari</button>
                </div>

                {{-- Actions --}}
                <div style="display:flex;flex-wrap:wrap;gap:10px;">
                    <button onclick="openQrScanner()"
                        style="display:flex;align-items:center;gap:8px;background:#fff;color:#c2410c;font-weight:700;font-size:0.875rem;padding:11px 20px;border-radius:9999px;border:none;cursor:pointer;box-shadow:0 2px 12px rgba(0,0,0,0.15);">
                        <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                        Scan QR Code
                    </button>
                    <a href="{{ route('peta') }}"
                        style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.12);color:#fff;font-weight:600;font-size:0.875rem;padding:11px 20px;border-radius:9999px;border:1px solid rgba(255,255,255,0.2);text-decoration:none;backdrop-filter:blur(8px);">
                        🗺️ Peta UMKM
                    </a>
                </div>
            </div>

            {{-- Stats --}}
            <div style="display:flex;flex-direction:column;gap:12px;flex-shrink:0;">
                <div style="background:rgba(251,191,36,0.12);border:1px solid rgba(251,191,36,0.25);border-radius:1.25rem;padding:1.5rem 2rem;text-align:center;backdrop-filter:blur(8px);">
                    <div style="font-size:3rem;font-weight:900;color:#fbbf24;line-height:1;">{{ $umkm->count() }}</div>
                    <div style="font-size:0.75rem;color:rgba(254,215,170,0.6);font-weight:600;letter-spacing:0.08em;text-transform:uppercase;margin-top:6px;">Usaha Aktif</div>
                </div>
                @php $jenisCount = $umkm->pluck('jenis_usaha')->filter()->unique()->count(); @endphp
                @if($jenisCount > 0)
                <div style="background:rgba(251,191,36,0.12);border:1px solid rgba(251,191,36,0.25);border-radius:1.25rem;padding:1.25rem 2rem;text-align:center;backdrop-filter:blur(8px);">
                    <div style="font-size:2rem;font-weight:900;color:#fbbf24;line-height:1;">{{ $jenisCount }}</div>
                    <div style="font-size:0.75rem;color:rgba(254,215,170,0.6);font-weight:600;letter-spacing:0.08em;text-transform:uppercase;margin-top:6px;">Kategori</div>
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
@php
$jenisUmkm = $umkm->pluck('jenis_usaha')->filter()->unique()->sort()->values();
$emojiJenis = function(string $j): string {
    $map = [
        'kuliner'   => '🍱', 'makanan'   => '🍱', 'camilan'   => '🍱',
        'minuman'   => '🥤', 'kopi'      => '☕',
        'jasa'      => '🔧', 'jahit'     => '🧵', 'konveksi'  => '🧵',
        'fashion'   => '👗', 'pakaian'   => '👗', 'batik'     => '👗',
        'kerajinan' => '🎨', 'handmade'  => '🎨',
        'pertanian' => '🌾', 'tanaman'   => '🌿',
        'kecantikan'=> '💄', 'salon'     => '💄',
        'elektronik'=> '📱', 'gadget'    => '📱',
        'kesehatan' => '💊', 'herbal'    => '🌿',
        'pendidikan'=> '📚', 'les'       => '📚',
        'laundry'   => '👕', 'cuci'      => '👕',
    ];
    $lower = mb_strtolower($j);
    foreach ($map as $k => $e) {
        if (str_contains($lower, $k)) return $e;
    }
    return '🏪';
};
@endphp
<div class="filter-bar">
    <div class="filter-bar-inner">
        <button class="filter-chip active" data-filter="semua" onclick="filterJenis('semua')">
            🏬 Semua <span style="opacity:0.65;">({{ $umkm->count() }})</span>
        </button>
        @foreach($jenisUmkm as $j)
        <button class="filter-chip" data-filter="{{ $j }}" onclick="filterJenis('{{ $j }}')">
            {{ $emojiJenis($j) }} {{ $j }} <span style="opacity:0.65;">({{ $umkm->where('jenis_usaha', $j)->count() }})</span>
        </button>
        @endforeach
    </div>
</div>

{{-- ═══ UMKM GRID ═══ --}}
<div style="background:#f8fafc;min-height:60vh;padding:2.5rem 1.5rem 5rem;">
    <div style="max-width:72rem;margin:0 auto;">

        <div id="no-result" style="display:none;text-align:center;padding:6rem 0;">
            <div style="font-size:3.5rem;margin-bottom:1rem;">🔍</div>
            <h3 style="font-weight:800;font-size:1.25rem;color:#374151;margin:0 0 8px;">Tidak ditemukan</h3>
            <p style="color:#9ca3af;font-size:0.9rem;">Coba kata kunci lain atau hapus filter.</p>
            <button onclick="showAll()" style="margin-top:1.5rem;background:#d97706;color:#fff;font-weight:700;font-size:0.875rem;padding:10px 22px;border-radius:9999px;border:none;cursor:pointer;">Lihat Semua</button>
        </div>

        <div id="prod-grid" class="umkm-grid">
            @forelse($umkm as $u)
            @php
                $produkList = $u->produk ? array_filter(array_map('trim', explode("\n", $u->produk))) : [];
                $waMsg = "Halo, saya melihat *{$u->nama_usaha}* di website Kelurahan Mojo 2.\nBoleh saya tahu info lebih lanjut?";
                $searchText = strtolower($u->nama_usaha . ' ' . ($u->nama_pemilik ?? '') . ' ' . implode(' ', array_map(fn($p) => ltrim($p, '- '), $produkList)));
            @endphp

            <div class="umkm-card prod-item"
                 data-nama="{{ $searchText }}"
                 data-jenis="{{ $u->jenis_usaha }}"
                 data-pemilik="{{ strtolower($u->nama_pemilik ?? '') }}"
                 onclick="window.location.href='{{ route('umkm.show', $u) }}'">

                {{-- Foto --}}
                <div class="umkm-card-img-wrap">
                    @if($u->foto)
                        <img src="{{ Storage::url($u->foto) }}" alt="{{ $u->nama_usaha }}" class="umkm-card-img">
                    @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#431407,#7c2d12,#c2410c);display:flex;align-items:center;justify-content:center;font-size:3rem;">🏪</div>
                    @endif
                    @if($u->created_at->gt(now()->subDays(7)))
                    <div style="position:absolute;top:10px;left:10px;z-index:2;background:#f59e0b;color:#fff;font-size:0.6rem;font-weight:800;letter-spacing:0.06em;text-transform:uppercase;padding:3px 9px;border-radius:9999px;box-shadow:0 2px 6px rgba(245,158,11,0.4);">✨ Baru</div>
                    @elseif($u->jenis_usaha)
                    <span style="position:absolute;top:10px;left:10px;background:rgba(0,0,0,0.55);backdrop-filter:blur(6px);color:#fff;font-size:0.65rem;font-weight:700;padding:3px 9px;border-radius:9999px;letter-spacing:0.04em;">{{ $u->jenis_usaha }}</span>
                    @endif
                    @if($u->latitude && $u->longitude)
                    <span style="position:absolute;top:10px;right:10px;background:rgba(37,99,235,0.85);color:#fff;font-size:0.65rem;font-weight:700;padding:3px 8px;border-radius:9999px;display:inline-flex;align-items:center;gap:3px;">
                        <svg style="width:0.6rem;height:0.6rem;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                        Peta
                    </span>
                    @endif
                </div>

                {{-- Konten --}}
                <div class="umkm-card-body">
                    <div style="font-weight:800;font-size:0.9375rem;color:#111827;margin-bottom:3px;line-height:1.3;">{{ $u->nama_usaha }}</div>
                    @if($u->nama_pemilik)
                    <div style="font-size:0.8rem;color:#9ca3af;margin-bottom:8px;">oleh {{ $u->nama_pemilik }}</div>
                    @endif

                    @if($u->deskripsi)
                    <p style="font-size:0.8125rem;color:#6b7280;line-height:1.55;margin:0 0 10px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $u->deskripsi }}</p>
                    @endif

                    @if(count($produkList) > 0)
                    <div style="display:flex;flex-wrap:wrap;gap:4px;margin-bottom:8px;">
                        @foreach(array_slice($produkList, 0, 2) as $prod)
                        <span class="prod-chip">{{ ltrim($prod, '- ') }}</span>
                        @endforeach
                        @if(count($produkList) > 2)
                        <span class="prod-chip" style="background:#f3f4f6;color:#6b7280;border-color:#e5e7eb;">+{{ count($produkList)-2 }} lagi</span>
                        @endif
                    </div>
                    @endif

                    @if($u->jam_buka)
                    <div style="font-size:0.75rem;color:#6b7280;margin-bottom:10px;display:flex;align-items:center;gap:4px;">
                        <svg style="width:0.75rem;height:0.75rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $u->jam_buka }}
                    </div>
                    @endif

                    <div class="card-footer">
                        @if($u->no_telepon)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $u->no_telepon) }}?text={{ urlencode($waMsg) }}"
                           target="_blank" onclick="event.stopPropagation()" class="btn-wa">
                            <svg style="width:0.75rem;height:0.75rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            WA
                        </a>
                        @endif
                        @if($u->shopee)
                        <a href="{{ Str::startsWith($u->shopee, 'http') ? $u->shopee : 'https://shopee.co.id/'.$u->shopee }}"
                           target="_blank" onclick="event.stopPropagation()" class="btn-shopee">
                            🛒 Shopee
                        </a>
                        @endif
                        <span style="margin-left:auto;font-size:0.8rem;font-weight:700;color:#d97706;display:inline-flex;align-items:center;gap:2px;">
                            Lihat
                            <svg style="width:0.75rem;height:0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M7 7h10v10"/></svg>
                        </span>
                    </div>
                </div>
            </div>

            @empty
            <div style="grid-column:1/-1;text-align:center;padding:5rem 0;">
                <div style="font-size:4rem;margin-bottom:1rem;">🏪</div>
                <h3 style="font-size:1.25rem;font-weight:800;color:#374151;margin:0 0 8px;">Belum ada UMKM terdaftar</h3>
                <p style="color:#9ca3af;font-size:0.9rem;">Belum ada UMKM yang ditambahkan.</p>
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
    const cards = document.querySelectorAll('#prod-grid .prod-item');
    let visible = 0;
    cards.forEach(card => {
        const match =
            (!query || (card.dataset.nama||'').includes(query) || (card.dataset.pemilik||'').includes(query)) &&
            (jenis === 'semua' || (card.dataset.jenis||'') === jenis);
        card.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    document.getElementById('no-result').style.display = visible === 0 ? 'block' : 'none';
    document.getElementById('prod-grid').style.display = visible === 0 ? 'none' : '';
}
</script>
@endpush

@endsection

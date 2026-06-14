@extends('layouts.app')
@section('title', ($rw ?? null) ? 'Peta RW '.$rw.' - Kelurahan Mojo 2' : 'Peta Interaktif - Kelurahan Mojo 2')

@push('styles')
<style>
/* ── HERO ── */
.peta-hero {
    position: relative;
    overflow: hidden;
    background: linear-gradient(150deg, #0f2d1e 0%, #1a3d2b 40%, #2d6a4f 100%);
}
.peta-hero-orb1 {
    position: absolute;
    right: -100px; top: -100px;
    width: 500px; height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(245,158,11,0.12) 0%, transparent 70%);
    pointer-events: none;
}
.peta-hero-orb2 {
    position: absolute;
    left: -80px; bottom: -80px;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(27,67,50,0.6) 0%, transparent 70%);
    pointer-events: none;
}
.peta-hero-inner {
    position: relative;
    z-index: 10;
    max-width: 72rem;
    margin: 0 auto;
    padding: 3rem 1.5rem 5rem;
}

/* ── MAP CONTAINER ── */
.map-wrap {
    max-width: 72rem;
    margin: -2.5rem auto 0;
    padding: 0 1.5rem 3rem;
}
#map {
    height: calc(100vh - 260px);
    min-height: 520px;
    border-radius: 1.25rem;
    box-shadow: 0 8px 40px rgba(0,0,0,0.18);
    border: 3px solid #fff;
    overflow: hidden;
}

/* ── LEAFLET POPUP ── */
.leaflet-popup-content h4 {
    font-weight: 800;
    font-size: 0.9375rem;
    margin: 0 0 4px;
    color: #111827;
}
.leaflet-popup-content p {
    font-size: 0.8rem;
    color: #6b7280;
    margin: 0 0 8px;
}
.leaflet-popup-content a {
    font-size: 0.8rem;
    font-weight: 700;
}

/* ── LEGEND ── */
.peta-legend {
    background: #fff;
    padding: 14px 16px;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    border: 1px solid #f0f0f0;
}
.peta-legend-title {
    font-weight: 800;
    font-size: 0.8rem;
    color: #374151;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
}
.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.8125rem;
    font-weight: 600;
    color: #4b5563;
    margin-bottom: 6px;
}
.legend-item:last-child { margin-bottom: 0; }
.legend-dot {
    width: 14px; height: 14px;
    border-radius: 50%;
    display: inline-block;
    flex-shrink: 0;
}

/* ── CHIP ── */
.rw-chip {
    display: inline-flex;
    align-items: center;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 9999px;
    padding: 6px 14px;
    font-size: 0.8125rem;
    font-weight: 600;
    color: rgba(255,255,255,0.85);
    text-decoration: none;
    transition: background 0.15s, border-color 0.15s;
}
.rw-chip:hover {
    background: rgba(255,255,255,0.22);
    border-color: rgba(255,255,255,0.4);
    color: #fff;
}
.rw-chip.active {
    background: rgba(245,158,11,0.25);
    border-color: rgba(245,158,11,0.5);
    color: #fcd34d;
}

/* ── ALERT ── */
.peta-alert {
    max-width: 72rem;
    margin: 1rem auto 0;
    padding: 0 1.5rem;
}
.peta-alert-inner {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fffbeb;
    border: 1px solid #fde68a;
    color: #92400e;
    border-radius: 0.875rem;
    padding: 0.875rem 1.25rem;
    font-size: 0.875rem;
    font-weight: 500;
}
</style>
@endpush

@section('content')
@php $rw = $rw ?? null; @endphp

{{-- ═══ HERO ═══ --}}
<section class="peta-hero text-white">
    <div class="peta-hero-orb1"></div>
    <div class="peta-hero-orb2"></div>

    <div class="peta-hero-inner">

        {{-- Breadcrumb --}}
        <div style="font-size:0.8rem;color:rgba(209,250,229,0.65);margin-bottom:2rem;display:flex;align-items:center;gap:8px;">
            <a href="{{ route('home') }}" style="color:rgba(209,250,229,0.65);text-decoration:none;"
               onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(209,250,229,0.65)'">Beranda</a>
            @if($rw)
                <span style="opacity:0.4;">/</span>
                <a href="{{ route('rw.profile', $rw) }}" style="color:rgba(209,250,229,0.65);text-decoration:none;"
                   onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(209,250,229,0.65)'">RW {{ $rw }}</a>
            @endif
            <span style="opacity:0.4;">/</span>
            <span>Peta</span>
        </div>

        <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:2rem;">
            <div>
                {{-- Icon + Title --}}
                <div style="display:flex;align-items:center;gap:1.25rem;margin-bottom:0.875rem;">
                    <div style="width:5rem;height:5rem;border-radius:1.25rem;background:rgba(245,158,11,0.2);border:2px solid rgba(245,158,11,0.4);display:flex;align-items:center;justify-content:center;font-size:2rem;flex-shrink:0;backdrop-filter:blur(6px);">
                        🗺️
                    </div>
                    <div>
                        <div style="font-size:0.7rem;font-weight:800;letter-spacing:0.14em;text-transform:uppercase;color:rgba(252,211,77,0.8);margin-bottom:5px;">
                            Peta Interaktif · Kelurahan Mojo 2
                        </div>
                        <h1 style="font-size:clamp(1.875rem,4.5vw,3rem);font-weight:900;line-height:1.05;letter-spacing:-0.03em;margin:0;">
                            @if($rw)
                                Peta RW <span style="color:#fcd34d;">{{ $rw }}</span>
                            @else
                                Peta <span style="color:#fcd34d;">Kelurahan Mojo 2</span>
                            @endif
                        </h1>
                    </div>
                </div>

                <p style="color:rgba(209,250,229,0.65);font-size:0.9rem;margin:0 0 1.5rem;max-width:32rem;line-height:1.7;">
                    @if($rw)
                        Sebaran tanaman dan UMKM warga RW {{ $rw }}. Klik marker untuk melihat detail & arah lokasi.
                    @else
                        Sebaran tanaman dan UMKM seluruh warga Kelurahan Mojo 2. Klik marker untuk melihat detail & arah lokasi.
                    @endif
                </p>

                {{-- Stats pills --}}
                <div style="display:flex;flex-wrap:wrap;gap:0.75rem;margin-bottom:1.75rem;">
                    <div style="background:rgba(45,106,79,0.4);border:1px solid rgba(116,198,157,0.3);border-radius:9999px;padding:6px 16px;display:flex;align-items:center;gap:8px;">
                        <span style="width:10px;height:10px;border-radius:50%;background:#52b788;flex-shrink:0;display:inline-block;"></span>
                        <span style="font-size:0.8125rem;font-weight:700;color:rgba(209,250,229,0.9);">{{ $plants->count() }} Tanaman</span>
                    </div>
                    <div style="background:rgba(217,119,6,0.25);border:1px solid rgba(245,158,11,0.3);border-radius:9999px;padding:6px 16px;display:flex;align-items:center;gap:8px;">
                        <span style="width:10px;height:10px;border-radius:50%;background:#f59e0b;flex-shrink:0;display:inline-block;"></span>
                        <span style="font-size:0.8125rem;font-weight:700;color:rgba(209,250,229,0.9);">{{ $umkm->count() }} UMKM</span>
                    </div>
                </div>
            </div>

            {{-- Aksi / navigasi --}}
            <div style="display:flex;flex-direction:column;gap:8px;align-items:flex-end;flex-shrink:0;">
                @if($rw)
                    <a href="{{ route('peta') }}" class="rw-chip">
                        🌐 Peta Seluruh Kelurahan
                    </a>
                    <a href="{{ route('rw.profile', $rw) }}" class="rw-chip" style="margin-top:4px;">
                        ← Kembali ke Profil RW {{ $rw }}
                    </a>
                @else
                    <div style="font-size:0.7rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:rgba(252,211,77,0.6);margin-bottom:4px;text-align:right;">Peta per RW</div>
                    <div style="display:flex;flex-wrap:wrap;gap:6px;justify-content:flex-end;">
                        @foreach([9, 10, 11, 12, 13] as $n)
                        <a href="{{ route('rw.peta', $n) }}" class="rw-chip">
                            RW {{ $n }}
                        </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- Wave --}}
    <svg style="display:block;width:100%;margin-top:-1px;" viewBox="0 0 1440 56" preserveAspectRatio="none" fill="none">
        <path d="M0,28 C360,56 1080,0 1440,28 L1440,56 L0,56 Z" fill="#f8fafc"/>
    </svg>
</section>

{{-- ═══ ALERT jika kosong ═══ --}}
@if($plants->isEmpty() && $umkm->isEmpty())
<div class="peta-alert">
    <div class="peta-alert-inner">
        <svg style="width:1.125rem;height:1.125rem;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        @if($rw)
            Belum ada titik tanaman/UMKM ber-lokasi untuk RW {{ $rw }}. Admin RW {{ $rw }} perlu menambahkan data beserta koordinat lokasi.
        @else
            Belum ada titik tanaman/UMKM ber-lokasi. Peta menampilkan area Kelurahan Mojo 2 secara umum.
        @endif
    </div>
</div>
@endif

{{-- ═══ PETA ═══ --}}
<div style="background:#f8fafc;padding-bottom:4rem;">
    <div class="map-wrap">
        <div id="map"></div>
    </div>
</div>

@push('scripts')
<script>
    const plants = @json($plants);
    const umkm   = @json($umkm);

    const allPoints = [...plants, ...umkm];
    const defaultLat = allPoints.length ? allPoints[0].lat : -7.2575;
    const defaultLng = allPoints.length ? allPoints[0].lng : 112.7521;

    // Link "petunjuk arah" Google Maps: buka rute dari lokasi pengguna ke titik.
    const gmapsUrl = (lat, lng) => `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;

    const map = L.map('map').setView([defaultLat, defaultLng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const plantIcon = L.divIcon({
        className: '',
        html: '<div style="background:#2d6a4f;width:30px;height:30px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid white;box-shadow:0 3px 8px rgba(0,0,0,0.25)"></div>',
        iconSize: [30, 30],
        iconAnchor: [15, 30],
        popupAnchor: [0, -32],
    });

    const umkmIcon = L.divIcon({
        className: '',
        html: '<div style="background:#d97706;width:30px;height:30px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid white;box-shadow:0 3px 8px rgba(0,0,0,0.25)"></div>',
        iconSize: [30, 30],
        iconAnchor: [15, 30],
        popupAnchor: [0, -32],
    });

    plants.forEach(p => {
        L.marker([p.lat, p.lng], { icon: plantIcon })
            .addTo(map)
            .bindPopup(`
                <div style="min-width:175px;">
                    <h4>🌿 ${p.nama}</h4>
                    <p>${p.jenis || ''}</p>
                    <div style="display:flex;flex-direction:column;gap:7px;margin-top:2px;">
                        <a href="${p.url}" style="color:#2d6a4f;font-weight:700;">Lihat detail →</a>
                        <a href="${gmapsUrl(p.lat, p.lng)}" target="_blank" rel="noopener"
                           style="display:inline-flex;align-items:center;justify-content:center;gap:6px;background:#2d6a4f;color:#fff;font-weight:700;padding:7px 10px;border-radius:8px;text-decoration:none;">
                            🧭 Buka di Google Maps
                        </a>
                    </div>
                </div>
            `);
    });

    umkm.forEach(u => {
        L.marker([u.lat, u.lng], { icon: umkmIcon })
            .addTo(map)
            .bindPopup(`
                <div style="min-width:175px;">
                    <h4>🏪 ${u.nama}</h4>
                    <p>${u.jenis || ''}</p>
                    <div style="display:flex;flex-direction:column;gap:7px;margin-top:2px;">
                        <a href="${u.url}" style="color:#d97706;font-weight:700;">Lihat detail →</a>
                        <a href="${gmapsUrl(u.lat, u.lng)}" target="_blank" rel="noopener"
                           style="display:inline-flex;align-items:center;justify-content:center;gap:6px;background:#d97706;color:#fff;font-weight:700;padding:7px 10px;border-radius:8px;text-decoration:none;">
                            🧭 Buka di Google Maps
                        </a>
                    </div>
                </div>
            `);
    });

    if (allPoints.length) {
        const bounds = L.latLngBounds(allPoints.map(p => [p.lat, p.lng]));
        map.fitBounds(bounds, { padding: [48, 48] });
    }

    // Legend
    const legend = L.control({ position: 'bottomright' });
    legend.onAdd = () => {
        const div = L.DomUtil.create('div', 'peta-legend');
        div.innerHTML = `
            <div class="peta-legend-title">Keterangan</div>
            <div class="legend-item">
                <span class="legend-dot" style="background:#2d6a4f"></span>
                Tanaman <span style="color:#9ca3af;font-weight:500;margin-left:2px;">(${plants.length})</span>
            </div>
            <div class="legend-item">
                <span class="legend-dot" style="background:#d97706"></span>
                UMKM <span style="color:#9ca3af;font-weight:500;margin-left:2px;">(${umkm.length})</span>
            </div>
        `;
        return div;
    };
    legend.addTo(map);
</script>
@endpush

@endsection

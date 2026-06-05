@extends('layouts.app')
@section('title', $plant->nama.' — Tanaman RW '.($plant->user->rw_number ?? ''))

@push('styles')
<style>
/* ── PHOTO HERO ── */
.plant-photo-hero {
    position: relative;
    height: 420px;
    overflow: hidden;
    background: linear-gradient(135deg, #1b4332, #2d6a4f);
}
@media (max-width: 640px) { .plant-photo-hero { height: 280px; } }
.plant-photo-hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.plant-photo-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(15,45,30,0.85) 0%, rgba(15,45,30,0.3) 50%, rgba(0,0,0,0.15) 100%);
}

/* ── CARD ── */
.info-card {
    background: #fff;
    border-radius: 1.5rem;
    border: 1px solid #f0f0f0;
    box-shadow: 0 2px 16px rgba(0,0,0,0.05);
    overflow: hidden;
}
.info-card-header {
    padding: 1.125rem 1.5rem;
    border-bottom: 1px solid #f3f4f6;
    font-weight: 700;
    font-size: 0.9rem;
    color: #374151;
    display: flex;
    align-items: center;
    gap: 10px;
}
.info-card-body { padding: 1.5rem; }

/* ── MANFAAT ── */
.manfaat-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 10px 0;
    border-bottom: 1px solid #f3f4f6;
}
.manfaat-item:last-child { border-bottom: none; }

/* ── MAP ── */
#map-detail { height: 300px; }

/* ── QR DOWNLOAD BTN ── */
.btn-download {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    background: linear-gradient(135deg, #2d6a4f, #40916c);
    color: #fff;
    font-weight: 700;
    font-size: 0.9rem;
    padding: 14px;
    border-radius: 0.875rem;
    border: none;
    cursor: pointer;
    transition: opacity 0.2s, transform 0.15s;
    box-shadow: 0 4px 16px rgba(45,106,79,0.3);
}
.btn-download:hover { opacity: 0.92; transform: translateY(-1px); }
.btn-share {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    background: #f8fafc;
    color: #374151;
    font-weight: 600;
    font-size: 0.875rem;
    padding: 13px;
    border-radius: 0.875rem;
    border: 1.5px solid #e5e7eb;
    cursor: pointer;
    transition: background 0.2s;
}
.btn-share:hover { background: #f0f0f0; }

/* ── DETAIL LAYOUT ── */
.detail-layout {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}
@media (min-width: 768px) {
    .detail-layout { grid-template-columns: 1fr 320px; }
}
</style>
@endpush

@section('content')

{{-- ═══ PHOTO HERO ═══ --}}
<div class="plant-photo-hero">
    @if($plant->foto)
        <img src="{{ Storage::url($plant->foto) }}" alt="{{ $plant->nama }}">
    @else
        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:8rem;opacity:0.15;">🌿</div>
    @endif
    <div class="plant-photo-overlay"></div>

    {{-- Back button --}}
    <a href="{{ route('tanaman.index') }}"
       style="position:absolute;top:1.25rem;left:1.25rem;display:flex;align-items:center;gap:6px;background:rgba(0,0,0,0.35);backdrop-filter:blur(8px);color:#fff;font-size:0.8rem;font-weight:600;padding:8px 16px;border-radius:9999px;text-decoration:none;border:1px solid rgba(255,255,255,0.15);transition:background 0.2s;"
       onmouseover="this.style.background='rgba(0,0,0,0.55)'" onmouseout="this.style.background='rgba(0,0,0,0.35)'">
        <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>

    {{-- Name overlay --}}
    <div style="position:absolute;bottom:0;left:0;right:0;padding:2rem 2rem 1.75rem;">
        <div style="max-width:72rem;margin:0 auto;">
            <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:0.875rem;">
                @if($plant->jenis)
                <span style="display:inline-flex;align-items:center;gap:5px;background:rgba(255,255,255,0.15);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,0.25);border-radius:9999px;padding:4px 12px;font-size:0.75rem;font-weight:700;color:#d1fae5;letter-spacing:0.04em;">
                    🌱 {{ $plant->jenis }}
                </span>
                @endif
                @if($plant->latitude && $plant->longitude)
                <span style="display:inline-flex;align-items:center;gap:5px;background:rgba(37,99,235,0.3);backdrop-filter:blur(8px);border:1px solid rgba(96,165,250,0.4);border-radius:9999px;padding:4px 12px;font-size:0.75rem;font-weight:700;color:#bfdbfe;">
                    📍 Ada di Peta
                </span>
                @endif
            </div>
            <h1 style="font-size:clamp(2rem,5vw,3rem);font-weight:900;color:#fff;letter-spacing:-0.03em;line-height:1.05;margin:0 0 4px;">{{ $plant->nama }}</h1>
            @if($plant->nama_latin)
            <p style="color:rgba(209,250,229,0.65);font-size:0.9375rem;font-style:italic;margin:0;">{{ $plant->nama_latin }}</p>
            @endif
        </div>
    </div>
</div>

{{-- ═══ MAIN CONTENT ═══ --}}
<div style="background:#f8fafc;padding:2rem 1.5rem 5rem;">
    <div style="max-width:72rem;margin:0 auto;">
        <div class="detail-layout">

            {{-- ── LEFT COLUMN ── --}}
            <div style="display:flex;flex-direction:column;gap:1.5rem;">

                {{-- Deskripsi --}}
                @if($plant->deskripsi)
                <div class="info-card">
                    <div class="info-card-header">
                        <div style="width:2rem;height:2rem;border-radius:0.625rem;background:#f0faf4;display:flex;align-items:center;justify-content:center;font-size:1rem;">📖</div>
                        Tentang {{ $plant->nama }}
                    </div>
                    <div class="info-card-body">
                        <p style="color:#4b5563;line-height:1.9;font-size:0.9375rem;margin:0;white-space:pre-line;">{{ $plant->deskripsi }}</p>
                    </div>
                </div>
                @endif

                {{-- Manfaat --}}
                @if($plant->manfaat)
                <div class="info-card">
                    <div class="info-card-header">
                        <div style="width:2rem;height:2rem;border-radius:0.625rem;background:#f0faf4;display:flex;align-items:center;justify-content:center;font-size:1rem;">✨</div>
                        Manfaat
                    </div>
                    <div class="info-card-body" style="padding-top:0.75rem;padding-bottom:0.75rem;">
                        @foreach(array_filter(array_map('trim', explode("\n", $plant->manfaat))) as $item)
                        <div class="manfaat-item">
                            <div style="width:1.375rem;height:1.375rem;background:linear-gradient(135deg,#2d6a4f,#40916c);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;box-shadow:0 2px 6px rgba(45,106,79,0.25);">
                                <svg style="width:0.625rem;height:0.625rem;color:#fff;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span style="color:#374151;font-size:0.9rem;line-height:1.6;">{{ ltrim($item, '- ') }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Lokasi + Peta --}}
                @if($plant->latitude && $plant->longitude)
                <div class="info-card">
                    <div class="info-card-header">
                        <div style="width:2rem;height:2rem;border-radius:0.625rem;background:#eff6ff;display:flex;align-items:center;justify-content:center;font-size:1rem;">📍</div>
                        Lokasi di Peta
                        @if($plant->lokasi_keterangan)
                        <span style="font-size:0.8rem;font-weight:400;color:#9ca3af;margin-left:4px;">— {{ $plant->lokasi_keterangan }}</span>
                        @endif
                    </div>
                    <div id="map-detail" style="width:100%;"></div>
                    <div style="padding:1rem 1.5rem;border-top:1px solid #f3f4f6;">
                        <a href="{{ route('peta') }}"
                           style="display:inline-flex;align-items:center;gap:6px;font-size:0.8rem;font-weight:700;color:#2563eb;text-decoration:none;">
                            <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                            Lihat semua tanaman di peta →
                        </a>
                    </div>
                </div>
                @endif

            </div>

            {{-- ── RIGHT SIDEBAR ── --}}
            <div style="display:flex;flex-direction:column;gap:1.5rem;">

                {{-- QR Code --}}
                <div class="info-card">
                    <div class="info-card-header">
                        <div style="width:2rem;height:2rem;border-radius:0.625rem;background:#f0faf4;display:flex;align-items:center;justify-content:center;font-size:1rem;">📱</div>
                        QR Code Tanaman
                    </div>
                    <div class="info-card-body" style="text-align:center;">
                        <div style="display:inline-block;padding:1.25rem;background:#fff;border-radius:1rem;border:2px solid #f0faf4;box-shadow:0 4px 20px rgba(0,0,0,0.07);margin-bottom:1rem;">
                            <canvas data-qr-url="{{ route('tanaman.show', $plant) }}" style="display:block;border-radius:6px;"></canvas>
                        </div>
                        <p style="font-size:0.8rem;color:#9ca3af;margin:0 0 1.25rem;">Scan untuk halaman ini</p>
                        <div style="display:flex;flex-direction:column;gap:10px;">
                            <button
                                class="btn-download"
                                data-qr-download="{{ route('tanaman.show', $plant) }}"
                                data-qr-name="{{ Str::slug($plant->nama) }}">
                                <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Download QR Code
                            </button>
                            @php
                                $rwNum = $plant->user->rw_number ?? '';
                                $waText = "🌿 *{$plant->nama}*" .
                                    ($plant->nama_latin ? "\n_{$plant->nama_latin}_" : '') .
                                    ($plant->jenis ? "\nKategori: {$plant->jenis}" : '') .
                                    ($rwNum ? " · RW {$rwNum} Kelurahan Mojo 2" : '') .
                                    "\n\nLihat selengkapnya:\n" . route('tanaman.show', $plant) .
                                    "\n\n_dari *Website Kelurahan Mojo 2* 🌿_";
                                $waUrl = "https://wa.me/?text=" . rawurlencode($waText);
                            @endphp
                            <a href="{{ $waUrl }}" target="_blank" rel="noopener"
                               style="display:flex;align-items:center;justify-content:center;gap:6px;width:100%;background:#22c55e;color:#fff;font-weight:700;font-size:0.875rem;padding:11px 16px;border-radius:9999px;text-decoration:none;transition:background 0.15s;"
                               onmouseover="this.style.background='#16a34a'" onmouseout="this.style.background='#22c55e'">
                                <svg style="width:0.9rem;height:0.9rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                Kirim ke WA
                            </a>
                            <button class="btn-share" onclick="shareUrl()">
                                <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                                Bagikan Link
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Info ringkas --}}
                <div class="info-card">
                    <div class="info-card-header">
                        <div style="width:2rem;height:2rem;border-radius:0.625rem;background:#f0faf4;display:flex;align-items:center;justify-content:center;font-size:1rem;">🌿</div>
                        Identitas Tanaman
                    </div>
                    <div class="info-card-body" style="display:flex;flex-direction:column;gap:0;">
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:0.625rem 0;border-bottom:1px solid #f3f4f6;">
                            <span style="font-size:0.8rem;color:#9ca3af;font-weight:500;">Nama Lokal</span>
                            <span style="font-weight:700;font-size:0.9rem;color:#111827;">{{ $plant->nama }}</span>
                        </div>
                        @if($plant->nama_latin)
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:0.625rem 0;border-bottom:1px solid #f3f4f6;gap:1rem;">
                            <span style="font-size:0.8rem;color:#9ca3af;font-weight:500;flex-shrink:0;">Nama Latin</span>
                            <span style="font-size:0.8rem;color:#374151;font-style:italic;text-align:right;">{{ $plant->nama_latin }}</span>
                        </div>
                        @endif
                        @if($plant->jenis)
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:0.625rem 0;border-bottom:1px solid #f3f4f6;">
                            <span style="font-size:0.8rem;color:#9ca3af;font-weight:500;">Jenis</span>
                            <span style="display:inline-block;font-size:0.7rem;font-weight:700;background:#f0faf4;color:#2d6a4f;border:1px solid #d1fae5;padding:3px 10px;border-radius:9999px;">{{ $plant->jenis }}</span>
                        </div>
                        @endif
                        @if($plant->lokasi_keterangan)
                        <div style="padding:0.625rem 0;border-bottom:1px solid #f3f4f6;">
                            <span style="font-size:0.8rem;color:#9ca3af;font-weight:500;display:block;margin-bottom:4px;">Lokasi</span>
                            <span style="font-size:0.875rem;color:#374151;">{{ $plant->lokasi_keterangan }}</span>
                        </div>
                        @endif
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:0.625rem 0;">
                            <span style="font-size:0.8rem;color:#9ca3af;font-weight:500;">Wilayah</span>
                            <span style="font-size:0.8rem;color:#374151;font-weight:600;">RW {{ $plant->user->rw_number ?? '—' }} · Mojo 2</span>
                        </div>
                    </div>
                </div>

                {{-- Link profil RW --}}
                @php $rwNum = $plant->user->rw_number ?? null; @endphp
                @if($rwNum)
                <a href="{{ route('rw.profile', $rwNum) }}"
                   style="display:flex;align-items:center;gap:1rem;background:#fff;border:1px solid #f0f0f0;border-radius:1.25rem;padding:1.25rem 1.5rem;text-decoration:none;box-shadow:0 2px 12px rgba(0,0,0,0.05);transition:box-shadow 0.2s;"
                   onmouseover="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.10)'" onmouseout="this.style.boxShadow='0 2px 12px rgba(0,0,0,0.05)'">
                    <div style="width:2.75rem;height:2.75rem;border-radius:50%;background:linear-gradient(135deg,#f0faf4,#d1fae5);border:2px solid #74c69d;display:flex;align-items:center;justify-content:center;font-weight:900;font-size:1rem;color:#2d6a4f;flex-shrink:0;">{{ $rwNum }}</div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-weight:700;font-size:0.9rem;color:#111827;">RW {{ $rwNum }} · Kelurahan Mojo 2</div>
                        <div style="font-size:0.75rem;color:#9ca3af;margin-top:2px;">Kota Surabaya · Jawa Timur</div>
                    </div>
                    <svg style="width:1rem;height:1rem;color:#9ca3af;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                @endif

            </div>
        </div>
    </div>
</div>

@push('scripts')
@if($plant->latitude && $plant->longitude)
@php
$popupHtml = '<strong style="font-size:14px">🌿 ' . $plant->nama . '</strong>' .
    ($plant->lokasi_keterangan ? '<br><small style="color:#666">' . $plant->lokasi_keterangan . '</small>' : '');
@endphp
<script>
    const map = L.map('map-detail').setView([{{ $plant->latitude }}, {{ $plant->longitude }}], 17);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const icon = L.divIcon({
        className: '',
        html: '<div style="width:36px;height:36px;background:#2d6a4f;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,0.3);"></div>',
        iconSize: [36, 36],
        iconAnchor: [18, 36],
        popupAnchor: [0, -36],
    });

    L.marker([{{ $plant->latitude }}, {{ $plant->longitude }}], { icon })
        .addTo(map)
        .bindPopup(@json($popupHtml), { maxWidth: 220 })
        .openPopup();
</script>
@endif
<script>
    function shareUrl() {
        const url = '{{ route('tanaman.show', $plant) }}';
        if (navigator.share) {
            navigator.share({ title: '{{ $plant->nama }} — Tanaman RW {{ $plant->user->rw_number ?? "" }} Mojo 2', url });
        } else {
            navigator.clipboard.writeText(url).then(() => {
                alert('Link disalin!');
            });
        }
    }
</script>
@endpush

@endsection

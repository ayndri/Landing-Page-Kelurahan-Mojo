@extends('layouts.app')
@section('title', $umkm->nama_usaha.' — UMKM RW 10')

@push('styles')
<style>
/* ── PHOTO HERO ── */
.umkm-photo-hero {
    position: relative;
    height: 400px;
    overflow: hidden;
    background: linear-gradient(135deg, #431407, #7c2d12);
}
@media (max-width: 640px) { .umkm-photo-hero { height: 260px; } }
.umkm-photo-hero img { width: 100%; height: 100%; object-fit: cover; display: block; }
.umkm-photo-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(67,20,7,0.88) 0%, rgba(67,20,7,0.35) 50%, rgba(0,0,0,0.1) 100%);
}

/* ── CARDS ── */
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
.icon-box {
    width: 2rem; height: 2rem;
    border-radius: 0.625rem;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}

/* ── LAYOUT ── */
.detail-layout {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}
@media (min-width: 768px) {
    .detail-layout { grid-template-columns: 1fr 320px; }
}

/* ── PRODUCT CHIP ── */
.prod-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #fff7ed;
    border: 1px solid #fed7aa;
    color: #c2410c;
    border-radius: 9999px;
    padding: 6px 14px;
    font-size: 0.8125rem;
    font-weight: 500;
}

/* ── CONTACT ITEMS ── */
.contact-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.875rem;
    border-radius: 0.875rem;
    background: #f9fafb;
    border: 1px solid #f3f4f6;
}

/* ── CTA BUTTONS ── */
.btn-wa-lg {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #22c55e;
    color: #fff;
    font-weight: 700;
    font-size: 0.9375rem;
    padding: 14px 20px;
    border-radius: 0.875rem;
    text-decoration: none;
    transition: background 0.2s, transform 0.15s;
    box-shadow: 0 4px 16px rgba(34,197,94,0.3);
}
.btn-wa-lg:hover { background: #16a34a; transform: translateY(-1px); }
.btn-shopee-lg {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #f97316;
    color: #fff;
    font-weight: 700;
    font-size: 0.9375rem;
    padding: 14px 20px;
    border-radius: 0.875rem;
    text-decoration: none;
    transition: background 0.2s, transform 0.15s;
    box-shadow: 0 4px 16px rgba(249,115,22,0.3);
}
.btn-shopee-lg:hover { background: #ea580c; transform: translateY(-1px); }
.btn-download {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    background: linear-gradient(135deg, #d97706, #f59e0b);
    color: #fff;
    font-weight: 700;
    font-size: 0.875rem;
    padding: 13px;
    border-radius: 0.875rem;
    border: none;
    cursor: pointer;
    transition: opacity 0.2s, transform 0.15s;
    box-shadow: 0 4px 16px rgba(217,119,6,0.3);
}
.btn-download:hover { opacity: 0.9; transform: translateY(-1px); }
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
    padding: 12px;
    border-radius: 0.875rem;
    border: 1.5px solid #e5e7eb;
    cursor: pointer;
    transition: background 0.2s;
}
.btn-share:hover { background: #f0f0f0; }

/* ── MAP ── */
#map-detail { height: 280px; }

/* ── INFO ROW ── */
.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.625rem 0;
    border-bottom: 1px solid #f3f4f6;
}
.info-row:last-child { border-bottom: none; }
</style>
@endpush

@section('content')

{{-- ═══ PHOTO HERO ═══ --}}
<div class="umkm-photo-hero">
    @if($umkm->foto)
        <img src="{{ Storage::url($umkm->foto) }}" alt="{{ $umkm->nama_usaha }}">
    @else
        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:8rem;opacity:0.12;">🏪</div>
    @endif
    <div class="umkm-photo-overlay"></div>

    {{-- Back --}}
    <a href="{{ route('umkm.index') }}"
       style="position:absolute;top:1.25rem;left:1.25rem;display:flex;align-items:center;gap:6px;background:rgba(0,0,0,0.35);backdrop-filter:blur(8px);color:#fff;font-size:0.8rem;font-weight:600;padding:8px 16px;border-radius:9999px;text-decoration:none;border:1px solid rgba(255,255,255,0.15);"
       onmouseover="this.style.background='rgba(0,0,0,0.55)'" onmouseout="this.style.background='rgba(0,0,0,0.35)'">
        <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>

    {{-- Name overlay --}}
    <div style="position:absolute;bottom:0;left:0;right:0;padding:2rem 2rem 1.75rem;">
        <div style="max-width:72rem;margin:0 auto;">
            <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:0.875rem;">
                @if($umkm->jenis_usaha)
                <span style="display:inline-flex;align-items:center;background:rgba(249,115,22,0.3);backdrop-filter:blur(8px);border:1px solid rgba(251,191,36,0.4);border-radius:9999px;padding:4px 12px;font-size:0.75rem;font-weight:700;color:#fef3c7;letter-spacing:0.04em;">
                    🏪 {{ $umkm->jenis_usaha }}
                </span>
                @endif
                @if($umkm->jam_buka)
                <span style="display:inline-flex;align-items:center;gap:5px;background:rgba(0,0,0,0.3);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,0.15);border-radius:9999px;padding:4px 12px;font-size:0.75rem;font-weight:600;color:rgba(254,243,199,0.85);">
                    🕐 {{ $umkm->jam_buka }}
                </span>
                @endif
                @if($umkm->latitude && $umkm->longitude)
                <span style="display:inline-flex;align-items:center;gap:5px;background:rgba(37,99,235,0.3);backdrop-filter:blur(8px);border:1px solid rgba(96,165,250,0.4);border-radius:9999px;padding:4px 12px;font-size:0.75rem;font-weight:700;color:#bfdbfe;">
                    📍 Ada di Peta
                </span>
                @endif
            </div>
            <h1 style="font-size:clamp(2rem,5vw,3rem);font-weight:900;color:#fff;letter-spacing:-0.03em;line-height:1.05;margin:0 0 4px;">{{ $umkm->nama_usaha }}</h1>
            @if($umkm->nama_pemilik)
            <p style="color:rgba(254,215,170,0.65);font-size:0.9375rem;margin:0;">oleh {{ $umkm->nama_pemilik }}</p>
            @endif
        </div>
    </div>
</div>

{{-- ═══ QUICK ACTION BAR ═══ --}}
@if($umkm->no_telepon || $umkm->shopee)
<div style="background:#fff;border-bottom:1px solid #f0f0f0;padding:1rem 1.5rem;box-shadow:0 2px 12px rgba(0,0,0,0.05);">
    <div style="max-width:72rem;margin:0 auto;display:flex;gap:12px;flex-wrap:wrap;align-items:center;">
        @if($umkm->no_telepon)
        @php
            if($umkm->products->count() > 0) {
                $produkNamas = $umkm->products->take(5)->pluck('nama')->map(fn($n) => "- {$n}")->implode("\n");
                $produkText = "\n\nProduk yang saya minati:\n{$produkNamas}";
            } else {
                $produkLines = $umkm->produk ? array_filter(array_map(fn($l) => ltrim(trim($l), '- '), explode("\n", $umkm->produk))) : [];
                $produkText = count($produkLines) ? "\n\nProduk yang saya minati:\n" . implode("\n", array_map(fn($p) => "- {$p}", array_slice($produkLines, 0, 5))) : '';
            }
            $rwNum = $umkm->user->rw_number ?? '';
            $waMsg = "Halo, saya melihat *{$umkm->nama_usaha}* di website Kelurahan Mojo 2.{$produkText}\n\nBoleh saya tahu info lebih lanjut?";
        @endphp
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm->no_telepon) }}?text={{ urlencode($waMsg) }}" target="_blank" class="btn-wa-lg" style="flex:1;min-width:140px;">
            <svg style="width:1.125rem;height:1.125rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Chat WhatsApp
        </a>
        @endif
        @if($umkm->shopee)
        <a href="{{ Str::startsWith($umkm->shopee, 'http') ? $umkm->shopee : 'https://shopee.co.id/'.$umkm->shopee }}" target="_blank" class="btn-shopee-lg" style="flex:1;min-width:140px;">
            🛒 Buka Shopee
        </a>
        @endif
        <button onclick="shareUrl()"
            style="width:48px;height:48px;background:#f8fafc;border:1.5px solid #e5e7eb;border-radius:0.875rem;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;transition:background 0.2s;"
            onmouseover="this.style.background='#f0f0f0'" onmouseout="this.style.background='#f8fafc'" title="Bagikan">
            <svg style="width:1.125rem;height:1.125rem;color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
        </button>
    </div>
</div>
@endif

{{-- ═══ MAIN CONTENT ═══ --}}
<div style="background:#f8fafc;padding:2rem 1.5rem 5rem;">
    <div style="max-width:72rem;margin:0 auto;">
        <div class="detail-layout">

            {{-- ── LEFT ── --}}
            <div style="display:flex;flex-direction:column;gap:1.5rem;">

                {{-- Produk & Layanan --}}
                @if($umkm->products->count() > 0)
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="icon-box" style="background:#fff7ed;">🛍️</div>
                        Produk &amp; Layanan
                        <span style="margin-left:auto;font-size:0.75rem;font-weight:400;color:#9ca3af;">{{ $umkm->products->count() }} produk</span>
                    </div>
                    <div class="info-card-body">
                        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:10px;">
                            @foreach($umkm->products as $product)
                            <a href="{{ route('umkm.produk.show', [$umkm, $product]) }}"
                               style="text-decoration:none;border-radius:0.875rem;overflow:hidden;border:1px solid #f0f0f0;display:block;transition:transform 0.2s,box-shadow 0.2s;box-shadow:0 2px 8px rgba(0,0,0,0.04);"
                               onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 20px rgba(0,0,0,0.10)'"
                               onmouseout="this.style.transform='';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'">
                                @if($product->foto)
                                <img src="{{ Storage::url($product->foto) }}" alt="{{ $product->nama }}"
                                     style="width:100%;height:100px;object-fit:cover;display:block;">
                                @else
                                <div style="width:100%;height:100px;background:linear-gradient(135deg,#fff7ed,#fde68a);display:flex;align-items:center;justify-content:center;font-size:2rem;">🛍️</div>
                                @endif
                                <div style="padding:8px 10px;background:#fff;">
                                    <div style="font-weight:700;font-size:0.8rem;color:#111827;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $product->nama }}</div>
                                    @if($product->harga)
                                    <div style="font-size:0.75rem;color:#d97706;font-weight:600;margin-top:2px;">{{ $product->harga }}</div>
                                    @endif
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @elseif($umkm->produk)
                @php $produkList = array_filter(array_map('trim', explode("\n", $umkm->produk))); @endphp
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="icon-box" style="background:#fff7ed;">🛍️</div>
                        Produk &amp; Layanan
                    </div>
                    <div class="info-card-body">
                        <div style="display:flex;flex-wrap:wrap;gap:8px;">
                            @foreach($produkList as $p)
                            <span class="prod-chip">{{ ltrim($p, '- ') }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- Deskripsi --}}
                @if($umkm->deskripsi)
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="icon-box" style="background:#fffbeb;">📖</div>
                        Tentang Usaha
                    </div>
                    <div class="info-card-body">
                        <p style="color:#4b5563;line-height:1.9;font-size:0.9375rem;margin:0;white-space:pre-line;">{{ $umkm->deskripsi }}</p>
                    </div>
                </div>
                @endif

                {{-- Kontak & Info --}}
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="icon-box" style="background:#f0faf4;">👤</div>
                        Profil &amp; Kontak
                    </div>
                    <div class="info-card-body" style="display:flex;flex-direction:column;gap:10px;">
                        @if($umkm->nama_pemilik)
                        <div class="contact-item">
                            <span style="font-size:1.25rem;">🧑‍💼</span>
                            <div>
                                <div style="font-size:0.7rem;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Pemilik</div>
                                <div style="font-weight:700;color:#111827;font-size:0.9375rem;">{{ $umkm->nama_pemilik }}</div>
                            </div>
                        </div>
                        @endif
                        @if($umkm->jam_buka)
                        <div class="contact-item">
                            <span style="font-size:1.25rem;">🕐</span>
                            <div>
                                <div style="font-size:0.7rem;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Jam Operasional</div>
                                <div style="font-weight:700;color:#111827;font-size:0.9375rem;">{{ $umkm->jam_buka }}</div>
                            </div>
                        </div>
                        @endif
                        @if($umkm->no_telepon)
                        <div class="contact-item" style="background:#f0fdf4;border-color:#dcfce7;">
                            <span style="font-size:1.25rem;">📱</span>
                            <div>
                                <div style="font-size:0.7rem;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">WhatsApp</div>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm->no_telepon) }}?text={{ urlencode($waMsg) }}" target="_blank"
                                   style="font-weight:700;color:#16a34a;font-size:0.9375rem;text-decoration:none;">{{ $umkm->no_telepon }}</a>
                            </div>
                        </div>
                        @endif
                        @if($umkm->instagram)
                        <div class="contact-item" style="background:#fdf2f8;border-color:#fce7f3;">
                            <span style="font-size:1.25rem;">📸</span>
                            <div>
                                <div style="font-size:0.7rem;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Instagram</div>
                                <div style="font-weight:700;color:#be185d;font-size:0.9375rem;">{{ $umkm->instagram }}</div>
                            </div>
                        </div>
                        @endif
                        @if($umkm->shopee)
                        <div class="contact-item" style="background:#fff7ed;border-color:#fed7aa;">
                            <span style="font-size:1.25rem;">🛒</span>
                            <div style="flex:1;min-width:0;">
                                <div style="font-size:0.7rem;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Toko Shopee</div>
                                <a href="{{ Str::startsWith($umkm->shopee, 'http') ? $umkm->shopee : 'https://shopee.co.id/'.$umkm->shopee }}"
                                   target="_blank"
                                   style="font-weight:700;color:#ea580c;font-size:0.875rem;text-decoration:none;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block;">
                                    {{ $umkm->shopee }}
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Lokasi --}}
                @if($umkm->latitude && $umkm->longitude)
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="icon-box" style="background:#eff6ff;">📍</div>
                        Lokasi
                        @if($umkm->lokasi_keterangan)
                        <span style="font-size:0.8rem;font-weight:400;color:#9ca3af;">— {{ $umkm->lokasi_keterangan }}</span>
                        @endif
                    </div>
                    <div id="map-detail" style="width:100%;"></div>
                    <div style="padding:1rem 1.5rem;border-top:1px solid #f3f4f6;display:flex;flex-direction:column;gap:0.75rem;">
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $umkm->latitude }},{{ $umkm->longitude }}"
                           target="_blank" rel="noopener"
                           style="display:inline-flex;align-items:center;justify-content:center;gap:7px;background:#2563eb;color:#fff;font-size:0.85rem;font-weight:700;padding:0.7rem 1rem;border-radius:0.625rem;text-decoration:none;transition:background 0.15s;"
                           onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">
                            <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Buka di Google Maps
                        </a>
                        <a href="{{ route('peta') }}"
                           style="display:inline-flex;align-items:center;gap:6px;font-size:0.8rem;font-weight:700;color:#2563eb;text-decoration:none;">
                            <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                            Lihat semua UMKM di peta →
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
                        <div class="icon-box" style="background:#fffbeb;">📲</div>
                        QR Code UMKM
                    </div>
                    <div class="info-card-body" style="text-align:center;">
                        <div style="display:inline-block;padding:1.25rem;background:#fff;border-radius:1rem;border:2px solid #fff7ed;box-shadow:0 4px 20px rgba(0,0,0,0.07);margin-bottom:1rem;">
                            <canvas data-qr-url="{{ route('umkm.show', $umkm) }}" style="display:block;border-radius:6px;"></canvas>
                        </div>
                        <p style="font-size:0.8rem;color:#9ca3af;margin:0 0 1.25rem;">Scan untuk halaman ini</p>
                        <div style="display:flex;flex-direction:column;gap:10px;">
                            <button
                                class="btn-download"
                                data-qr-download="{{ route('umkm.show', $umkm) }}"
                                data-qr-name="{{ Str::slug($umkm->nama_usaha) }}">
                                <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Download QR Code
                            </button>
                            @php
                                $waShareText = "🏪 *{$umkm->nama_usaha}*" .
                                    ($umkm->nama_pemilik ? "\nPemilik: {$umkm->nama_pemilik}" : '') .
                                    ($umkm->jenis_usaha ? " · {$umkm->jenis_usaha}" : '') .
                                    ($rwNum ? " · RW {$rwNum} Kelurahan Mojo 2" : '') .
                                    "\n\nLihat selengkapnya:\n" . route('umkm.show', $umkm) .
                                    "\n\n_dari *Website Kelurahan Mojo 2* 🏪_";
                                $waShareUrl = "https://wa.me/?text=" . rawurlencode($waShareText);
                            @endphp
                            <a href="{{ $waShareUrl }}" target="_blank" rel="noopener"
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

                {{-- Info singkat --}}
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="icon-box" style="background:#fffbeb;">🏪</div>
                        Identitas Usaha
                    </div>
                    <div class="info-card-body" style="display:flex;flex-direction:column;gap:0;">
                        <div class="info-row">
                            <span style="font-size:0.8rem;color:#9ca3af;font-weight:500;">Nama Usaha</span>
                            <span style="font-weight:700;font-size:0.875rem;color:#111827;text-align:right;max-width:60%;">{{ $umkm->nama_usaha }}</span>
                        </div>
                        @if($umkm->nama_pemilik)
                        <div class="info-row">
                            <span style="font-size:0.8rem;color:#9ca3af;font-weight:500;">Pemilik</span>
                            <span style="font-weight:600;font-size:0.875rem;color:#374151;">{{ $umkm->nama_pemilik }}</span>
                        </div>
                        @endif
                        @if($umkm->jenis_usaha)
                        <div class="info-row">
                            <span style="font-size:0.8rem;color:#9ca3af;font-weight:500;">Jenis</span>
                            <span style="display:inline-block;font-size:0.7rem;font-weight:700;background:#fff7ed;color:#c2410c;border:1px solid #fed7aa;padding:3px 10px;border-radius:9999px;">{{ $umkm->jenis_usaha }}</span>
                        </div>
                        @endif
                        @if($umkm->jam_buka)
                        <div class="info-row">
                            <span style="font-size:0.8rem;color:#9ca3af;font-weight:500;">Jam Buka</span>
                            <span style="font-weight:600;font-size:0.875rem;color:#374151;">{{ $umkm->jam_buka }}</span>
                        </div>
                        @endif
                        <div class="info-row">
                            <span style="font-size:0.8rem;color:#9ca3af;font-weight:500;">Wilayah</span>
                            <span style="font-size:0.8rem;font-weight:600;color:#374151;">RW 10 · Mojo 2</span>
                        </div>
                    </div>
                </div>

                {{-- Link profil RW --}}
                <a href="{{ route('rw.profile', 10) }}"
                   style="display:flex;align-items:center;gap:1rem;background:#fff;border:1px solid #f0f0f0;border-radius:1.25rem;padding:1.25rem 1.5rem;text-decoration:none;box-shadow:0 2px 12px rgba(0,0,0,0.05);transition:box-shadow 0.2s;"
                   onmouseover="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.10)'" onmouseout="this.style.boxShadow='0 2px 12px rgba(0,0,0,0.05)'">
                    <div style="width:2.75rem;height:2.75rem;border-radius:50%;background:linear-gradient(135deg,#fffbeb,#fde68a);border:2px solid #f59e0b;display:flex;align-items:center;justify-content:center;font-weight:900;font-size:1rem;color:#d97706;flex-shrink:0;">10</div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-weight:700;font-size:0.9rem;color:#111827;">RW 10 · Kelurahan Mojo 2</div>
                        <div style="font-size:0.75rem;color:#9ca3af;margin-top:2px;">Kota Surabaya · Jawa Timur</div>
                    </div>
                    <svg style="width:1rem;height:1rem;color:#9ca3af;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

            </div>
        </div>
    </div>
</div>

@push('scripts')
@if($umkm->latitude && $umkm->longitude)
@php
$popupHtml = '<strong>🏪 ' . $umkm->nama_usaha . '</strong>' .
    ($umkm->lokasi_keterangan ? '<br><small style="color:#666">' . $umkm->lokasi_keterangan . '</small>' : '');
@endphp
<script>
    const map = L.map('map-detail').setView([{{ $umkm->latitude }}, {{ $umkm->longitude }}], 17);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    const icon = L.divIcon({
        className: '',
        html: '<div style="width:36px;height:36px;background:#d97706;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,0.3);"></div>',
        iconSize: [36, 36], iconAnchor: [18, 36], popupAnchor: [0, -36],
    });
    L.marker([{{ $umkm->latitude }}, {{ $umkm->longitude }}], { icon })
        .addTo(map)
        .bindPopup(@json($popupHtml), { maxWidth: 220 })
        .openPopup();
</script>
@endif
<script>
    function shareUrl() {
        const url = '{{ route('umkm.show', $umkm) }}';
        if (navigator.share) {
            navigator.share({ title: '{{ $umkm->nama_usaha }} — UMKM RW 10 Mojo 2', url });
        } else {
            navigator.clipboard.writeText(url).then(() => alert('Link disalin!'));
        }
    }
</script>
@endpush

@endsection

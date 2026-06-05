@extends('layouts.app')
@section('title', $product->nama.' — '.$umkm->nama_usaha.' · RW 10')

@push('styles')
<style>
.prod-photo-hero {
    position: relative;
    height: 420px;
    overflow: hidden;
    background: linear-gradient(135deg, #431407, #7c2d12);
}
@media (max-width: 640px) { .prod-photo-hero { height: 280px; } }
.prod-photo-hero img { width: 100%; height: 100%; object-fit: cover; display: block; }
.prod-photo-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(67,20,7,0.88) 0%, rgba(67,20,7,0.35) 55%, rgba(0,0,0,0.12) 100%);
}
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
.detail-layout {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}
@media (min-width: 768px) {
    .detail-layout { grid-template-columns: 1fr 300px; }
}
.other-prod-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.875rem;
}
@media (min-width: 640px) {
    .other-prod-grid { grid-template-columns: repeat(3, 1fr); }
}
.other-prod-card {
    background: #fff;
    border-radius: 1rem;
    border: 1px solid #f0f0f0;
    overflow: hidden;
    text-decoration: none;
    display: block;
    transition: transform 0.2s, box-shadow 0.2s;
}
.other-prod-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.10); }
.btn-wa-lg {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    background: #22c55e; color: #fff; font-weight: 700; font-size: 0.9375rem;
    padding: 14px 20px; border-radius: 0.875rem; text-decoration: none;
    transition: background 0.2s, transform 0.15s;
    box-shadow: 0 4px 16px rgba(34,197,94,0.3);
}
.btn-wa-lg:hover { background: #16a34a; transform: translateY(-1px); }
.btn-shopee-lg {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    background: #f97316; color: #fff; font-weight: 700; font-size: 0.9375rem;
    padding: 14px 20px; border-radius: 0.875rem; text-decoration: none;
    transition: background 0.2s, transform 0.15s;
    box-shadow: 0 4px 16px rgba(249,115,22,0.3);
}
.btn-shopee-lg:hover { background: #ea580c; transform: translateY(-1px); }
</style>
@endpush

@section('content')

{{-- ═══ PHOTO HERO ═══ --}}
<div class="prod-photo-hero">
    @if($product->foto)
        <img src="{{ Storage::url($product->foto) }}" alt="{{ $product->nama }}">
    @elseif($umkm->foto)
        <img src="{{ Storage::url($umkm->foto) }}" alt="{{ $umkm->nama_usaha }}" style="opacity:0.6;">
    @else
        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:8rem;opacity:0.12;">🛍️</div>
    @endif
    <div class="prod-photo-overlay"></div>

    {{-- Back --}}
    <a href="{{ route('umkm.index') }}"
       style="position:absolute;top:1.25rem;left:1.25rem;display:flex;align-items:center;gap:6px;background:rgba(0,0,0,0.35);backdrop-filter:blur(8px);color:#fff;font-size:0.8rem;font-weight:600;padding:8px 16px;border-radius:9999px;text-decoration:none;border:1px solid rgba(255,255,255,0.15);"
       onmouseover="this.style.background='rgba(0,0,0,0.55)'" onmouseout="this.style.background='rgba(0,0,0,0.35)'">
        <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        Semua Produk
    </a>

    {{-- Product name --}}
    <div style="position:absolute;bottom:0;left:0;right:0;padding:2rem 2rem 1.75rem;">
        <div style="max-width:72rem;margin:0 auto;">
            @if($umkm->jenis_usaha)
            <span style="display:inline-flex;align-items:center;background:rgba(249,115,22,0.3);backdrop-filter:blur(8px);border:1px solid rgba(251,191,36,0.35);border-radius:9999px;padding:4px 12px;font-size:0.75rem;font-weight:700;color:#fef3c7;margin-bottom:0.75rem;letter-spacing:0.04em;">
                🏪 {{ $umkm->jenis_usaha }}
            </span>
            @endif
            <h1 style="font-size:clamp(2rem,5vw,3rem);font-weight:900;color:#fff;letter-spacing:-0.03em;line-height:1.05;margin:0 0 6px;">{{ $product->nama }}</h1>
            @if($product->harga)
            <div style="display:inline-flex;align-items:center;gap:6px;background:rgba(251,191,36,0.2);border:1px solid rgba(251,191,36,0.4);border-radius:9999px;padding:5px 14px;font-size:1rem;font-weight:800;color:#fcd34d;">
                {{ $product->harga }}
            </div>
            @endif
        </div>
    </div>
</div>

{{-- ═══ QUICK ACTION BAR ═══ --}}
@php
$waMsg = "Halo, saya melihat *{$umkm->nama_usaha}* di website RW 10 Kelurahan Mojo 2.\n\nSaya tertarik dengan produk: *{$product->nama}*" .
    ($product->harga ? " (harga: {$product->harga})" : '') .
    "\nApakah masih tersedia?";
@endphp
@if($umkm->no_telepon || $umkm->shopee)
<div style="background:#fff;border-bottom:1px solid #f0f0f0;padding:1rem 1.5rem;box-shadow:0 2px 12px rgba(0,0,0,0.05);">
    <div style="max-width:72rem;margin:0 auto;display:flex;gap:12px;flex-wrap:wrap;align-items:center;">
        @if($umkm->no_telepon)
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm->no_telepon) }}?text={{ urlencode($waMsg) }}"
           target="_blank" class="btn-wa-lg" style="flex:1;min-width:140px;">
            <svg style="width:1.125rem;height:1.125rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Pesan via WhatsApp
        </a>
        @endif
        @if($umkm->shopee)
        <a href="{{ Str::startsWith($umkm->shopee, 'http') ? $umkm->shopee : 'https://shopee.co.id/'.$umkm->shopee }}"
           target="_blank" class="btn-shopee-lg" style="flex:1;min-width:140px;">
            🛒 Beli di Shopee
        </a>
        @endif
        <button onclick="shareUrl()"
            style="width:48px;height:48px;background:#f8fafc;border:1.5px solid #e5e7eb;border-radius:0.875rem;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;"
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

                {{-- Deskripsi Produk --}}
                @if($product->deskripsi)
                <div class="info-card">
                    <div class="info-card-header">
                        <div style="width:2rem;height:2rem;border-radius:0.625rem;background:#fff7ed;display:flex;align-items:center;justify-content:center;font-size:1rem;">📦</div>
                        Tentang Produk
                    </div>
                    <div class="info-card-body">
                        <p style="color:#4b5563;line-height:1.9;font-size:0.9375rem;margin:0;white-space:pre-line;">{{ $product->deskripsi }}</p>
                    </div>
                </div>
                @endif

                {{-- Harga --}}
                @if($product->harga)
                <div class="info-card">
                    <div class="info-card-header">
                        <div style="width:2rem;height:2rem;border-radius:0.625rem;background:#fffbeb;display:flex;align-items:center;justify-content:center;font-size:1rem;">💰</div>
                        Harga
                    </div>
                    <div class="info-card-body">
                        <div style="font-size:2rem;font-weight:900;color:#d97706;">{{ $product->harga }}</div>
                        <p style="font-size:0.8rem;color:#9ca3af;margin:6px 0 0;">Hubungi penjual untuk konfirmasi ketersediaan</p>
                    </div>
                </div>
                @endif

                {{-- Produk lain dari bisnis ini --}}
                @php $otherProducts = $umkm->products->where('id', '!=', $product->id); @endphp
                @if($otherProducts->count())
                <div class="info-card">
                    <div class="info-card-header">
                        <div style="width:2rem;height:2rem;border-radius:0.625rem;background:#fff7ed;display:flex;align-items:center;justify-content:center;font-size:1rem;">🛍️</div>
                        Produk Lain dari {{ $umkm->nama_usaha }}
                    </div>
                    <div class="info-card-body">
                        <div class="other-prod-grid">
                            @foreach($otherProducts as $op)
                            <a href="{{ route('umkm.produk.show', [$umkm, $op]) }}" class="other-prod-card">
                                @if($op->foto)
                                    <img src="{{ Storage::url($op->foto) }}" alt="{{ $op->nama }}" style="width:100%;height:100px;object-fit:cover;display:block;">
                                @elseif($umkm->foto)
                                    <img src="{{ Storage::url($umkm->foto) }}" alt="{{ $op->nama }}" style="width:100%;height:100px;object-fit:cover;display:block;opacity:0.6;">
                                @else
                                    <div style="width:100%;height:100px;background:linear-gradient(135deg,#431407,#c2410c);display:flex;align-items:center;justify-content:center;font-size:2rem;">🛍️</div>
                                @endif
                                <div style="padding:0.625rem 0.75rem;">
                                    <div style="font-weight:700;font-size:0.8125rem;color:#111827;line-height:1.3;">{{ $op->nama }}</div>
                                    @if($op->harga)
                                    <div style="font-size:0.75rem;font-weight:700;color:#d97706;margin-top:2px;">{{ $op->harga }}</div>
                                    @endif
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

            </div>

            {{-- ── RIGHT SIDEBAR ── --}}
            <div style="display:flex;flex-direction:column;gap:1.5rem;">

                {{-- Profil Bisnis --}}
                <div class="info-card">
                    <div class="info-card-header">
                        <div style="width:2rem;height:2rem;border-radius:0.625rem;background:#fff7ed;display:flex;align-items:center;justify-content:center;font-size:1rem;">🏪</div>
                        Tentang Penjual
                    </div>
                    <div class="info-card-body">
                        {{-- Foto usaha --}}
                        @if($umkm->foto)
                        <img src="{{ Storage::url($umkm->foto) }}" alt="{{ $umkm->nama_usaha }}"
                             style="width:100%;height:120px;object-fit:cover;border-radius:0.875rem;margin-bottom:1rem;display:block;">
                        @endif

                        <div style="font-weight:800;font-size:1rem;color:#111827;margin-bottom:4px;">{{ $umkm->nama_usaha }}</div>
                        @if($umkm->nama_pemilik)
                        <div style="font-size:0.8rem;color:#9ca3af;margin-bottom:10px;">oleh {{ $umkm->nama_pemilik }}</div>
                        @endif
                        @if($umkm->jenis_usaha)
                        <span style="display:inline-block;font-size:0.7rem;font-weight:700;background:#fff7ed;color:#c2410c;border:1px solid #fed7aa;padding:3px 10px;border-radius:9999px;margin-bottom:12px;">{{ $umkm->jenis_usaha }}</span>
                        @endif

                        @if($umkm->jam_buka)
                        <div style="display:flex;align-items:center;gap:6px;font-size:0.8rem;color:#6b7280;margin-bottom:8px;">
                            <span>🕐</span> {{ $umkm->jam_buka }}
                        </div>
                        @endif
                        @if($umkm->deskripsi)
                        <p style="font-size:0.8125rem;color:#6b7280;line-height:1.6;margin:8px 0 12px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ $umkm->deskripsi }}</p>
                        @endif

                        <a href="{{ route('umkm.show', $umkm) }}"
                           style="display:flex;align-items:center;justify-content:center;gap:6px;background:#f8fafc;border:1.5px solid #e5e7eb;color:#374151;font-weight:700;font-size:0.8rem;padding:10px;border-radius:0.75rem;text-decoration:none;transition:background 0.2s;"
                           onmouseover="this.style.background='#f0f0f0'" onmouseout="this.style.background='#f8fafc'">
                            Lihat Profil Lengkap Bisnis →
                        </a>
                    </div>
                </div>

                {{-- Kontak --}}
                @if($umkm->no_telepon || $umkm->instagram || $umkm->shopee)
                <div class="info-card">
                    <div class="info-card-header">
                        <div style="width:2rem;height:2rem;border-radius:0.625rem;background:#f0faf4;display:flex;align-items:center;justify-content:center;font-size:1rem;">📞</div>
                        Kontak Penjual
                    </div>
                    <div class="info-card-body" style="display:flex;flex-direction:column;gap:8px;">
                        @if($umkm->no_telepon)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm->no_telepon) }}?text={{ urlencode($waMsg) }}"
                           target="_blank"
                           style="display:flex;align-items:center;gap:10px;padding:10px;border-radius:0.875rem;background:#f0fdf4;border:1px solid #dcfce7;text-decoration:none;">
                            <span style="font-size:1.25rem;">📱</span>
                            <div>
                                <div style="font-size:0.7rem;color:#9ca3af;font-weight:600;text-transform:uppercase;">WhatsApp</div>
                                <div style="font-weight:700;color:#16a34a;font-size:0.875rem;">{{ $umkm->no_telepon }}</div>
                            </div>
                        </a>
                        @endif
                        @if($umkm->instagram)
                        <div style="display:flex;align-items:center;gap:10px;padding:10px;border-radius:0.875rem;background:#fdf2f8;border:1px solid #fce7f3;">
                            <span style="font-size:1.25rem;">📸</span>
                            <div>
                                <div style="font-size:0.7rem;color:#9ca3af;font-weight:600;text-transform:uppercase;">Instagram</div>
                                <div style="font-weight:700;color:#be185d;font-size:0.875rem;">@{{ $umkm->instagram }}</div>
                            </div>
                        </div>
                        @endif
                        @if($umkm->shopee)
                        <a href="{{ Str::startsWith($umkm->shopee, 'http') ? $umkm->shopee : 'https://shopee.co.id/'.$umkm->shopee }}"
                           target="_blank"
                           style="display:flex;align-items:center;gap:10px;padding:10px;border-radius:0.875rem;background:#fff7ed;border:1px solid #fed7aa;text-decoration:none;">
                            <span style="font-size:1.25rem;">🛒</span>
                            <div style="flex:1;min-width:0;">
                                <div style="font-size:0.7rem;color:#9ca3af;font-weight:600;text-transform:uppercase;">Shopee</div>
                                <div style="font-weight:700;color:#ea580c;font-size:0.8rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $umkm->shopee }}</div>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function shareUrl() {
    const url = '{{ route('umkm.produk.show', [$umkm, $product]) }}';
    if (navigator.share) {
        navigator.share({ title: '{{ $product->nama }} — {{ $umkm->nama_usaha }}', url });
    } else {
        navigator.clipboard.writeText(url).then(() => alert('Link disalin!'));
    }
}
</script>
@endpush

@endsection

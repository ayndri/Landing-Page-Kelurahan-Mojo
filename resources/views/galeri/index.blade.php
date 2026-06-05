@extends('layouts.app')
@section('title', 'Galeri Foto — Kelurahan Mojo 2')

@push('styles')
<style>
    .galeri-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 1rem;
    }
    .galeri-item {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        cursor: pointer;
        background: #111;
        aspect-ratio: 4/3;
    }
    .galeri-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.35s ease, opacity 0.35s ease;
    }
    .galeri-item:hover img { transform: scale(1.06); opacity: 0.75; }
    .galeri-item .overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 55%);
        opacity: 0;
        transition: opacity 0.35s;
        display: flex;
        align-items: flex-end;
        padding: 14px;
    }
    .galeri-item:hover .overlay { opacity: 1; }
    .galeri-item .overlay span {
        color: #fff;
        font-size: 0.82rem;
        font-weight: 600;
        line-height: 1.3;
    }
    /* Lightbox */
    #lightbox {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(0,0,0,0.92);
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    #lightbox.open { display: flex; }
    #lightbox img {
        max-width: 90vw;
        max-height: 85vh;
        border-radius: 8px;
        object-fit: contain;
        box-shadow: 0 0 60px rgba(0,0,0,0.6);
    }
    #lightbox-close {
        position: absolute;
        top: 20px;
        right: 24px;
        color: #fff;
        font-size: 2rem;
        cursor: pointer;
        line-height: 1;
        background: none;
        border: none;
    }
    #lightbox-caption {
        position: absolute;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%);
        color: #e5e7eb;
        font-size: 0.875rem;
        text-align: center;
        max-width: 600px;
    }
</style>
@endpush

@section('content')
{{-- Hero --}}
<section style="background: linear-gradient(135deg, #2d6a4f 0%, #40916c 100%);" class="py-14 px-4">
    <div class="max-w-4xl mx-auto text-center text-white">
        <h1 class="text-3xl font-bold mb-2">Galeri Foto</h1>
        <p class="text-green-200 text-sm">Dokumentasi kegiatan warga Kelurahan Mojo 2</p>
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 py-10">
    {{-- Filter kategori --}}
    @if(count($kategoris) > 0)
    <div class="flex flex-wrap gap-2 mb-8">
        <button onclick="filterGaleri('semua')" data-filter="semua"
                class="filter-btn px-4 py-1.5 rounded-full text-sm font-medium border border-[#2d6a4f] text-[#2d6a4f] active">
            Semua
        </button>
        @foreach($kategoris as $kat)
        <button onclick="filterGaleri('{{ $kat }}')" data-filter="{{ $kat }}"
                class="filter-btn px-4 py-1.5 rounded-full text-sm font-medium border border-gray-300 text-gray-600 hover:border-[#2d6a4f] hover:text-[#2d6a4f] transition">
            {{ $kat }}
        </button>
        @endforeach
    </div>
    @endif

    @if($galeris->count())
    <div class="galeri-grid" id="galeri-grid">
        @foreach($galeris as $g)
        <div class="galeri-item" data-kategori="{{ $g->kategori }}"
             onclick="openLightbox('{{ Storage::url($g->foto) }}', '{{ addslashes($g->judul ?: '') }}', '{{ addslashes($g->keterangan ?: '') }}')">
            <img src="{{ Storage::url($g->foto) }}" alt="{{ $g->judul }}" loading="lazy">
            @if($g->kategori)
            <span style="position:absolute;top:10px;left:10px;background:rgba(0,0,0,0.55);color:#fff;font-size:0.6rem;font-weight:700;padding:2px 8px;border-radius:9999px;">{{ $g->kategori }}</span>
            @endif
            <div class="overlay">
                <span>{{ $g->judul ?: $g->kategori }}</span>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-24 text-gray-400">
        <div class="text-5xl mb-4">🖼️</div>
        <p class="font-medium">Belum ada foto tersedia.</p>
    </div>
    @endif
</section>

{{-- Lightbox --}}
<div id="lightbox">
    <button id="lightbox-close" onclick="closeLightbox()">&times;</button>
    <img id="lightbox-img" src="" alt="">
    <div id="lightbox-caption"></div>
</div>

@push('scripts')
<script>
    function openLightbox(src, judul, ket) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-img').alt = judul;
        const cap = judul + (ket ? ' — ' + ket : '');
        document.getElementById('lightbox-caption').textContent = cap || '';
        document.getElementById('lightbox').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });

    function filterGaleri(kategori) {
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.filter === kategori);
            btn.style.background = btn.dataset.filter === kategori ? '#2d6a4f' : '';
            btn.style.color = btn.dataset.filter === kategori ? '#fff' : '';
        });
        document.querySelectorAll('.galeri-item').forEach(item => {
            item.style.display = (kategori === 'semua' || item.dataset.kategori === kategori) ? '' : 'none';
        });
    }
    // Init active button style
    document.querySelector('[data-filter="semua"]').style.background = '#2d6a4f';
    document.querySelector('[data-filter="semua"]').style.color = '#fff';
</script>
@endpush
@endsection

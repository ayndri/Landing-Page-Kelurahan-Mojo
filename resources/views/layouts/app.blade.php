<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('favicon-32.png') }}" type="image/png" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <meta name="theme-color" content="#2d6a4f">
    <title>@yield('title', 'Kelurahan Mojo 2')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-[#2d6a4f] shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <span class="text-[#2d6a4f] font-bold text-sm">K2</span>
                    </div>
                    <div class="text-white">
                        <div class="font-bold text-sm leading-tight">Kelurahan Mojo 2</div>
                        <div class="text-xs text-green-200">Kota Surabaya</div>
                    </div>
                </a>

                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="text-white hover:bg-[#40916c] px-3 py-2 rounded-lg text-sm font-medium transition">Beranda</a>
                    <a href="{{ route('pengumuman.index') }}" class="text-green-200 hover:text-white hover:bg-[#40916c] px-3 py-2 rounded-lg text-sm font-medium transition">Pengumuman</a>
                    <a href="{{ route('agenda.index') }}" class="text-green-200 hover:text-white hover:bg-[#40916c] px-3 py-2 rounded-lg text-sm font-medium transition">Agenda</a>
                    <a href="{{ route('galeri.index') }}" class="text-green-200 hover:text-white hover:bg-[#40916c] px-3 py-2 rounded-lg text-sm font-medium transition">Galeri</a>
                    <a href="{{ route('kontak.index') }}" class="text-green-200 hover:text-white hover:bg-[#40916c] px-3 py-2 rounded-lg text-sm font-medium transition">Kontak</a>
                </div>

                {{-- Mobile menu button --}}
                <button id="nav-toggle" class="md:hidden text-white p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div id="nav-mobile" class="hidden md:hidden border-t border-green-700 pb-3 px-4">
            <a href="{{ route('home') }}" class="block text-white py-2 text-sm font-medium">Beranda</a>
            <a href="{{ route('pengumuman.index') }}" class="block text-green-200 py-2 text-sm">Pengumuman</a>
            <a href="{{ route('agenda.index') }}" class="block text-green-200 py-2 text-sm">Agenda</a>
            <a href="{{ route('galeri.index') }}" class="block text-green-200 py-2 text-sm">Galeri</a>
            <a href="{{ route('kontak.index') }}" class="block text-green-200 py-2 text-sm">Kontak</a>
        </div>
    </nav>

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer style="background:#1a3d2b;" class="text-white">
        <div class="max-w-6xl mx-auto px-4 py-12">
            <div class="flex flex-col md:flex-row md:items-start gap-10">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 bg-white rounded-full flex items-center justify-center">
                            <span class="text-[#2d6a4f] font-bold text-xs">K2</span>
                        </div>
                        <h3 class="font-bold text-lg">Kelurahan Mojo 2</h3>
                    </div>
                    <p class="text-green-300/70 text-sm leading-relaxed max-w-xs">Portal resmi warga RW 9, 10, 11, 12, dan 13 Kelurahan Mojo 2, Kota Surabaya.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-green-200/60 text-xs uppercase tracking-widest mb-3">Direktori</h4>
                    <div class="space-y-1.5">
                        @foreach([9, 10, 11, 12, 13] as $rw)
                            <a href="{{ route('rw.profile', $rw) }}" class="block text-green-200 text-sm hover:text-white transition">RW {{ $rw }}</a>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-green-200/60 text-xs uppercase tracking-widest mb-3">Potensi Warga</h4>
                    <div class="space-y-1.5">
                        <a href="{{ route('tanaman.index') }}" class="block text-green-200 text-sm hover:text-white transition">Tanaman</a>
                        <a href="{{ route('umkm.index') }}" class="block text-green-200 text-sm hover:text-white transition">UMKM</a>
                        <a href="{{ route('peta') }}" class="block text-green-200 text-sm hover:text-white transition">Peta Interaktif</a>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-green-200/60 text-xs uppercase tracking-widest mb-3">Info</h4>
                    <div class="space-y-1.5">
                        <a href="{{ route('pengumuman.index') }}" class="block text-green-200 text-sm hover:text-white transition">Pengumuman</a>
                        <a href="{{ route('agenda.index') }}" class="block text-green-200 text-sm hover:text-white transition">Agenda Kegiatan</a>
                        <a href="{{ route('galeri.index') }}" class="block text-green-200 text-sm hover:text-white transition">Galeri Foto</a>
                        <a href="{{ route('kontak.index') }}" class="block text-green-200 text-sm hover:text-white transition">Kontak & Layanan</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-green-800 mt-10 pt-6 text-center text-green-400/60 text-xs">
                &copy; {{ date('Y') }} Kelurahan Mojo 2 · Kota Surabaya
            </div>
        </div>
    </footer>

    {{-- Modal QR Scanner --}}
    <div id="qr-scanner-modal" class="hidden fixed inset-0 z-[9999] bg-black/80 backdrop-blur-sm flex items-center justify-center px-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden">
            {{-- Header --}}
            <div class="bg-[#2d6a4f] px-5 py-4 flex items-center justify-between">
                <div class="flex items-center gap-2 text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                    <span class="font-bold text-sm">Scan QR Code</span>
                </div>
                <button onclick="closeQrScanner()" class="text-white/70 hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Video area --}}
            <div class="relative bg-black" style="aspect-ratio:1">
                <video id="qr-video" class="w-full h-full object-cover" muted playsinline></video>
                <canvas id="qr-canvas" class="hidden"></canvas>

                {{-- Viewfinder overlay --}}
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <div class="relative w-52 h-52">
                        {{-- Sudut-sudut --}}
                        <div class="absolute top-0 left-0 w-8 h-8 border-t-4 border-l-4 border-white rounded-tl-lg"></div>
                        <div class="absolute top-0 right-0 w-8 h-8 border-t-4 border-r-4 border-white rounded-tr-lg"></div>
                        <div class="absolute bottom-0 left-0 w-8 h-8 border-b-4 border-l-4 border-white rounded-bl-lg"></div>
                        <div class="absolute bottom-0 right-0 w-8 h-8 border-b-4 border-r-4 border-white rounded-br-lg"></div>
                        {{-- Scan line animasi --}}
                        <div class="absolute left-2 right-2 h-0.5 bg-[#74c69d] shadow-lg" style="animation: scanline 2s linear infinite; top: 0"></div>
                    </div>
                </div>
            </div>

            {{-- Status & result --}}
            <div class="p-5">
                <p id="scanner-status" class="text-center text-gray-500 text-sm mb-3">Memulai kamera...</p>

                <div id="scanner-result" class="hidden">
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-3">
                        <p class="text-green-700 text-xs font-semibold mb-1">Berhasil dibaca! Mengalihkan...</p>
                        <a id="scanner-link" href="#" class="text-green-600 text-xs break-all hover:underline"></a>
                    </div>
                    <button id="scanner-retry" class="w-full border border-gray-200 text-gray-600 text-sm py-2.5 rounded-xl hover:bg-gray-50 transition">
                        Scan Lagi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes scanline {
            0% { top: 4px; }
            50% { top: calc(100% - 4px); }
            100% { top: 4px; }
        }

        /* ── SCROLL REVEAL ── */
        .will-reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.55s cubic-bezier(.4,0,.2,1), transform 0.55s cubic-bezier(.4,0,.2,1);
        }
        .will-reveal.is-revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── BACK TO TOP ── */
        #back-to-top {
            position: fixed;
            bottom: 1.75rem;
            right: 1.5rem;
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 50%;
            background: #2d6a4f;
            color: #fff;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(45,106,79,0.45);
            opacity: 0;
            transform: translateY(10px) scale(0.88);
            pointer-events: none;
            transition: opacity 0.25s, transform 0.25s;
            z-index: 998;
        }
        #back-to-top.show {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }
        #back-to-top:hover {
            background: #40916c;
            transform: translateY(-3px) scale(1.06) !important;
            box-shadow: 0 8px 24px rgba(45,106,79,0.5);
        }
    </style>

    {{-- Back to top button --}}
    <button id="back-to-top" title="Kembali ke atas">
        <svg style="width:1.125rem;height:1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
        </svg>
    </button>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.getElementById('nav-toggle').addEventListener('click', () => {
            document.getElementById('nav-mobile').classList.toggle('hidden');
        });

        // ── BACK TO TOP ──
        (function () {
            const btn = document.getElementById('back-to-top');
            window.addEventListener('scroll', () => {
                btn.classList.toggle('show', window.scrollY > 380);
            }, { passive: true });
            btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
        })();

        // ── SCROLL REVEAL ──
        (function () {
            const vh = window.innerHeight;
            const targets = document.querySelectorAll('section');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.07 });

            targets.forEach(el => {
                const top = el.getBoundingClientRect().top;
                if (top > vh * 0.85) {
                    el.classList.add('will-reveal');
                    observer.observe(el);
                }
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>

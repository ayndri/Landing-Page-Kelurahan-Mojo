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
    <title>@yield('title', 'RW 10 Mojo 2')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800" style="font-family:'Plus Jakarta Sans',sans-serif">

    {{-- RW 10 Standalone Navbar --}}
    <nav class="bg-[#0c0a09] border-b border-stone-800/60 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">

                {{-- Brand --}}
                <a href="{{ route('rw.profile', 10) }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-amber-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow shadow-amber-500/30">
                        <span class="text-white font-extrabold text-base leading-none">10</span>
                    </div>
                    <div>
                        <div class="text-white font-bold text-sm leading-tight">RW 10</div>
                        <div class="text-stone-500 text-xs">Mojo 2 · Surabaya</div>
                    </div>
                </a>

                {{-- Desktop nav --}}
                <div class="hidden md:flex items-center gap-0.5">
                    @php
                        $path = request()->path();
                    @endphp
                    <a href="{{ route('rw.profile', 10) }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium transition {{ $path === 'rw/10' ? 'text-white bg-stone-800' : 'text-stone-400 hover:text-white hover:bg-stone-800/60' }}">
                        Profil
                    </a>
                    <a href="{{ route('tanaman.index') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium transition flex items-center gap-1.5 {{ str_starts_with($path, 'tanaman') ? 'text-white bg-stone-800' : 'text-stone-400 hover:text-white hover:bg-stone-800/60' }}">
                        🌿 Tanaman
                    </a>
                    <a href="{{ route('umkm.index') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium transition flex items-center gap-1.5 {{ str_starts_with($path, 'umkm') ? 'text-white bg-stone-800' : 'text-stone-400 hover:text-white hover:bg-stone-800/60' }}">
                        🏪 UMKM
                    </a>
                    <a href="{{ route('peta') }}"
                       class="px-3 py-2 rounded-lg text-sm font-medium transition flex items-center gap-1.5 {{ $path === 'peta' ? 'text-white bg-stone-800' : 'text-stone-400 hover:text-white hover:bg-stone-800/60' }}">
                        🗺️ Peta
                    </a>
                    <div class="w-px h-5 bg-stone-800 mx-2"></div>
                    <a href="{{ route('home') }}"
                       class="text-stone-600 hover:text-stone-400 text-xs px-2 py-1 transition flex items-center gap-1.5">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kelurahan
                    </a>
                </div>

                {{-- Mobile toggle --}}
                <button id="rw10-nav-toggle" class="md:hidden text-stone-400 p-2 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div id="rw10-nav-mobile" class="hidden md:hidden border-t border-stone-800 pb-3 px-4">
            <a href="{{ route('rw.profile', 10) }}" class="block text-stone-300 py-2 text-sm">Profil RW 10</a>
            <a href="{{ route('tanaman.index') }}" class="block text-stone-300 py-2 text-sm">🌿 Tanaman</a>
            <a href="{{ route('umkm.index') }}" class="block text-stone-300 py-2 text-sm">🏪 UMKM</a>
            <a href="{{ route('peta') }}" class="block text-stone-300 py-2 text-sm">🗺️ Peta</a>
            <div class="border-t border-stone-800 mt-2 pt-2">
                <a href="{{ route('home') }}" class="block text-stone-600 py-1.5 text-xs">← Kelurahan Mojo 2</a>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer RW 10 --}}
    <footer class="bg-[#0c0a09] text-white mt-16 border-t border-stone-800/60">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 bg-amber-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-extrabold text-sm">10</span>
                        </div>
                        <h3 class="font-bold text-lg">RW 10 Mojo 2</h3>
                    </div>
                    <p class="text-stone-500 text-sm leading-relaxed">Rukun Warga 10 Kelurahan Mojo 2, Kota Surabaya — potensi tanaman dan UMKM lokal.</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-3 text-stone-400 text-sm uppercase tracking-wider">Menu RW 10</h3>
                    <div class="space-y-1.5">
                        <a href="{{ route('rw.profile', 10) }}" class="block text-stone-500 text-sm hover:text-amber-400 transition">Profil</a>
                        <a href="{{ route('tanaman.index') }}" class="block text-stone-500 text-sm hover:text-amber-400 transition">Tanaman</a>
                        <a href="{{ route('umkm.index') }}" class="block text-stone-500 text-sm hover:text-amber-400 transition">UMKM</a>
                        <a href="{{ route('peta') }}" class="block text-stone-500 text-sm hover:text-amber-400 transition">Peta Interaktif</a>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold mb-3 text-stone-400 text-sm uppercase tracking-wider">Kelurahan Mojo 2</h3>
                    <div class="space-y-1.5">
                        @foreach([9, 10, 11, 12, 13] as $r)
                        <a href="{{ route('rw.profile', $r) }}" class="block text-stone-500 text-sm hover:text-white transition {{ $r == 10 ? 'text-stone-400' : '' }}">
                            RW {{ $r }}{{ $r == 10 ? ' (halaman ini)' : '' }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="border-t border-stone-800 mt-8 pt-6 flex flex-col sm:flex-row items-center justify-between gap-2">
                <p class="text-stone-600 text-sm">&copy; {{ date('Y') }} RW 10 · Kelurahan Mojo 2 · Kota Surabaya</p>
                <a href="{{ route('home') }}" class="text-stone-600 hover:text-stone-400 text-xs transition">← Kembali ke Kelurahan Mojo 2</a>
            </div>
        </div>
    </footer>

    {{-- Modal QR Scanner --}}
    <div id="qr-scanner-modal" class="hidden fixed inset-0 z-[9999] bg-black/80 backdrop-blur-sm flex items-center justify-center px-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden">
            <div class="bg-[#1c1917] px-5 py-4 flex items-center justify-between">
                <div class="flex items-center gap-2 text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                    <span class="font-bold text-sm">Scan QR Code</span>
                </div>
                <button onclick="closeQrScanner()" class="text-white/70 hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="relative bg-black" style="aspect-ratio:1">
                <video id="qr-video" class="w-full h-full object-cover" muted playsinline></video>
                <canvas id="qr-canvas" class="hidden"></canvas>
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <div class="relative w-52 h-52">
                        <div class="absolute top-0 left-0 w-8 h-8 border-t-4 border-l-4 border-amber-400 rounded-tl-lg"></div>
                        <div class="absolute top-0 right-0 w-8 h-8 border-t-4 border-r-4 border-amber-400 rounded-tr-lg"></div>
                        <div class="absolute bottom-0 left-0 w-8 h-8 border-b-4 border-l-4 border-amber-400 rounded-bl-lg"></div>
                        <div class="absolute bottom-0 right-0 w-8 h-8 border-b-4 border-r-4 border-amber-400 rounded-br-lg"></div>
                        <div class="absolute left-2 right-2 h-0.5 bg-amber-400 shadow-lg" style="animation: scanline 2s linear infinite; top: 0"></div>
                    </div>
                </div>
            </div>

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
    </style>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.getElementById('rw10-nav-toggle').addEventListener('click', () => {
            document.getElementById('rw10-nav-mobile').classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>

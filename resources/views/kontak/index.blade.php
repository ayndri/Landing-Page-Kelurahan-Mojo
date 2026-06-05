@extends('layouts.app')
@section('title', 'Kontak & Layanan — Kelurahan Mojo 2')

@section('content')
{{-- Hero --}}
<section style="background: linear-gradient(135deg, #2d6a4f 0%, #40916c 100%);" class="py-14 px-4">
    <div class="max-w-4xl mx-auto text-center text-white">
        <h1 class="text-3xl font-bold mb-2">Kontak & Layanan</h1>
        <p class="text-green-200 text-sm">Informasi kontak dan layanan administrasi Kelurahan Mojo 2</p>
    </div>
</section>

<section class="max-w-5xl mx-auto px-4 py-10">
    <div class="grid md:grid-cols-2 gap-8">

        {{-- Info Kontak --}}
        <div>
            <h2 class="text-lg font-bold text-gray-800 mb-5">Informasi Kantor</h2>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 divide-y divide-gray-100">
                <div class="flex items-start gap-4 p-5">
                    <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-[#2d6a4f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-1">Alamat</div>
                        <div class="text-sm text-gray-700 leading-relaxed">Jl. Mojo No. 1, Kelurahan Mojo<br>Kecamatan Gubeng, Kota Surabaya<br>Jawa Timur 60285</div>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-5">
                    <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-[#2d6a4f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-1">Jam Operasional</div>
                        <div class="text-sm text-gray-700 space-y-0.5">
                            <div class="flex justify-between gap-6"><span>Senin – Kamis</span><span class="font-medium">07.30 – 16.00 WIB</span></div>
                            <div class="flex justify-between gap-6"><span>Jumat</span><span class="font-medium">07.30 – 11.00 WIB</span></div>
                            <div class="flex justify-between gap-6"><span>Sabtu – Minggu</span><span class="font-medium text-red-500">Tutup</span></div>
                        </div>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-5">
                    <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-[#2d6a4f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-1">Telepon</div>
                        <div class="text-sm text-gray-700">(031) 5021234</div>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-5">
                    <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-[#2d6a4f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-1">Email</div>
                        <div class="text-sm text-gray-700">kel.mojo2@surabaya.go.id</div>
                    </div>
                </div>
            </div>

            {{-- RW Contacts --}}
            <h2 class="text-lg font-bold text-gray-800 mt-8 mb-5">Kontak Ketua RW</h2>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 divide-y divide-gray-100">
                @foreach([9,10,11,12,13] as $rw)
                <a href="{{ route('rw.profile', $rw) }}" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-[#2d6a4f] text-white rounded-full flex items-center justify-center text-xs font-bold">{{ $rw }}</div>
                        <span class="text-sm font-medium text-gray-700">RW {{ $rw }}</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Layanan Administrasi --}}
        <div>
            <h2 class="text-lg font-bold text-gray-800 mb-5">Layanan Administrasi</h2>
            <p class="text-sm text-gray-500 mb-5">Bawa dokumen pendukung yang diperlukan. Layanan gratis tanpa biaya.</p>

            @php
            $layanan = [
                ['nama' => 'Surat Keterangan Domisili', 'syarat' => 'KTP, KK', 'waktu' => '1 hari'],
                ['nama' => 'Surat Keterangan Tidak Mampu (SKTM)', 'syarat' => 'KTP, KK, surat pengantar RT', 'waktu' => '1–2 hari'],
                ['nama' => 'Surat Pengantar Nikah', 'syarat' => 'KTP, KK, akta lahir, pas foto', 'waktu' => '2 hari'],
                ['nama' => 'Surat Keterangan Usaha (SKU)', 'syarat' => 'KTP, KK, foto tempat usaha', 'waktu' => '2 hari'],
                ['nama' => 'Surat Keterangan Kelahiran', 'syarat' => 'KTP orang tua, KK, surat keterangan lahir RS/bidan', 'waktu' => '1 hari'],
                ['nama' => 'Surat Keterangan Kematian', 'syarat' => 'KTP almarhum, KK, surat keterangan RS/puskesmas', 'waktu' => '1 hari'],
                ['nama' => 'Pengantar Pembuatan KTP/KK', 'syarat' => 'Dokumen sesuai perubahan yang diperlukan', 'waktu' => '1 hari'],
                ['nama' => 'Surat Keterangan Pindah', 'syarat' => 'KTP, KK, surat pengantar RT', 'waktu' => '2 hari'],
            ];
            @endphp

            <div class="space-y-3">
                @foreach($layanan as $l)
                <div class="bg-white rounded-xl border border-gray-100 p-4">
                    <div class="font-semibold text-gray-800 text-sm mb-2">{{ $l['nama'] }}</div>
                    <div class="text-xs text-gray-500 space-y-1">
                        <div class="flex gap-2">
                            <span class="text-gray-400 min-w-[52px]">Syarat:</span>
                            <span>{{ $l['syarat'] }}</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="text-gray-400 min-w-[52px]">Proses:</span>
                            <span class="text-[#2d6a4f] font-medium">{{ $l['waktu'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-5 bg-green-50 border border-green-200 rounded-xl p-4 text-xs text-green-700 leading-relaxed">
                <strong>Catatan:</strong> Pastikan dokumen sudah ditandatangani oleh RT setempat sebelum datang ke kantor kelurahan. Untuk informasi lebih lanjut hubungi kami melalui telepon atau datang langsung.
            </div>
        </div>

    </div>
</section>
@endsection

<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['judul' => 'Kerja Bakti Bersih Lingkungan',       'kategori' => 'Kegiatan',    'urutan' => 1,  'keterangan' => 'Warga RW 10 bersatu padu membersihkan selokan dan jalan kampung setiap Minggu pagi.'],
            ['judul' => 'Pameran Tanaman Toga RW 10',           'kategori' => 'Lingkungan',  'urutan' => 2,  'keterangan' => 'Pameran tanaman obat keluarga hasil budidaya warga RW 10 yang dipajang di depan balai RW.'],
            ['judul' => 'Posyandu Balita Rutin',                'kategori' => 'Kegiatan',    'urutan' => 3,  'keterangan' => 'Kader posyandu melayani penimbangan dan imunisasi balita setiap bulan.'],
            ['judul' => 'Rapat Pengurus RW',                    'kategori' => 'Rapat',       'urutan' => 4,  'keterangan' => 'Rapat koordinasi bulanan seluruh pengurus RT dan RW untuk membahas program kerja.'],
            ['judul' => 'Bazar UMKM Warga Mojo 2',              'kategori' => 'Kegiatan',    'urutan' => 5,  'keterangan' => 'Warga memamerkan dan menjual produk UMKM lokal dalam bazar tahunan kelurahan.'],
            ['judul' => 'Senam Pagi Bersama Warga',             'kategori' => 'Kegiatan',    'urutan' => 6,  'keterangan' => 'Senam aerobik rutin setiap Minggu pagi bersama warga untuk menjaga kesehatan.'],
            ['judul' => 'Taman Toga Depan Balai RW',            'kategori' => 'Lingkungan',  'urutan' => 7,  'keterangan' => 'Taman tanaman obat yang dirawat bersama oleh PKK RW 10.'],
            ['judul' => 'Bersih-bersih Sungai Kali Surabaya',   'kategori' => 'Lingkungan',  'urutan' => 8,  'keterangan' => 'Kegiatan bersih sungai melibatkan ratusan warga dari seluruh RW bersama Dinas Lingkungan Hidup.'],
            ['judul' => 'Pelatihan Kompos Organik',              'kategori' => 'Kegiatan',    'urutan' => 9,  'keterangan' => 'Pelatihan pengolahan sampah organik menjadi kompos yang berguna bagi tanaman.'],
            ['judul' => 'Donasi Sembako Warga Kurang Mampu',     'kategori' => 'Sosial',      'urutan' => 10, 'keterangan' => 'PKK RW 9–13 bergotong royong mengumpulkan dan mendistribusikan sembako kepada warga yang membutuhkan.'],
            ['judul' => 'Penghijauan Jalan Mojo',               'kategori' => 'Lingkungan',  'urutan' => 11, 'keterangan' => 'Penanaman pohon perindang sepanjang Jl. Mojo oleh warga bersama Dinas Kebersihan Kota Surabaya.'],
            ['judul' => 'Lomba Memasak PKK Kelurahan',          'kategori' => 'Sosial',      'urutan' => 12, 'keterangan' => 'Lomba memasak antar RT dalam rangka HUT PKK yang diikuti seluruh warga.'],
        ];

        // Warna latar per kategori untuk placeholder
        $gradients = [
            'Kegiatan'   => ['2d6a4f', '40916c'],
            'Lingkungan' => ['1b4332', '2d6a4f'],
            'Rapat'      => ['1e3a5f', '2563eb'],
            'Sosial'     => ['7c2d12', 'c2410c'],
            'Lainnya'    => ['374151', '6b7280'],
        ];

        $emojis = [
            'Kegiatan'   => '🏘️',
            'Lingkungan' => '🌿',
            'Rapat'      => '📋',
            'Sosial'     => '🤝',
            'Lainnya'    => '📸',
        ];

        foreach ($data as $i => $item) {
            $kat = $item['kategori'];
            $colors = $gradients[$kat] ?? $gradients['Lainnya'];
            $emoji = $emojis[$kat] ?? '📸';

            // Buat SVG placeholder sebagai "foto"
            $slug = 'galeri_placeholder_'.($i + 1).'_'.strtolower(str_replace(' ', '_', $kat)).'.svg';
            $svg = $this->makeSvg($item['judul'], $colors[0], $colors[1], $emoji);

            Storage::disk('public')->put('galeri/'.$slug, $svg);

            Galeri::create([
                'judul'      => $item['judul'],
                'foto'       => 'galeri/'.$slug,
                'keterangan' => $item['keterangan'],
                'kategori'   => $item['kategori'],
                'urutan'     => $item['urutan'],
            ]);
        }
    }

    private function makeSvg(string $judul, string $color1, string $color2, string $emoji): string
    {
        $safe = htmlspecialchars($judul, ENT_XML1);
        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">
  <defs>
    <linearGradient id="g" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#$color1"/>
      <stop offset="100%" style="stop-color:#$color2"/>
    </linearGradient>
  </defs>
  <rect width="800" height="600" fill="url(#g)"/>
  <text x="400" y="260" font-size="100" text-anchor="middle" dominant-baseline="middle">$emoji</text>
  <text x="400" y="360" font-family="Arial,sans-serif" font-size="28" font-weight="bold"
        fill="rgba(255,255,255,0.9)" text-anchor="middle" dominant-baseline="middle">$safe</text>
  <text x="400" y="400" font-family="Arial,sans-serif" font-size="16"
        fill="rgba(255,255,255,0.5)" text-anchor="middle">Kelurahan Mojo 2</text>
</svg>
SVG;
    }
}

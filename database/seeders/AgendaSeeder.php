<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // === MENDATANG ===
            [
                'judul'      => 'Posyandu Balita Bulan Mei',
                'tanggal'    => '2026-05-21',
                'waktu'      => '08.00 – 11.00 WIB',
                'lokasi'     => 'Balai RW 10',
                'kategori'   => 'Kesehatan',
                'keterangan' => 'Bawa buku KIA. Tersedia layanan imunisasi, penimbangan, dan konsultasi gizi. Gratis.',
            ],
            [
                'judul'      => 'Posyandu Lansia Bulan Mei',
                'tanggal'    => '2026-05-22',
                'waktu'      => '08.00 – 10.00 WIB',
                'lokasi'     => 'Balai RW 11',
                'kategori'   => 'Kesehatan',
                'keterangan' => 'Pemeriksaan tekanan darah, gula darah, dan konsultasi kesehatan lansia. Bawa KTP.',
            ],
            [
                'judul'      => 'Fogging DBD Wilayah RW 9–13',
                'tanggal'    => '2026-05-23',
                'waktu'      => '07.00 – 12.00 WIB',
                'lokasi'     => 'Seluruh RT RW 9–13',
                'kategori'   => 'Kesehatan',
                'keterangan' => 'Warga dimohon membuka pintu dan jendela saat proses fogging berlangsung. Jauhkan makanan dan barang sensitif.',
            ],
            [
                'judul'      => 'Kerja Bakti Massal Mingguan',
                'tanggal'    => '2026-05-25',
                'waktu'      => '06.00 – 09.00 WIB',
                'lokasi'     => 'Jl. Mojo dan sekitarnya',
                'kategori'   => 'Sosial',
                'keterangan' => 'Bawa peralatan kebersihan. Konsumsi disediakan panitia.',
            ],
            [
                'judul'      => 'Rapat Koordinasi Ketua RT',
                'tanggal'    => '2026-05-27',
                'waktu'      => '19.00 WIB – selesai',
                'lokasi'     => 'Balai Kelurahan Mojo 2',
                'kategori'   => 'Rapat',
                'keterangan' => 'Agenda: evaluasi Mei, program Juni, sosialisasi program Pemerintah Kota Surabaya. Kehadiran wajib bagi seluruh ketua RT.',
            ],
            [
                'judul'      => 'Pengambilan Bansos PKH/BPNT RW 9',
                'tanggal'    => '2026-05-26',
                'waktu'      => '08.00 – 12.00 WIB',
                'lokasi'     => 'Kantor Kelurahan Mojo 2',
                'kategori'   => 'Sosial',
                'keterangan' => 'Wajib membawa KTP asli, KK, dan Kartu PKH/BPNT. Tidak bisa diwakilkan.',
            ],
            [
                'judul'      => 'Bazar UMKM Warga — Hari Jadi Surabaya',
                'tanggal'    => '2026-05-31',
                'waktu'      => '08.00 – 17.00 WIB',
                'lokasi'     => 'Lapangan RW 10',
                'kategori'   => 'Sosial',
                'keterangan' => '30+ stand UMKM, penampilan seni budaya, lomba memasak PKK, dan pameran tanaman toga.',
            ],
            [
                'judul'      => 'Senam Pagi Rutin Warga',
                'tanggal'    => '2026-06-01',
                'waktu'      => '06.00 – 07.30 WIB',
                'lokasi'     => 'Lapangan RW 10',
                'kategori'   => 'Olahraga',
                'keterangan' => 'Senam aerobik bersama dipandu instruktur. Terbuka untuk semua warga. Gratis.',
            ],
            [
                'judul'      => 'Sosialisasi Program Pangan Bergizi (P2B)',
                'tanggal'    => '2026-06-05',
                'waktu'      => '09.00 – 11.00 WIB',
                'lokasi'     => 'Balai Kelurahan Mojo 2',
                'kategori'   => 'Pendidikan',
                'keterangan' => 'Sosialisasi dari Dinas Ketahanan Pangan Kota Surabaya. Dibagikan bibit tanaman sayur gratis untuk peserta.',
            ],
            [
                'judul'      => 'Pelatihan Pembuatan Kompos dari Sampah Organik',
                'tanggal'    => '2026-06-08',
                'waktu'      => '09.00 – 12.00 WIB',
                'lokasi'     => 'Balai RW 9',
                'kategori'   => 'Pendidikan',
                'keterangan' => 'Pelatihan gratis dari komunitas lingkungan Surabaya Hijau. Peserta terbatas 30 orang, daftar ke ketua RT.',
            ],
            // === ARSIP LEWAT ===
            [
                'judul'      => 'Rapat Tahunan Pengurus RW',
                'tanggal'    => '2026-04-28',
                'waktu'      => '19.30 WIB – selesai',
                'lokasi'     => 'Balai Kelurahan Mojo 2',
                'kategori'   => 'Rapat',
                'keterangan' => 'Laporan kegiatan triwulan I dan rencana program triwulan II 2026.',
            ],
            [
                'judul'      => 'Jalan Santai HUT PKK ke-48',
                'tanggal'    => '2026-04-20',
                'waktu'      => '06.30 – 09.00 WIB',
                'lokasi'     => 'Start Lapangan RW 10',
                'kategori'   => 'Olahraga',
                'keterangan' => 'Doorprize menarik menanti peserta. Konsumsi disediakan.',
            ],
            [
                'judul'      => 'Pembagian Bibit Tanaman Obat Gratis',
                'tanggal'    => '2026-04-12',
                'waktu'      => '08.00 – 11.00 WIB',
                'lokasi'     => 'Balai RW 10',
                'kategori'   => 'Sosial',
                'keterangan' => 'Bibit yang dibagikan: jahe, kunyit, temulawak, serai, dan lidah buaya.',
            ],
        ];

        foreach ($data as $item) {
            Agenda::create($item);
        }
    }
}

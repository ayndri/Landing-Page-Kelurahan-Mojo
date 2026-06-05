<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul'      => 'Kerja Bakti Massal Minggu Pagi',
                'konten'     => "Diberitahukan kepada seluruh warga RW 9–13 bahwa akan diadakan kerja bakti massal pada:\n\nHari   : Minggu, 25 Mei 2026\nWaktu  : 06.00 – 09.00 WIB\nLokasi : Sepanjang Jl. Mojo dan sekitarnya\n\nSeluruh warga diharapkan hadir membawa peralatan kebersihan masing-masing. Konsumsi disediakan panitia.\n\nAtas perhatian dan kehadiran Bapak/Ibu, kami ucapkan terima kasih.",
                'kategori'   => 'Kegiatan',
                'tanggal'    => '2026-05-20',
                'is_penting' => false,
            ],
            [
                'judul'      => 'Pembayaran Iuran Kebersihan Bulan Mei 2026',
                'konten'     => "Kepada seluruh warga Kelurahan Mojo 2,\n\nDiingatkan bahwa iuran kebersihan bulan Mei 2026 sudah dapat dibayarkan mulai tanggal 1 Mei 2026.\n\nBesaran iuran:\n- Warga biasa : Rp 15.000/bulan\n- Usaha kecil  : Rp 25.000/bulan\n\nPembayaran dapat dilakukan kepada ketua RT masing-masing atau melalui rekening RW. Batas pembayaran akhir bulan.\n\nTerima kasih atas kerjasamanya.",
                'kategori'   => 'Administrasi',
                'tanggal'    => '2026-05-01',
                'is_penting' => false,
            ],
            [
                'judul'      => 'PERINGATAN: Wabah Demam Berdarah — Lakukan 3M Plus',
                'konten'     => "WARGA KELURAHAN MOJO 2 HARAP WASPADA!\n\nBerdasarkan laporan Puskesmas Gubeng, terdapat peningkatan kasus Demam Berdarah Dengue (DBD) di wilayah Kelurahan Mojo 2 selama bulan April–Mei 2026.\n\nMari lakukan 3M Plus:\n1. MENGURAS bak mandi, tempat penampungan air minimal 1x seminggu\n2. MENUTUP rapat tempat penampungan air\n3. MENDAUR ULANG atau membuang barang bekas yang dapat menampung air\nPLUS: Menggunakan lotion anti nyamuk dan kelambu\n\nFogging akan dilaksanakan pada:\nJumat, 23 Mei 2026 | Pukul 07.00–12.00 WIB\nSeluruh RT di RW 9–13\n\nWarga dimohon membuka pintu dan jendela rumah saat fogging berlangsung.",
                'kategori'   => 'Kesehatan',
                'tanggal'    => '2026-05-15',
                'is_penting' => true,
            ],
            [
                'judul'      => 'Pemutakhiran Data Kependudukan — Harap Melapor ke RT',
                'konten'     => "Dalam rangka pemutakhiran data kependudukan tahun 2026, seluruh warga Kelurahan Mojo 2 diharapkan melaporkan perubahan data berikut kepada ketua RT masing-masing:\n\n• Kelahiran\n• Kematian\n• Pindah masuk / pindah keluar\n• Pernikahan\n• Perubahan pekerjaan\n\nPelaporan dibuka mulai 15 Mei hingga 30 Juni 2026. Bawa fotokopi KTP dan KK.\n\nData yang akurat membantu kami merencanakan program yang tepat sasaran untuk warga.",
                'kategori'   => 'Administrasi',
                'tanggal'    => '2026-05-15',
                'is_penting' => false,
            ],
            [
                'judul'      => 'Posyandu Balita dan Lansia Bulan Mei',
                'konten'     => "Posyandu rutin bulan Mei 2026 akan dilaksanakan:\n\nPOSYANDU BALITA\nRabu, 21 Mei 2026 | 08.00–11.00 WIB | Balai RW 10\n\nPOSYANDU LANSIA\nKamis, 22 Mei 2026 | 08.00–10.00 WIB | Balai RW 11\n\nLayanan yang tersedia:\n✓ Penimbangan berat badan\n✓ Imunisasi (untuk balita)\n✓ Pemeriksaan tekanan darah\n✓ Konsultasi gizi\n✓ Pembagian vitamin\n\nDibawa: Buku KIA (untuk balita), KTP (untuk lansia).\nLayanan GRATIS.",
                'kategori'   => 'Kesehatan',
                'tanggal'    => '2026-05-18',
                'is_penting' => false,
            ],
            [
                'judul'      => 'Rapat Koordinasi Ketua RT se-Kelurahan Mojo 2',
                'konten'     => "Kepada Yth.\nSeluruh Ketua RT di lingkungan Kelurahan Mojo 2\n\nDengan hormat, mengundang Bapak/Ibu untuk hadir dalam:\n\nRapat Koordinasi Ketua RT\nHari    : Selasa, 27 Mei 2026\nWaktu  : 19.00 WIB – selesai\nTempat : Balai Kelurahan Mojo 2\nAgenda :\n1. Evaluasi kegiatan bulan April–Mei\n2. Pembahasan program bulan Juni\n3. Sosialisasi program Pemerintah Kota Surabaya\n4. Lain-lain\n\nKehadiran Bapak/Ibu sangat kami harapkan. Mohon konfirmasi kepada sekretaris RW.",
                'kategori'   => 'Kegiatan',
                'tanggal'    => '2026-05-22',
                'is_penting' => false,
            ],
            [
                'judul'      => 'Bazar UMKM Warga — Sambut Hari Jadi Kota Surabaya',
                'konten'     => "Dalam rangka memperingati Hari Jadi Kota Surabaya ke-733, akan digelar:\n\n🎉 BAZAR UMKM KELURAHAN MOJO 2 🎉\n\nSabtu–Minggu, 31 Mei – 1 Juni 2026\nPukul 08.00–17.00 WIB\nLokasi: Lapangan RW 10 Kelurahan Mojo 2\n\nFeaturing:\n• 30+ stand UMKM warga lokal\n• Penampilan seni budaya\n• Lomba memasak ibu-ibu PKK\n• Pameran tanaman toga\n\nPendaftaran stand: Hubungi Ketua RW 10 atau WhatsApp 0812-XXXX-XXXX\nBiaya stand: GRATIS untuk warga Kelurahan Mojo 2\n\nAyo ramaikan dan dukung produk lokal warga kita!",
                'kategori'   => 'Kegiatan',
                'tanggal'    => '2026-05-10',
                'is_penting' => true,
            ],
            [
                'judul'      => 'Jadwal Pengambilan Bantuan Sosial (Bansos) Triwulan II',
                'konten'     => "Kepada warga penerima manfaat Program Keluarga Harapan (PKH) dan Bantuan Pangan Non-Tunai (BPNT),\n\nJadwal pengambilan bantuan sosial Triwulan II (April–Juni 2026):\n\nRW 9  : Senin, 26 Mei 2026 | 08.00–12.00 WIB\nRW 10 : Selasa, 27 Mei 2026 | 08.00–12.00 WIB\nRW 11 : Rabu, 28 Mei 2026 | 08.00–12.00 WIB\nRW 12 : Kamis, 29 Mei 2026 | 08.00–12.00 WIB\nRW 13 : Jumat, 30 Mei 2026 | 08.00–12.00 WIB\n\nTempat: Kantor Kelurahan Mojo 2\nBawa: KTP asli, Kartu Keluarga, Kartu PKH/BPNT\n\nWarga yang tidak dapat hadir harap menghubungi ketua RT.",
                'kategori'   => 'Info',
                'tanggal'    => '2026-05-24',
                'is_penting' => false,
            ],
        ];

        foreach ($data as $item) {
            Pengumuman::create($item);
        }
    }
}

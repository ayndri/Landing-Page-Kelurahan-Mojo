<?php

namespace Database\Seeders;

use App\Models\Plant;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Database\Seeder;

class Rw10Seeder extends Seeder
{
    public function run(): void
    {
        $adminRw10 = User::where('email', 'rw10@mojo2.id')->first();

        $plants = [
            [
                'nama' => 'Sirih',
                'nama_latin' => 'Piper betle',
                'jenis' => 'Tanaman Obat',
                'deskripsi' => 'Tanaman merambat yang daunnya memiliki banyak khasiat kesehatan. Banyak digunakan dalam pengobatan tradisional.',
                'manfaat' => "- Antiseptik alami\n- Mengatasi bau mulut\n- Mempercepat penyembuhan luka\n- Anti-inflamasi",
                'latitude' => -7.2801,
                'longitude' => 112.7631,
                'lokasi_keterangan' => 'Di taman depan Balai RW 10',
            ],
            [
                'nama' => 'Lidah Buaya',
                'nama_latin' => 'Aloe vera',
                'jenis' => 'Tanaman Obat',
                'deskripsi' => 'Tanaman sukulen dengan daun tebal berisi gel yang menyegarkan dan menyembuhkan.',
                'manfaat' => "- Melembapkan kulit\n- Mengatasi luka bakar ringan\n- Membantu pencernaan\n- Nutrisi rambut",
                'latitude' => -7.2815,
                'longitude' => 112.7645,
                'lokasi_keterangan' => 'Kebun tanaman warga RT 03',
            ],
            [
                'nama' => 'Jahe',
                'nama_latin' => 'Zingiber officinale',
                'jenis' => 'Rempah',
                'deskripsi' => 'Tanaman rimpang yang banyak digunakan sebagai bumbu masak dan bahan obat tradisional.',
                'manfaat' => "- Menghangatkan tubuh\n- Mengatasi mual\n- Anti-inflamasi\n- Meningkatkan imun",
                'latitude' => -7.2795,
                'longitude' => 112.7618,
                'lokasi_keterangan' => 'Kebun RW 10 sebelah timur',
            ],
            [
                'nama' => 'Kunyit',
                'nama_latin' => 'Curcuma longa',
                'jenis' => 'Rempah',
                'deskripsi' => 'Tanaman rimpang dengan warna kuning cerah khas, kaya kandungan kurkumin.',
                'manfaat' => "- Anti-oksidan kuat\n- Meningkatkan imunitas\n- Baik untuk pencernaan\n- Pewarna alami masakan",
                'latitude' => -7.2808,
                'longitude' => 112.7655,
                'lokasi_keterangan' => 'Pojok kebun komunal RT 01',
            ],
            [
                'nama' => 'Pepaya',
                'nama_latin' => 'Carica papaya',
                'jenis' => 'Buah',
                'deskripsi' => 'Pohon buah tropis yang tumbuh cepat. Buah, daun, dan bijinya memiliki nilai gizi dan manfaat kesehatan.',
                'manfaat' => "- Memperlancar pencernaan\n- Kaya vitamin C dan A\n- Daun untuk demam berdarah\n- Enzim papain untuk pengempuk daging",
                'latitude' => -7.2820,
                'longitude' => 112.7640,
                'lokasi_keterangan' => 'Pinggir jalan RT 02 RW 10',
            ],
        ];

        foreach ($plants as $data) {
            Plant::create(array_merge($data, ['user_id' => $adminRw10->id]));
        }

        $umkmList = [
            [
                'nama_usaha' => 'Warung Bu Sari',
                'jenis_usaha' => 'Kuliner',
                'nama_pemilik' => 'Sari Dewi',
                'deskripsi' => 'Warung makan rumahan dengan menu masakan Jawa autentik. Tersedia nasi campur, lauk pauk, dan aneka sambal.',
                'produk' => "- Nasi Campur\n- Rawon\n- Soto Ayam\n- Lontong Sayur\n- Es Teh & Minuman",
                'latitude' => -7.2812,
                'longitude' => 112.7628,
                'lokasi_keterangan' => 'Jl. Mojo IV No. 12, RW 10',
                'no_telepon' => '08123456789',
                'jam_buka' => '06.00 - 14.00',
            ],
            [
                'nama_usaha' => 'Keripik Tempe Mbak Rina',
                'jenis_usaha' => 'Makanan Olahan',
                'nama_pemilik' => 'Rina Hastuti',
                'deskripsi' => 'Produsen keripik tempe rumahan dengan berbagai rasa. Produk sudah memiliki izin P-IRT dan dijual ke berbagai daerah.',
                'produk' => "- Keripik Tempe Original\n- Keripik Tempe Pedas\n- Keripik Tempe Balado\n- Keripik Tempe Keju",
                'latitude' => -7.2798,
                'longitude' => 112.7642,
                'lokasi_keterangan' => 'Gang Mojo V No. 3, RW 10',
                'no_telepon' => '08234567890',
                'instagram' => 'keripiktempe_rina',
                'shopee' => 'https://shopee.co.id/keripiktempe.rina',
                'jam_buka' => '08.00 - 17.00',
            ],
            [
                'nama_usaha' => 'Jahit & Bordir Pak Hendra',
                'jenis_usaha' => 'Jasa Jahit',
                'nama_pemilik' => 'Hendra Santoso',
                'deskripsi' => 'Usaha jahit dan bordir pakaian dengan pengalaman lebih dari 10 tahun. Melayani jahit baju, bordir nama, dan konveksi kecil.',
                'produk' => "- Jahit pakaian wanita & pria\n- Bordir nama/logo\n- Permak pakaian\n- Konveksi seragam",
                'latitude' => -7.2825,
                'longitude' => 112.7650,
                'lokasi_keterangan' => 'Jl. Mojo III No. 7, RW 10',
                'no_telepon' => '08345678901',
                'jam_buka' => '09.00 - 18.00',
            ],
            [
                'nama_usaha' => 'Jamu Tradisional Bu Wati',
                'jenis_usaha' => 'Minuman Kesehatan',
                'nama_pemilik' => 'Wati Suryani',
                'deskripsi' => 'Usaha jamu tradisional berbahan tanaman herbal yang diracik sendiri. Bahan-bahan diambil dari kebun RW 10.',
                'produk' => "- Jamu Kunyit Asam\n- Jamu Beras Kencur\n- Jamu Jahe Merah\n- Jamu Temulawak\n- Paket Langganan",
                'latitude' => -7.2805,
                'longitude' => 112.7635,
                'lokasi_keterangan' => 'Depan Musholla RT 04, RW 10',
                'no_telepon' => '08456789012',
                'instagram' => 'jamu_wati_mojo',
                'shopee' => 'https://shopee.co.id/jamuwati.mojo2',
                'jam_buka' => '05.30 - 10.00',
            ],
        ];

        foreach ($umkmList as $data) {
            Umkm::create(array_merge($data, ['user_id' => $adminRw10->id]));
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Plant;
use App\Models\User;
use Illuminate\Database\Seeder;

class PlantRw12Seeder extends Seeder
{
    public function run(): void
    {
        // Hapus semua data tanaman dummy lama
        Plant::truncate();

        $user = User::where('email', 'rw12@mojo2.id')->firstOrFail();

        $plants = [
            [
                'nama'       => 'Bonsai / Santigi',
                'nama_latin' => 'Pemphis acidula',
                'jenis'      => 'Hias',
                'deskripsi'  => 'Sebagai Hiasan atau Koleksi.',
                'manfaat'    => 'Sebagai Hiasan atau Koleksi.',
                'latitude'   => -7.274878,
                'longitude'  => 112.766662,
            ],
            [
                'nama'       => 'Pohon Sawo',
                'nama_latin' => 'Manilkara zapota',
                'jenis'      => 'Buah',
                'deskripsi'  => 'Buah sawo kaya akan serat, vitamin C, dan antioksidan yang berfungsi melancarkan pencernaan, meningkatkan imunitas tubuh, menjaga kesehatan jantung, serta menjadi sumber energi instan.',
                'manfaat'    => 'Melancarkan pencernaan, meningkatkan imunitas tubuh, menjaga kesehatan jantung, sumber energi instan.',
                'latitude'   => -7.274903,
                'longitude'  => 112.766612,
            ],
            [
                'nama'       => 'Belimbing Wuluh',
                'nama_latin' => 'Averrhoa bilimbi',
                'jenis'      => 'Sayur',
                'deskripsi'  => 'Berkhasiat sebagai obat tradisional dan penyedap masakan alami, buah dan bunganya berfungsi mengobati sariawan, meredakan batuk, membantu mengontrol gula darah (antidiabetes), serta menurunkan hipertensi.',
                'manfaat'    => 'Mengobati sariawan, meredakan batuk, mengontrol gula darah, menurunkan hipertensi.',
                'latitude'   => -7.275416,
                'longitude'  => 112.767133,
            ],
            [
                'nama'       => 'Pepaya Jepang',
                'nama_latin' => 'Cnidoscolus aconitifolius',
                'jenis'      => 'Sayur',
                'deskripsi'  => 'Daun pepaya jepang (Chaya) adalah tanaman kaya nutrisi yang bermanfaat untuk melancarkan pencernaan, mengontrol gula darah, mencegah anemia, dan memperkuat sistem imun. Daun ini juga sering dimanfaatkan untuk membantu pembentukan otot serta mendukung kesehatan kulit.',
                'manfaat'    => 'Melancarkan pencernaan, mengontrol gula darah, mencegah anemia, memperkuat sistem imun.',
                'latitude'   => -7.275753,
                'longitude'  => 112.766574,
            ],
            [
                'nama'       => 'Pohon Sawo',
                'nama_latin' => 'Manilkara zapota',
                'jenis'      => 'Buah',
                'deskripsi'  => 'Buah ini bermanfaat melancarkan pencernaan, menjaga kesehatan jantung, meningkatkan sistem kekebalan tubuh, dan membantu mengontrol kadar gula darah.',
                'manfaat'    => 'Melancarkan pencernaan, menjaga kesehatan jantung, meningkatkan imunitas, mengontrol gula darah.',
                'latitude'   => -7.275927,
                'longitude'  => 112.766583,
            ],
            [
                'nama'       => 'Pohon Belimbing',
                'nama_latin' => 'Averrhoa carambola',
                'jenis'      => 'Buah',
                'deskripsi'  => 'Berfungsi untuk meningkatkan sistem kekebalan tubuh, melancarkan pencernaan, serta mengontrol gula darah dan kolesterol. Buah ini juga sangat baik untuk kesehatan jantung dan membantu menurunkan tekanan darah tinggi.',
                'manfaat'    => 'Meningkatkan imunitas, melancarkan pencernaan, mengontrol gula darah dan kolesterol, menurunkan tekanan darah.',
                'latitude'   => -7.27639,
                'longitude'  => 112.766518,
            ],
            [
                'nama'       => 'Jambu Air Hijau',
                'nama_latin' => 'Syzygium aqueum',
                'jenis'      => 'Buah',
                'deskripsi'  => 'Untuk menghidrasi tubuh, melancarkan pencernaan, dan menjaga kesehatan jantung. Buah rendah kalori ini juga sangat baik untuk menstabilkan tekanan darah dan meningkatkan sistem kekebalan tubuh.',
                'manfaat'    => 'Menghidrasi tubuh, melancarkan pencernaan, menjaga kesehatan jantung, menstabilkan tekanan darah.',
                'latitude'   => -7.277081,
                'longitude'  => 112.766564,
            ],
            [
                'nama'       => 'Pohon Mangga',
                'nama_latin' => 'Mangifera indica',
                'jenis'      => 'Buah',
                'deskripsi'  => 'Dapat meningkatkan imunitas, menyehatkan pencernaan, mencegah sembelit, serta mendukung kesehatan mata dan jantung.',
                'manfaat'    => 'Meningkatkan imunitas, menyehatkan pencernaan, mencegah sembelit, mendukung kesehatan mata dan jantung.',
                'latitude'   => -7.27701,
                'longitude'  => 112.766609,
            ],
            [
                'nama'       => 'Pohon Sawo',
                'nama_latin' => 'Manilkara zapota',
                'jenis'      => 'Buah',
                'deskripsi'  => 'Buah ini bermanfaat melancarkan pencernaan, menjaga kesehatan jantung, meningkatkan sistem kekebalan tubuh, dan membantu mengontrol kadar gula darah.',
                'manfaat'    => 'Melancarkan pencernaan, menjaga kesehatan jantung, meningkatkan imunitas, mengontrol gula darah.',
                'latitude'   => -7.276493,
                'longitude'  => 112.766772,
            ],
            [
                'nama'       => 'Lidah Buaya',
                'nama_latin' => 'Aloe vera',
                'jenis'      => 'Obat / TOGA',
                'deskripsi'  => 'Selain digunakan sebagai tanaman hias, tanaman ini jika dikelola dapat digunakan untuk melembapkan kulit, meredakan jerawat dan peradangan, menyembuhkan luka bakar (sunburn), hingga menjaga kesehatan pencernaan dan menurunkan kadar gula darah bila dikonsumsi dengan benar.',
                'manfaat'    => 'Melembapkan kulit, meredakan jerawat, menyembuhkan luka bakar, menjaga pencernaan, menurunkan gula darah.',
                'latitude'   => -7.276049,
                'longitude'  => 112.767069,
            ],
            [
                'nama'       => 'Lidah Buaya',
                'nama_latin' => 'Aloe vera',
                'jenis'      => 'Obat / TOGA',
                'deskripsi'  => 'Selain dapat digunakan sebagai tanaman hias, jika tanaman ini dikelola dapat digunakan untuk melembapkan kulit, meredakan jerawat dan peradangan, menyembuhkan luka bakar (sunburn), hingga menjaga kesehatan pencernaan dan menurunkan kadar gula darah bila dikonsumsi dengan benar.',
                'manfaat'    => 'Melembapkan kulit, meredakan jerawat, menyembuhkan luka bakar, menjaga pencernaan, menurunkan gula darah.',
                'latitude'   => -7.276955,
                'longitude'  => 112.766988,
            ],
            [
                'nama'       => 'Palem Jari',
                'nama_latin' => 'Rhapis excelsa',
                'jenis'      => 'Hias',
                'deskripsi'  => 'Tanaman ini banyak dimanfaatkan masyarakat luas sebagai tanaman hias di ruangan, di halaman (taman) bahkan sebagai bunga potong. Penampilannya yang anggun, menarik dan indah, terutama bila dibentuk rangkaian sangat disukai oleh masyarakat.',
                'manfaat'    => 'Tanaman hias ruangan dan taman, bisa dijadikan bunga potong.',
                'latitude'   => -7.275513,
                'longitude'  => 112.767630,
            ],
            [
                'nama'       => 'Pohon Mangga',
                'nama_latin' => 'Mangifera indica',
                'jenis'      => 'Buah',
                'deskripsi'  => 'Pohon ini berfungsi sebagai peneduh dan penyerap karbon dioksida, sementara buahnya kaya akan vitamin (C, A, K) serta serat yang baik untuk pencernaan dan kesehatan kulit.',
                'manfaat'    => 'Peneduh, penyerap CO2, kaya vitamin C/A/K, baik untuk pencernaan dan kesehatan kulit.',
                'latitude'   => -7.275634,
                'longitude'  => 112.767661,
            ],
            [
                'nama'       => 'Pohon Pepaya',
                'nama_latin' => 'Carica papaya',
                'jenis'      => 'Buah',
                'deskripsi'  => 'Hampir seluruh bagian tanamannya bisa dimanfaatkan, mulai dari buah hingga akar, dengan kandungan enzim papain, vitamin, dan antioksidan yang tinggi.',
                'manfaat'    => 'Seluruh bagian tanaman bermanfaat — enzim papain, vitamin, dan antioksidan tinggi.',
                'latitude'   => -7.275799,
                'longitude'  => 112.767599,
            ],
            [
                'nama'       => 'Pohon Flamboyan',
                'nama_latin' => 'Delonix regia',
                'jenis'      => 'Hias',
                'deskripsi'  => 'Pohon ini sangat bermanfaat sebagai pelindung dari terik matahari, penyerap polusi udara, penghias lanskap, dan bahan bangunan.',
                'manfaat'    => 'Pelindung terik matahari, penyerap polusi udara, penghias lanskap.',
                'latitude'   => -7.275854,
                'longitude'  => 112.767590,
            ],
            [
                'nama'       => 'Buah Naga',
                'nama_latin' => 'Hylocereus polyrhizus',
                'jenis'      => 'Buah',
                'deskripsi'  => 'Melancarkan pencernaan dan mencegah sembelit, meningkatkan sistem kekebalan tubuh, menjaga kesehatan jantung, mencegah anemia, serta membantu program diet karena rendah kalori dan membuat kenyang lebih lama.',
                'manfaat'    => 'Melancarkan pencernaan, meningkatkan imunitas, menjaga jantung, mencegah anemia, baik untuk diet.',
                'latitude'   => -7.276027,
                'longitude'  => 112.767618,
            ],
            [
                'nama'       => 'Jambu Air Hijau',
                'nama_latin' => 'Syzygium aqueum',
                'jenis'      => 'Buah',
                'deskripsi'  => 'Dapat digunakan untuk menghidrasi tubuh dan mengandung antioksidan, serat, serta vitamin untuk melancarkan pencernaan. Selain buah, daunnya sering digunakan sebagai obat tradisional untuk mengatasi diare, meredakan peradangan, hingga membantu mengontrol gula darah.',
                'manfaat'    => 'Menghidrasi tubuh, kaya antioksidan dan serat, daun untuk obat diare dan mengontrol gula darah.',
                'latitude'   => -7.276506,
                'longitude'  => 112.767466,
            ],
            [
                'nama'       => 'Anggur Hijau',
                'nama_latin' => 'Vitis vinifera',
                'jenis'      => 'Buah',
                'deskripsi'  => 'Sangat bermanfaat untuk menjaga kesehatan jantung, mendukung sistem kekebalan tubuh, melancarkan pencernaan, serta mengontrol berat badan karena rendah kalori.',
                'manfaat'    => 'Menjaga kesehatan jantung, mendukung imunitas, melancarkan pencernaan, mengontrol berat badan.',
                'latitude'   => -7.276565,
                'longitude'  => 112.767424,
            ],
            [
                'nama'       => 'Bougenvile',
                'nama_latin' => 'Bougainvillea',
                'jenis'      => 'Hias',
                'deskripsi'  => 'Dapat dijadikan sebagai tanaman hias, selain itu bunga dan daun bunga kertas memiliki aktivitas antioksidan, antiinflamasi, antiulcer, antidiabetes, antidiarrheal, dan antimikroba.',
                'manfaat'    => 'Tanaman hias; bunga dan daun berkhasiat antioksidan, antiinflamasi, antidiabetes, dan antimikroba.',
                'latitude'   => -7.276896,
                'longitude'  => 112.767689,
            ],
            [
                'nama'       => 'Sente',
                'nama_latin' => 'Alocasia macrorrhizos',
                'jenis'      => 'Produktif lainnya',
                'deskripsi'  => 'Tanaman ini serbaguna dan biasa dimanfaatkan untuk tanaman hias, pakan ikan, obat tradisional, hingga sumber pangan alternatif (apabila dapat mengelola dengan benar).',
                'manfaat'    => 'Tanaman hias, pakan ikan, obat tradisional, sumber pangan alternatif.',
                'latitude'   => -7.27699,
                'longitude'  => 112.767940,
            ],
            [
                'nama'       => 'Palem Kuning',
                'nama_latin' => 'Dypsis lutescens',
                'jenis'      => 'Hias',
                'deskripsi'  => 'Sebagai tanaman hias yang efektif menyaring racun dan polutan udara. Tanaman ini juga berfungsi sebagai pelembap alami ruangan, penahan erosi tanah, dan peredam getaran.',
                'manfaat'    => 'Menyaring polutan udara, pelembap alami ruangan, penahan erosi tanah.',
                'latitude'   => -7.27699,
                'longitude'  => 112.767940,
            ],
            [
                'nama'       => 'Pucuk Merah',
                'nama_latin' => 'Syzygium myrtifolium',
                'jenis'      => 'Hias',
                'deskripsi'  => 'Selain digunakan sebagai tanaman hias, daunnya kaya akan senyawa bioaktif seperti flavonoid, tanin, dan fenol yang sangat bermanfaat untuk kesehatan, mulai dari menangkal radikal bebas, menurunkan kadar gula darah, hingga mendukung kelestarian lingkungan.',
                'manfaat'    => 'Tanaman hias; daun kaya flavonoid, tanin, fenol — menangkal radikal bebas, menurunkan gula darah.',
                'latitude'   => -7.27682,
                'longitude'  => 112.768003,
            ],
        ];

        foreach ($plants as $data) {
            $data['user_id'] = $user->id;
            Plant::create($data);
        }

        $this->command->info('Selesai: ' . count($plants) . ' tanaman RW 12 berhasil dimasukkan.');
    }
}

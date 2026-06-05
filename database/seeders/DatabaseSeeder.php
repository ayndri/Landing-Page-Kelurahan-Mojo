<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RwProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        User::create([
            'name'       => 'Super Admin',
            'email'      => 'admin@mojo2.id',
            'password'   => Hash::make('password123'),
            'role'       => 'super_admin',
            'rw_number'  => null,
        ]);

        // 11 pengguna per RW (55 total) — total bersama super_admin = 56
        $namaPool = [
            'Agus Santoso',    'Bambang Wijaya',  'Candra Kusuma',   'Dedi Kurniawan',  'Eko Prasetyo',
            'Fajar Nugroho',   'Gunawan Setiawan','Hendra Saputra',  'Irwan Susanto',   'Joko Purnomo',
            'Kukuh Hartono',
        ];

        $rwData = [
            9  => ['prefix' => 'rw9',  'label' => 'RW 9'],
            10 => ['prefix' => 'rw10', 'label' => 'RW 10'],
            11 => ['prefix' => 'rw11', 'label' => 'RW 11'],
            12 => ['prefix' => 'rw12', 'label' => 'RW 12'],
            13 => ['prefix' => 'rw13', 'label' => 'RW 13'],
        ];

        foreach ($rwData as $rw => $info) {
            foreach ($namaPool as $i => $nama) {
                $seq   = $i + 1;
                $email = $seq === 1
                    ? "{$info['prefix']}@mojo2.id"
                    : "{$info['prefix']}.{$seq}@mojo2.id";

                User::create([
                    'name'      => $nama,
                    'email'     => $email,
                    'password'  => Hash::make('password123'),
                    'role'      => 'rw_admin',
                    'rw_number' => $rw,
                ]);
            }
        }

        // Profil RW
        foreach ([9, 10, 11, 12, 13] as $rw) {
            RwProfile::create([
                'rw_number'       => $rw,
                'nama_ketua'      => 'Bapak Contoh RW ' . $rw,
                'deskripsi'       => 'RW ' . $rw . ' merupakan salah satu rukun warga di wilayah Kelurahan Mojo 2, Kota Surabaya.',
                'visi'            => 'Mewujudkan RW ' . $rw . ' yang bersih, aman, dan sejahtera',
                'misi'            => "1. Meningkatkan kebersihan lingkungan\n2. Menjalin kerukunan antar warga\n3. Meningkatkan taraf ekonomi warga",
                'alamat'          => 'Jl. Mojo Kelurahan Mojo 2, Kota Surabaya',
                'jumlah_kk'       => rand(80, 150),
                'jumlah_penduduk' => rand(300, 600),
            ]);
        }

        $this->call(Rw10Seeder::class);
        $this->call(RtSeeder::class);
        $this->call(PengumumanSeeder::class);
        $this->call(AgendaSeeder::class);
        $this->call(GaleriSeeder::class);
    }
}

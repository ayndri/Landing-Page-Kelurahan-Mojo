<?php

namespace Database\Seeders;

use App\Models\Rt;
use Illuminate\Database\Seeder;

class RtSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // RW 9 — 4 RT
            [9, 1, 'Bapak Sumarno',    '0812-1111-0901', 42, 168],
            [9, 2, 'Bapak Haryanto',   '0813-2222-0902', 38, 152],
            [9, 3, 'Bapak Djoko W.',   '0857-3333-0903', 45, 181],
            [9, 4, 'Ibu Sriningsih',   '0819-4444-0904', 36, 144],

            // RW 10 — 5 RT
            [10, 1, 'Bapak Agus Setiawan',  '0812-1234-1001', 50, 198],
            [10, 2, 'Bapak Bambang K.',     '0813-5678-1002', 47, 186],
            [10, 3, 'Ibu Dewi Rahayu',      '0857-9012-1003', 53, 210],
            [10, 4, 'Bapak Eko Prasetyo',   '0819-3456-1004', 44, 174],
            [10, 5, 'Bapak Firmansyah',     '0812-7890-1005', 48, 191],

            // RW 11 — 4 RT
            [11, 1, 'Bapak Gunawan S.',  '0813-1111-1101', 41, 162],
            [11, 2, 'Bapak Hendra P.',   '0812-2222-1102', 39, 155],
            [11, 3, 'Ibu Indrawati',     '0857-3333-1103', 46, 183],
            [11, 4, 'Bapak Joko Susilo', '0819-4444-1104', 43, 170],

            // RW 12 — 4 RT
            [12, 1, 'Bapak Kurniawan',   '0812-5555-1201', 40, 159],
            [12, 2, 'Bapak Lukman H.',   '0813-6666-1202', 37, 147],
            [12, 3, 'Bapak Mujiono',     '0857-7777-1203', 44, 175],
            [12, 4, 'Ibu Nurhayati',     '0819-8888-1204', 38, 151],

            // RW 13 — 4 RT
            [13, 1, 'Bapak Ony Susanto',  '0812-9999-1301', 43, 172],
            [13, 2, 'Bapak Purwanto',     '0813-1010-1302', 40, 158],
            [13, 3, 'Bapak Rahmat H.',    '0857-2020-1303', 46, 184],
            [13, 4, 'Bapak Sigit W.',     '0819-3030-1304', 39, 156],
        ];

        foreach ($data as [$rw, $rt, $ketua, $telp, $kk, $penduduk]) {
            Rt::create([
                'rw_number'       => $rw,
                'rt_number'       => $rt,
                'nama_ketua'      => $ketua,
                'no_telepon'      => $telp,
                'jumlah_kk'       => $kk,
                'jumlah_penduduk' => $penduduk,
            ]);
        }
    }
}

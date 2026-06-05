<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RwProfile extends Model
{
    protected $fillable = [
        'rw_number',
        'nama_ketua',
        'sekretaris',
        'bendahara',
        'deskripsi',
        'visi',
        'misi',
        'foto_ketua',
        'foto_kegiatan',
        'alamat',
        'no_telepon',
        'jumlah_kk',
        'jumlah_penduduk',
    ];
}

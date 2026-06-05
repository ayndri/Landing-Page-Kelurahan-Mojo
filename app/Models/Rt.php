<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    protected $table = 'rts';

    protected $fillable = [
        'rw_number',
        'rt_number',
        'nama_ketua',
        'no_telepon',
        'jumlah_kk',
        'jumlah_penduduk',
    ];
}

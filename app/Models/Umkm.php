<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';

    protected $fillable = [
        'nama_usaha',
        'jenis_usaha',
        'nama_pemilik',
        'deskripsi',
        'produk',
        'foto',
        'latitude',
        'longitude',
        'lokasi_keterangan',
        'no_telepon',
        'instagram',
        'shopee',
        'jam_buka',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(UmkmProduct::class)->orderBy('urutan');
    }
}

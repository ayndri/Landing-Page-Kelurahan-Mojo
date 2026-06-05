<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumumans';

    protected $fillable = [
        'judul',
        'konten',
        'kategori',
        'tanggal',
        'is_penting',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal'    => 'date',
            'is_penting' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeris';

    protected $fillable = [
        'judul',
        'foto',
        'keterangan',
        'kategori',
        'urutan',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

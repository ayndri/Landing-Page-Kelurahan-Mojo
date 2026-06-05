<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'judul',
        'tanggal',
        'waktu',
        'lokasi',
        'keterangan',
        'kategori',
        'user_id',
        'rw_number',
    ];

    protected function casts(): array
    {
        return ['tanggal' => 'date'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('tanggal', '>=', now()->startOfDay())->orderBy('tanggal');
    }
}

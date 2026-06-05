<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plant extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'nama_latin',
        'jenis',
        'deskripsi',
        'manfaat',
        'foto',
        'latitude',
        'longitude',
        'lokasi_keterangan',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($plant) {
            if (empty($plant->slug)) {
                $plant->slug = static::generateSlug($plant->nama);
            }
        });

        static::updating(function ($plant) {
            if ($plant->isDirty('nama') && !$plant->isDirty('slug')) {
                $plant->slug = static::generateSlug($plant->nama, $plant->id);
            }
        });
    }

    public static function generateSlug(string $nama, ?int $excludeId = null): string
    {
        $base = Str::slug($nama);
        $slug = $base;
        $i = 2;
        while (
            static::where('slug', $slug)
                ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

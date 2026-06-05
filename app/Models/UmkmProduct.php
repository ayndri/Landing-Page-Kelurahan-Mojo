<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UmkmProduct extends Model {
    protected $table = 'umkm_products';
    protected $fillable = ['umkm_id', 'nama', 'deskripsi', 'foto', 'harga', 'urutan'];

    public function umkm() {
        return $this->belongsTo(Umkm::class);
    }
}

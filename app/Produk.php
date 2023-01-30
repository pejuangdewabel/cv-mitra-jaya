<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = [
        'kategori_id',
        'nama',
        'slug',
        'harga',
        'deskripsi',
        'waktu_pengerjaan',
        'status',
        'foto'
    ];
    public function relasi_kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}

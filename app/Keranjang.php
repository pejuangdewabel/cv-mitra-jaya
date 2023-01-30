<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $fillable = [
        'user_id',
        'produk_id_detail',
        'jumlah',
        'sub_total',
        'ket',
        'file_desain'
    ];

    public function relasi_user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function relasi_produk_detail()
    {
        return $this->belongsTo(DetailProduk::class, 'produk_id_detail', 'id');
    }
}

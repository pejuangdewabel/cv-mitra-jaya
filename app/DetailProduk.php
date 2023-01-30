<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailProduk extends Model
{
    protected $table = 'detail_produk';
    protected $fillable = [
        'produk_id',
        'desc',
        'price',
        'note'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}

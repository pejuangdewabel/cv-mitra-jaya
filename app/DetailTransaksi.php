<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';
    protected $fillable = [
        'transaksi_id',
        'produk_id_detail',
        'jumlah',
        'sub_total',
        'file_desain',
        'note'
    ];
    public function relasi_tranksasi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }

    public function relasi_produk_detail()
    {
        return $this->belongsTo(DetailProduk::class, 'produk_id_detail', 'id');
    }
}

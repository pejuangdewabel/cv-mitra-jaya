<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'invoice',
        'user_id',
        'karyawan_id',
        'total',
        'bayar',
        'kembalian',
        'bukti_pembayaran',
        'status',
        'metode_pembayaran_id'
    ];

    public function relasi_user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function relasi_karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }

    public function relasi_metode_pembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class, 'metode_pembayaran_id', 'id');
    }
}

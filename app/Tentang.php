<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    protected $table = 'tentang';
    protected $fillable = [
        'wa',
        'alamat',
        'email',
        'ig',
        'fb',
        'hero',
        'price_desain'
    ];
}

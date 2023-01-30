<?php

namespace App\Http\Controllers\Frontend;

use App\DetailProduk;
use App\DetailTransaksi;
use App\Http\Controllers\Controller;
use App\Kategori;
use App\MetodePembayaran;
use App\Produk;
use App\Tentang;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $kategori = Kategori::where('status', 1)->get();
        $produk = DetailProduk::with([
            'produk'
        ])->get();


        $about = Tentang::findOrFail(1);
        $metodePembayaran = MetodePembayaran::where('status', 1)->get();

        return view('frontend.pages.home', compact('kategori', 'produk', 'about', 'metodePembayaran'));
    }

    public function detail($id)
    {
        $data = Produk::with(['relasi_kategori'])->where('slug', $id)->first();
        $about = Tentang::findOrFail(1);
        $metodePembayaran = MetodePembayaran::where('status', 1)->get();

        return view('frontend.pages.detail', compact('about', 'metodePembayaran', 'data'));
    }
}

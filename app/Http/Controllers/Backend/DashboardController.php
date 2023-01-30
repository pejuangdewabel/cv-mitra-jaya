<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Karyawan;
use App\Kategori;
use App\Produk;
use App\Transaksi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $countKategori = Kategori::count();
        $countProduk = Produk::count();
        $countTransaksi = Transaksi::where('status', '>', 0)->count();
        $transaksiPennding = Transaksi::where('status', '<', 3)->get();

        return view('backend.pages.dashboard', compact('countKategori', 'countProduk', 'countTransaksi', 'transaksiPennding'));
    }
    public function settingProfile()
    {
        return view('backend.pages.setting');
    }

    public function settingProfilePost(Request $request)
    {
        $messages = [
            'required'  => ':attribute wajib diisi',
            'min'       => ':attribute harus diisi minimal digit :min ',
            'max'       => ':attribute harus diisi maksimal :max karakter',
            'after'     => 'Harus sesudah tanggal mulai',
            'same'      => ':attribute tidak sama',
        ];

        // |after:today
        $this->validate($request, [
            'username'          => 'required|min:5',
            'nama'              => 'required|string|min:3',
            'level'             => 'required'
        ], $messages);

        if ($request->password and $request->passwordConfirm) {
            if (Hash::check($request->password, Auth::guard('karyawan')->user()->password)) {
                $data = array(
                    'nama'          => ucfirst($request->nama),
                    'password'      => Hash::make($request->passwordConfirm),
                    'level'         => $request->level
                );
                Karyawan::findOrFail(Auth::guard('karyawan')->user()->id)->update($data);
            } else {
                return redirect()->back()->with('info', 'Password Salah');
            }
        } else {
            $data = array(
                'nama'          => ucfirst($request->nama),
                'level'         => $request->level
            );
            Karyawan::findOrFail(Auth::guard('karyawan')->user()->id)->update($data);
        }
        return redirect()->back()->with('success', 'Berhasil Ubah Data Profile');
    }
}

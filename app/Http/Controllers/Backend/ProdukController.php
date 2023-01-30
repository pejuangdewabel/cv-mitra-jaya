<?php

namespace App\Http\Controllers\Backend;

use App\DetailProduk;
use App\Http\Controllers\Controller;
use App\Kategori;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataProduk = Produk::with([
            'relasi_kategori'
        ])->get();
        return view('backend.pages.produk.index', compact('dataProduk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::where('status', 1)->get();
        return view('backend.pages.produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required'  => ':attribute wajib diisi',
            'min'       => ':attribute harus diisi minimal digit :min ',
            'max'       => ':attribute harus diisi maksimal :max karakter',
        ];

        // |after:today
        $this->validate($request, [
            'kategori_id'      => 'required',
            'nama'             => 'required|min:5',
            'deskripsi'        => 'required',
            'waktu_pengerjaan' => 'required|integer|min:1',
            'status'           => 'required',
            'foto'             => 'required|max:2000|mimes:png,jpg',
        ], $messages);

        if ($request->status == "on") {
            $status = 1;
        } else {
            $status = 2;
        }

        $data = array(
            'kategori_id'           => $request->kategori_id,
            'nama'                  => ucfirst($request->nama),
            'slug'                  => Str::slug($request->nama),
            'harga'                 => 0,
            'deskripsi'             => $request->deskripsi,
            'waktu_pengerjaan'      => $request->waktu_pengerjaan,
            'foto'                  => $request->file('foto')->store('assets/produk', 'public'),
            'status'                => $status
        );

        Produk::create($data);
        return redirect()->route('produk.index')->with('success', 'Berhasil Tambah Data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataProduk = Produk::with([
            'relasi_kategori'
        ])->findOrFail(Crypt::decryptString($id));
        $dataDetailProduk = DetailProduk::with(['produk'])->where('produk_id', Crypt::decryptString($id))->get();

        return view('backend.pages.produk.detail', compact([
            'dataProduk',
            'dataDetailProduk'
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataProduk = Produk::findOrFail(Crypt::decryptString($id));
        $kategori = Kategori::where('status', 1)->get();
        return view('backend.pages.produk.edit', compact([
            'dataProduk',
            'kategori'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required'  => ':attribute wajib diisi',
            'min'       => ':attribute harus diisi minimal digit :min ',
            'max'       => ':attribute harus diisi maksimal :max karakter',
        ];

        // |after:today
        $this->validate($request, [
            'kategori_id'      => 'required',
            'nama'             => 'required|min:5',
            'deskripsi'        => 'required',
            'waktu_pengerjaan' => 'required|integer|min:1',
            'foto'             => 'max:2000|mimes:png,jpg',
        ], $messages);

        $checkData = Produk::findOrFail(Crypt::decryptString($id));

        if ($request->status == "on") {
            $status = 1;
        } else {
            $status = 2;
        }

        if ($request->foto) {
            Storage::disk('public')->delete($checkData->foto);
            $data = array(
                'kategori_id'           => $request->kategori_id,
                'nama'                  => ucfirst($request->nama),
                'slug'                  => Str::slug($request->nama),
                'harga'                 => 0,
                'deskripsi'             => $request->deskripsi,
                'waktu_pengerjaan'      => $request->waktu_pengerjaan,
                'foto'                  => $request->file('foto')->store('assets/produk', 'public'),
                'status'                => $status
            );
            Produk::findOrFail(Crypt::decryptString($id))->update($data);
        } else {
            $data = array(
                'kategori_id'           => $request->kategori_id,
                'nama'                  => ucfirst($request->nama),
                'slug'                  => Str::slug($request->nama),
                'harga'                 => 0,
                'deskripsi'             => $request->deskripsi,
                'waktu_pengerjaan'      => $request->waktu_pengerjaan,
                'status'                => $status
            );
            Produk::findOrFail(Crypt::decryptString($id))->update($data);
        }

        return redirect()->route('produk.index')->with('success', 'Berhasil Ubah Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkData = Produk::findOrFail(Crypt::decryptString($id));
        Storage::disk('public')->delete($checkData->foto);
        Produk::findOrFail(Crypt::decryptString($id))->delete();
        return redirect()->back()->with('success', 'Berhasil Dihapus');
    }
}

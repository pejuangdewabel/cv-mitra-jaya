<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataKategori = Kategori::all();
        return view('backend.pages.kategori.index', compact('dataKategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.kategori.create');
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
            'nama'             => 'required|min:5',
            'icon'             => 'required|max:2000|mimes:png,jpg',
        ], $messages);

        $data = array(
            'nama'        => ucfirst($request->nama),
            'slug'        => Str::slug($request->nama),
            'icon'        => $request->file('icon')->store('assets/kategori', 'public'),
            'status'      => true
        );
        Kategori::create($data);
        return redirect()->route('kategori.index')->with('success', 'Berhasil Tambah Data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataKategori = Kategori::findOrFail(Crypt::decryptString($id));
        return view('backend.pages.kategori.edit', compact('dataKategori'));
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
            'nama'             => 'required|min:5',
        ], $messages);

        $checkData = Kategori::findOrFail(Crypt::decryptString($id));

        if ($request->status == "on") {
            $status = true;
        } else {
            $status = false;
        }

        if ($request->icon) {
            Storage::disk('public')->delete($checkData->icon);
            $data = array(
                'nama'        => ucfirst($request->nama),
                'slug'        => Str::slug($request->nama),
                'icon'        => $request->file('icon')->store('assets/kategori', 'public'),
                'status'      => $status
            );
            Kategori::findOrFail(Crypt::decryptString($id))->update($data);
        } else {
            $data = array(
                'nama'        => ucfirst($request->nama),
                'slug'        => Str::slug($request->nama),
                'status'      => $status
            );
            Kategori::findOrFail(Crypt::decryptString($id))->update($data);
        }

        return redirect()->route('kategori.index')->with('success', 'Berhasil Ubah Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkData = Kategori::findOrFail(Crypt::decryptString($id));
        Storage::disk('public')->delete($checkData->icon);
        Kategori::findOrFail(Crypt::decryptString($id))->delete();
        return redirect()->back()->with('success', 'Berhasil Dihapus');
    }
}

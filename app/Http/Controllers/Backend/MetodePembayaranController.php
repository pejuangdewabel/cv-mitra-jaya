<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\MetodePembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MetodePembayaran::all();
        return view('backend.pages.metodePenelitian.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.metodePenelitian.create');
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
            'nama_pembayaran'  => 'required|string|min:3',
            'no_akun'          => 'required|min:4',
            'an'               => 'required|string|min:3',
            'status'           => 'required',
            'icon'             => 'required|max:2000|mimes:png,jpg',
        ], $messages);

        if ($request->status == "on") {
            $status = 1;
        } else {
            $status = 2;
        }

        $data = array(
            'nama_pembayaran'       => ucfirst($request->nama_pembayaran),
            'no_akun'               => $request->no_akun,
            'an'                    => ucfirst($request->an),
            'icon'                  => $request->file('icon')->store('assets/metode-pembayaran', 'public'),
            'status'                => $status
        );

        MetodePembayaran::create($data);
        return redirect()->route('metode-pembayaran.index')->with('success', 'Berhasil Tambah Data');
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
        $dataMP = MetodePembayaran::findOrFail(Crypt::decryptString($id));
        return view('backend.pages.metodePenelitian.edit', compact([
            'dataMP',
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
            'nama_pembayaran'  => 'required|string|min:3',
            'no_akun'          => 'required|min:4',
            'an'               => 'required|string|min:3',
            'icon'             => 'max:2000|mimes:png,jpg',
        ], $messages);

        $checkData = MetodePembayaran::findOrFail(Crypt::decryptString($id));

        if ($request->status == "on") {
            $status = true;
        } else {
            $status = false;
        }

        if ($request->icon) {
            Storage::disk('public')->delete($checkData->icon);
            $data = array(
                'nama_pembayaran'       => ucfirst($request->nama_pembayaran),
                'no_akun'               => $request->no_akun,
                'an'                    => ucfirst($request->an),
                'icon'                  => $request->file('icon')->store('assets/metode-pembayaran', 'public'),
                'status'                => $status
            );
            MetodePembayaran::findOrFail(Crypt::decryptString($id))->update($data);
        } else {
            $data = array(
                'nama_pembayaran'       => ucfirst($request->nama_pembayaran),
                'no_akun'               => $request->no_akun,
                'an'                    => ucfirst($request->an),
                'status'                => $status
            );
            MetodePembayaran::findOrFail(Crypt::decryptString($id))->update($data);
        }

        return redirect()->route('metode-pembayaran.index')->with('success', 'Berhasil Ubah Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkData = MetodePembayaran::findOrFail(Crypt::decryptString($id));
        Storage::disk('public')->delete($checkData->icon);
        MetodePembayaran::findOrFail(Crypt::decryptString($id))->delete();
        return redirect()->back()->with('success', 'Berhasil Dihapus');
    }
}

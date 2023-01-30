<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataTentang = Tentang::first();
        return view('backend.pages.tentang.index', compact('dataTentang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
            'wa'               => 'required',
            'email'            => 'required|email',
            'alamat'           => 'required|min:5|string',
            'ig'               => 'required|min:5|string',
            'fb'               => 'required|min:5|string',
            'fb'               => 'required|min:5|string',
            'hero'             => 'max:2000|mimes:png,jpg',
            'price_desain'     => 'required|integer'
        ], $messages);

        $checkData = Tentang::findOrFail(Crypt::decryptString($id));

        if ($request->hero) {
            Storage::disk('public')->delete($checkData->hero);
            $data = array(
                'wa'        => $request->wa,
                'alamat'    => $request->alamat,
                'email'     => $request->email,
                'ig'        => $request->ig,
                'fb'        => $request->fb,
                'hero'      => $request->file('hero')->store('assets/tentang', 'public'),
                'price_desain'  => $request->price_desain
            );
            Tentang::findOrFail(Crypt::decryptString($id))->update($data);
        } else {
            $data = array(
                'wa'        => $request->wa,
                'alamat'    => $request->alamat,
                'email'     => $request->email,
                'ig'        => $request->ig,
                'fb'        => $request->fb,
                'price_desain'  => $request->price_desain
            );
            Tentang::findOrFail(Crypt::decryptString($id))->update($data);
        }

        return redirect()->route('tentang.index')->with('success', 'Berhasil Ubah Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

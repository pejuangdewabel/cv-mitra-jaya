<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUser = User::all();
        return view('backend.pages.user.index', compact('dataUser'));
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
        $dataUser = User::findOrFail(Crypt::decryptString($id));
        return view('backend.pages.user.edit', compact([
            'dataUser',
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
            'email'            => 'required|email',
            'nama'             => 'required|min:5',
            'no_telp'          => 'required|min:11|max:13',
        ], $messages);

        $checkData = User::findOrFail(Crypt::decryptString($id));

        if ($request->status == "on") {
            $status = 1;
        } else {
            $status = 2;
        }

        if ($request->foto) {
            Storage::disk('public')->delete($checkData->foto);
            $data = array(
                'email'           => $request->email,
                'nama'            => ucfirst($request->nama),
                'no_telp'         => '628' . substr($request->no_telp, 2),
                'alamat'          => $request->alamat,
                'foto'            => $request->file('foto')->store('assets/user', 'public'),
                'status'          => $status
            );
            User::findOrFail(Crypt::decryptString($id))->update($data);
        } else {
            $data = array(
                'email'           => $request->email,
                'nama'            => ucfirst($request->nama),
                'no_telp'         => '628' . substr($request->no_telp, 2),
                'alamat'          => $request->alamat,
                'status'          => $status
            );
            User::findOrFail(Crypt::decryptString($id))->update($data);
        }

        return redirect()->route('user.index')->with('success', 'Berhasil Ubah Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkData = User::findOrFail(Crypt::decryptString($id));
        Storage::disk('public')->delete($checkData->foto);
        User::findOrFail(Crypt::decryptString($id))->delete();
        return redirect()->back()->with('success', 'Berhasil Dihapus');
    }
}

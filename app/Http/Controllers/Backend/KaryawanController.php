<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataKaryawan = Karyawan::all();
        return view('backend.pages.karyawan.index', compact('dataKaryawan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.karyawan.create');
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
            'required'              => ':attribute wajib diisi',
            'min'                   => ':attribute harus diisi minimal digit :min ',
            'max'                   => ':attribute harus diisi maksimal :max karakter',
            'password.same'         => 'Password tidak sama',
            'confirmPassword.same'  => 'Konfrimasi Password tidak sama',
            'username.unique'       => 'Email Sudah Pernah Dipakai',
        ];

        $this->validate($request, [
            'username'          => 'required|min:5|unique:karyawan,username',
            'nama'              => 'required|string|min:3',
            'level'             => 'required',
            'foto'              => 'required|max:2000|mimes:png,jpg',
            'password'          => 'required|string|min:6',
            'confirmPassword'   => 'required|same:password|string|min:6',
        ], $messages);

        $data = array(
            'username'    => $request->username,
            'nama'        => ucfirst($request->nama),
            'level'       => $request->level,
            'password'    => Hash::make($request->password),
            'foto'        => $request->file('foto')->store('assets/karyawan', 'public'),
            'status'      => true
        );
        Karyawan::create($data);
        return redirect()->route('karyawan.index')->with('success', 'Berhasil Tambah Data');
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
        $dataKaryawan = Karyawan::findOrFail(Crypt::decryptString($id));
        return view('backend.pages.karyawan.edit', compact('dataKaryawan'));
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
            'required'              => ':attribute wajib diisi',
            'min'                   => ':attribute harus diisi minimal digit :min ',
            'max'                   => ':attribute harus diisi maksimal :max karakter',
        ];

        $this->validate($request, [
            'username'          => 'required|min:5',
            'nama'              => 'required|string|min:3',
            'level'             => 'required',
            'foto'              => 'max:2000|mimes:png,jpg',
        ], $messages);

        $checkData = Karyawan::findOrFail(Crypt::decryptString($id));

        if ($request->status == "on") {
            $status = true;
        } else {
            $status = false;
        }

        if ($request->foto) {
            Storage::disk('public')->delete($checkData->foto);
            $data = array(
                'username'    => $request->username,
                'nama'        => ucfirst($request->nama),
                'level'       => $request->level,
                'foto'        => $request->file('foto')->store('assets/karyawan', 'public'),
                'status'      => $status
            );
            Karyawan::findOrFail(Crypt::decryptString($id))->update($data);
            return redirect()->route('karyawan.index')->with('success', 'Berhasil Ubah Data');
        } else {
            $data = array(
                'username'    => $request->username,
                'nama'        => ucfirst($request->nama),
                'level'       => $request->level,
                'status'      => $status
            );
            Karyawan::findOrFail(Crypt::decryptString($id))->update($data);
            return redirect()->route('karyawan.index')->with('success', 'Berhasil Ubah Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkData = Karyawan::findOrFail(Crypt::decryptString($id));
        Storage::disk('public')->delete($checkData->foto);
        Karyawan::findOrFail(Crypt::decryptString($id))->delete();
        return redirect()->back()->with('success', 'Berhasil Dihapus');
    }
}

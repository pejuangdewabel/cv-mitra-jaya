<?php

namespace App\Http\Controllers\Backend;

use App\DetailProduk;
use App\DetailTransaksi;
use App\Http\Controllers\Controller;
use App\Keranjang;
use App\Produk;
use App\Tentang;
use App\Transaksi;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataTransaksi = Transaksi::with([
            'relasi_user',
            'relasi_karyawan'
        ])->where('status', '<', 4)
            ->latest()->get();

        return view('backend.pages.transaksi.index', compact('dataTransaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataUser = User::where('status', 1)->get();
        $dataProduk = DetailProduk::with([
            'produk'
        ])->get();

        $countKeranjang = [];

        if (Session::has('user_id')) {
            $keranjang = Keranjang::where('user_id', session()->get('user_id'))->latest()->get();
            $countKeranjang = Keranjang::where('user_id', session()->get('user_id'))->sum('sub_total');
        } else {
            $keranjang = array();
        }

        return view('backend.pages.transaksi.create', compact('dataProduk', 'dataUser', 'keranjang', 'countKeranjang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkDetailProduk = DetailProduk::with(['produk'])->findOrFail($request->produk_id);
        $priceDesain = Tentang::findOrFail(1);

        if ($checkDetailProduk->produk_id == 1) {
            $messages = [
                'required'  => ':attribute wajib diisi',
                'min'       => ':attribute harus diisi minimal digit :min ',
                'max'       => ':attribute harus diisi maksimal :max karakter',
                'not_in'    => 'Jumlah tidak boleh 0',
                'size1'     => 'Jumlah tidak boleh 0',
                'size2'     => 'Jumlah tidak boleh 0',
            ];

            $this->validate($request, [
                'user_id'          => 'required',
                'produk_id'        => 'required',
                'jumlah'           => 'required|integer|not_in:0',
                'size1'            => 'required|integer|not_in:0',
                'size2'            => 'required|integer|not_in:0',
            ], $messages);

            $perhitunganTotal = ($request->size1 * $request->size2) * ($checkDetailProduk->price);
            $totalGeneral = $perhitunganTotal * $request->jumlah;
            $totalWithDesain = $totalGeneral + $priceDesain->price_desain;

            if ($request->file_desain == null) {
                $data = array(
                    'user_id'       => $request->user_id,
                    'produk_id_detail'     => $request->produk_id,
                    'jumlah'        => $request->jumlah,
                    'sub_total'     => $totalWithDesain,
                    'file_desain'   => null,
                );
            } elseif ($request->file_desain != null) {
                $data = array(
                    'user_id'       => $request->user_id,
                    'produk_id_detail'     => $request->produk_id,
                    'jumlah'        => $request->jumlah,
                    'sub_total'     => $totalGeneral,
                    'file_desain'   => $request->file('file_desain')->store('assets/keranjang', 'public'),
                );
            }
            Keranjang::create($data);
        } else {
            $messages = [
                'required'  => ':attribute wajib diisi',
                'min'       => ':attribute harus diisi minimal digit :min ',
                'max'       => ':attribute harus diisi maksimal :max karakter',
                'not_in'    => 'Jumlah tidak boleh 0'
            ];

            $this->validate($request, [
                'user_id'          => 'required',
                'produk_id'        => 'required',
                'jumlah'           => 'required|integer|not_in:0',
            ], $messages);

            if ($request->file_desain == null) {
                $data = array(
                    'user_id'       => $request->user_id,
                    'produk_id_detail'     => $request->produk_id,
                    'jumlah'        => $request->jumlah,
                    'sub_total'     => ($request->jumlah * $checkDetailProduk->price) + $priceDesain->price_desain,
                    'file_desain'   => null,
                );
            } elseif ($request->file_desain != null) {
                $data = array(
                    'user_id'       => $request->user_id,
                    'produk_id_detail'     => $request->produk_id,
                    'jumlah'        => $request->jumlah,
                    'sub_total'     => ($request->jumlah * $checkDetailProduk->price),
                    'file_desain'   => $request->file('file_desain')->store('assets/keranjang', 'public'),
                );
            }
            Keranjang::create($data);
        }
        session()->put('user_id', $request->user_id);
        return redirect()->back()->with('success', 'Transaksi Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        session()->forget('user_id');
        return redirect()->back()->with('info', 'Berhasil di reset');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Transaksi::with([
            'relasi_user',
            'relasi_karyawan'
        ])->where('id', Crypt::decryptString($id))->first();
        $detail = DetailTransaksi::with([
            'relasi_tranksasi',
            'relasi_produk_detail'
        ])->where('transaksi_id', $data->id)->get();
        return view('backend.pages.transaksi.show', compact('data', 'detail'));
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
        $dataKeranjang = Keranjang::where('user_id', Crypt::decryptString($id))->get();

        $total = 0;

        foreach ($dataKeranjang as $dK) {
            $total += $dK->sub_total;
        }
        if ($request->bayar >= $total) {
            $dataTransaksi = array(
                'invoice'       => Carbon::now()->timestamp,
                'user_id'       => Crypt::decryptString($id),
                'karyawan_id'   => Auth::guard('karyawan')->user()->id,
                'total'         => $total,
                'bayar'         => $request->bayar,
                'kembalian'     => $request->bayar - $total,
                'metode_pembayaran_id' => 3,
                'status'        => 1
            );

            Transaksi::create($dataTransaksi);
        } else {
            return redirect()->back()->with('info', 'Bayar tidak boleh kurang dari total');
        }


        $dataLast = Transaksi::where('user_id', Crypt::decryptString($id))->latest()->first();

        foreach ($dataKeranjang as $dK) {
            if ($dK->file_desain != null) {
                $total += $dK->sub_total;
                $fileOld = Str::replaceArray('keranjang', ['transaksi'], $dK->file_desain);
                $dataDetailTransaksi = array(
                    'transaksi_id'  => $dataLast->id,
                    'produk_id_detail'     => $dK->produk_id_detail,
                    'jumlah'        => $dK->jumlah,
                    'sub_total'     => $dK->sub_total,
                    'file_desain'   => $fileOld,
                );
                DetailTransaksi::create($dataDetailTransaksi);
                Storage::disk('public')->move($dK->file_desain, $fileOld);
                $detail = new DetailTransaksiController();
                $detail->destroy(Crypt::encryptString($dK->id));
            } else {
                $total += $dK->sub_total;
                $dataDetailTransaksi = array(
                    'transaksi_id'  => $dataLast->id,
                    'produk_id_detail'     => $dK->produk_id_detail,
                    'jumlah'        => $dK->jumlah,
                    'sub_total'     => $dK->sub_total,
                    'file_desain'   => null,
                );
                DetailTransaksi::create($dataDetailTransaksi);

                $detail = new DetailTransaksiController();
                $detail->destroy(Crypt::encryptString($dK->id));
            }
        }
        session()->forget('user_id');
        return redirect()->route('transaksi.index')->with('success', 'Berhasil Tambah Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail(Crypt::decryptString($id));
        Storage::disk('public')->delete($transaksi->bukti_pembayaran);

        $detail = DetailTransaksi::where('transaksi_id', $transaksi->id)->get();

        foreach ($detail as $d) {
            Storage::disk('public')->delete($d->file_desain);
            DetailTransaksi::where('transaksi_id', $transaksi->id)->delete();
        }

        Transaksi::findOrFail(Crypt::decryptString($id))->delete();

        return redirect()->back()->with('success', 'Berhasil Dihapus');
    }

    public function uploadBukti(Request $request)
    {
        $data = array(
            'bukti_pembayaran' => $request->file('bukti_pembayaran')->store('assets/bukti-pembayaran', 'public'),
            'status'    => 1
        );
        Transaksi::where('id', Crypt::decryptString($request->id))->update($data);
        return redirect()->route('transaksi.index')->with('success', 'Berhasil Upload Bukti Pembayaran');
    }

    public function verifyACC($id)
    {
        $data = array(
            'status'        => 2,
            'karyawan_id'   => Auth::guard('karyawan')->user()->id
        );
        Transaksi::where('id', Crypt::decryptString($id))->update($data);
        return redirect()->route('transaksi.index')->with('success', 'Transaksi Diterima');
    }
    public function verifyReject($id)
    {
        $data = array(
            'status'    => 4
        );
        Transaksi::where('id', Crypt::decryptString($id))->update($data);
        return redirect()->route('transaksi.index')->with('error', 'Transaksi Ditolak');
    }
    public function verifyEnd($id)
    {
        $data = array(
            'status'    => 3
        );
        Transaksi::where('id', Crypt::decryptString($id))->update($data);
        return redirect()->route('transaksi.index')->with('success', 'Transaksi Selesai');
    }

    public function downloadFile(Request $request)
    {
        $data = DetailTransaksi::where('transaksi_id', Crypt::decryptString($request->id))->first();
        $path = "public/" . $data->file_desain;

        try {
            return Storage::disk('local')->download($path);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function printInvoice($id)
    {
        $transaksi = Transaksi::with([
            'relasi_karyawan',
            'relasi_user'
        ])->findOrFail(Crypt::decryptString($id));

        $detail = DetailTransaksi::where('transaksi_id', $transaksi->id)->get();
        $tentang = Tentang::findOrFail(1);
        $date = Carbon::now()->toDateTimeString();

        return view('backend.pages.print.invoice', compact('detail', 'transaksi', 'tentang', 'date'));
    }
}

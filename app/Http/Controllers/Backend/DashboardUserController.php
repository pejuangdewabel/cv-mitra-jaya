<?php

namespace App\Http\Controllers\Backend;

use App\DetailProduk;
use App\DetailTransaksi;
use App\Http\Controllers\Controller;
use App\Keranjang;
use App\MetodePembayaran;
use App\Produk;
use App\Tentang;
use App\Transaksi;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardUserController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['relasi_user', 'relasi_karyawan'])
            ->where('user_id', Auth::guard('user')->user()->id)
            ->get();
        $dataProduk = DetailProduk::with([
            'produk'
        ])->get();

        $listProduk = DetailProduk::with([
            'produk'
        ])->paginate(4);

        $keranjang = Keranjang::where('user_id', Auth::guard('user')->user()->id)->latest()->get();

        $countKeranjang = Keranjang::where('user_id', Auth::guard('user')->user()->id)->sum('sub_total');

        $metodePembayaran = MetodePembayaran::where('status', 1)->get();

        return view('backend.pages.user-pengguna.dashboard', compact(
            'transaksi',
            'dataProduk',
            'keranjang',
            'countKeranjang',
            'metodePembayaran',
            'listProduk'
        ));
    }

    public function checkout(Request $request)
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
                    'user_id'       => Crypt::decryptString($request->user_id),
                    'produk_id_detail'     => $request->produk_id,
                    'jumlah'        => $request->jumlah,
                    'sub_total'     => $totalWithDesain,
                    'ket'           => $request->size1 . 'x' . $request->size2 . '--' . $request->ket,
                    'file_desain'   => null,
                );
            } elseif ($request->file_desain != null) {
                $data = array(
                    'user_id'              => Crypt::decryptString($request->user_id),
                    'produk_id_detail'     => $request->produk_id,
                    'jumlah'               => $request->jumlah,
                    'sub_total'            => $totalGeneral,
                    'ket'                  => $request->size1 . 'x' . $request->size2 . '--' . $request->ket,
                    'file_desain'          => $request->file('file_desain')->store('assets/keranjang', 'public'),

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
                    'user_id'       => Crypt::decryptString($request->user_id),
                    'produk_id_detail'     => $request->produk_id,
                    'jumlah'        => $request->jumlah,
                    'sub_total'     => ($request->jumlah * $checkDetailProduk->price) + $priceDesain->price_desain,
                    'ket'           => $request->size1 . 'x' . $request->size2,
                    'file_desain'   => null,
                    'ket'           => $request->ket
                );
            } elseif ($request->file_desain != null) {
                $data = array(
                    'user_id'       => Crypt::decryptString($request->user_id),
                    'produk_id_detail'     => $request->produk_id,
                    'jumlah'        => $request->jumlah,
                    'sub_total'     => ($request->jumlah * $checkDetailProduk->price),
                    'ket'           => $request->size1 . 'x' . $request->size2,
                    'file_desain'   => $request->file('file_desain')->store('assets/keranjang', 'public'),
                    'ket'           => $request->ket
                );
            }
            Keranjang::create($data);
        }
        return redirect()->back()->with('success', 'Transaksi Berhasil');
    }

    public function downloadFile(Request $request)
    {
        $data = Keranjang::with(['relasi_user'])->where('id', Crypt::decryptString($request->id))->first();
        $path = "public/" . $data->file_desain;

        try {
            return Storage::disk('local')->download($path);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function dowloadFileTransaksi(Request $request)
    {
        $data = DetailTransaksi::with([
            'relasi_tranksasi',
            'relasi_produk'
        ])->where('id', Crypt::decryptString($request->id))->first();
        $path = "public/" . $data->file_desain;

        try {
            return Storage::disk('local')->download($path);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteCheckout($id)
    {
        $checkData = Keranjang::findOrFail(Crypt::decryptString($id));
        Storage::disk('public')->delete($checkData->file_desain);
        Keranjang::findOrFail(Crypt::decryptString($id))->delete();
        return redirect()->back()->with('success', 'Berhasil Dihapus');
    }

    public function processCheckout(Request $request)
    {
        $dataKeranjang = Keranjang::where('user_id', Auth::guard('user')->user()->id)->get();

        $total = 0;

        foreach ($dataKeranjang as $dK) {
            $total += $dK->sub_total;
        }

        if ($request->metodePembayaran == "3") {
            $status = 2;
        } else {
            $status = 0;
        }

        $dataTransaksi = array(
            'invoice'       => Carbon::now()->timestamp,
            'user_id'       => Auth::guard('user')->user()->id,
            'karyawan_id'   => 1,
            'total'         => $total,
            'bayar'         => $total,
            'kembalian'     => 0,
            'status'        => $status,
            'metode_pembayaran_id' => $request->metodePembayaran
        );

        Transaksi::create($dataTransaksi);

        $dataLast = Transaksi::where('user_id', Auth::guard('user')->user()->id)->latest()->first();

        foreach ($dataKeranjang as $dK) {
            $total += $dK->sub_total;
            if ($dK->file_desain) {
                $fileOld = Str::replaceArray('keranjang', ['transaksi'], $dK->file_desain);
                $dataDetailTransaksi = array(
                    'transaksi_id'  => $dataLast->id,
                    'produk_id_detail'     => $dK->produk_id_detail,
                    'jumlah'        => $dK->jumlah,
                    'sub_total'     => $dK->sub_total,
                    'file_desain'   => $fileOld,
                    'note'           => $dK->ket
                );
                DetailTransaksi::create($dataDetailTransaksi);
                Storage::disk('public')->move($dK->file_desain, $fileOld);
                $detail = new DetailTransaksiController();
                $detail->destroy(Crypt::encryptString($dK->id));
            } else {
                $dataDetailTransaksi = array(
                    'transaksi_id'  => $dataLast->id,
                    'produk_id_detail'     => $dK->produk_id_detail,
                    'jumlah'        => $dK->jumlah,
                    'sub_total'     => $dK->sub_total,
                    'file_desain'   => null,
                    'note'           => $dK->ket
                );
                DetailTransaksi::create($dataDetailTransaksi);
            }
        }
        Keranjang::where('user_id', Auth::guard('user')->user()->id)->delete();
        return redirect()->back()->with('success', 'Transaksi Sukses');
    }

    public function detailTransaksi($id)
    {
        $data = Transaksi::with([
            'relasi_user',
            'relasi_karyawan'
        ])->where('id', Crypt::decryptString($id))->first();
        $detail = DetailTransaksi::with([
            'relasi_tranksasi',
            'relasi_produk_detail'
        ])->where('transaksi_id', $data->id)->get();
        return view('backend.pages.user-pengguna.detail', compact('data', 'detail'));
    }

    public function uploadBuktiPembayaran(Request $request)
    {
        $data = array(
            'bukti_pembayaran'  => $request->file('bukti_pembayaran')->store('assets/bukti-pembayaran', 'public'),
            'status'            => 1
        );
        Transaksi::where('id', Crypt::decryptString($request->id))->update($data);
        return redirect()->back()->with('success', 'Bukti Pembayaran Berhasil di Upload');
    }

    public function cetakInvoiceUser($id)
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

    public function settingUser()
    {
        return view('backend.pages.user-pengguna.setting');
    }

    public function settingUserChange(Request $request)
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
            'nama'              => 'required|string|min:3',
            'no_telp'           => 'required|min:11|max:13'
        ], $messages);

        if ($request->password and $request->passwordConfirm) {
            if (Hash::check($request->password, Auth::guard('user')->user()->password)) {
                $data = array(
                    'nama'          => ucfirst($request->nama),
                    'password'      => Hash::make($request->passwordConfirm),
                    'no_telp'         => $request->no_telp
                );
                User::findOrFail(Auth::guard('user')->user()->id)->update($data);
            } else {
                return redirect()->back()->with('info', 'Password Salah');
            }
        } else {
            $data = array(
                'nama'          => ucfirst($request->nama),
                'no_telp'         => $request->no_telp
            );
            User::findOrFail(Auth::guard('user')->user()->id)->update($data);
        }
        return redirect()->back()->with('success', 'Berhasil Ubah Data Profile');
    }
}

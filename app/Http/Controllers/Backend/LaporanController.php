<?php

namespace App\Http\Controllers\Backend;

use App\DetailTransaksi;
use App\Http\Controllers\Controller;
use App\Tentang;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $dataTransaksi = [];
        $dateStart = '0000-00-00';
        $dateEnd = '0000-00-00';

        return view('backend.pages.laporan.index', compact('dataTransaksi', 'dateStart', 'dateEnd'));
    }

    public function filterDate(Request $request)
    {
        $dataTransaksi = Transaksi::whereDate('created_at', '>=', $request->dateStart)
            ->whereDate('created_at', '<=', $request->dateEnd)
            ->with([
                'relasi_user',
                'relasi_karyawan'
            ])->where('status', '=', 3)
            ->latest()->get();
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;

        return view('backend.pages.laporan.index', compact('dataTransaksi', 'dateStart', 'dateEnd'));
    }

    public function printInvoiceLaporan($id)
    {
        $transaksi = Transaksi::with([
            'relasi_karyawan',
            'relasi_user'
        ])->findOrFail(Crypt::decryptString($id));

        $detail = DetailTransaksi::where('transaksi_id', $transaksi->id)->get();
        $tentang = Tentang::findOrFail(1);
        $date = Carbon::now()->format('dmY');

        return view('backend.pages.print.invoice', compact('detail', 'transaksi', 'tentang', 'date'));

        // return PDF::loadHTML($this->adjustArabicAndPersianContent($html))
        // ->setPaper('a4')
        // ->download('invoice-' . $invoice->created_at->format('d-m-Y') . '.pdf');
    }

    public function printLaporan(Request $request)
    {
        $dataTransaksi = Transaksi::whereDate('created_at', '>=', $request->dateStart)
            ->whereDate('created_at', '<=', $request->dateEnd)
            ->with([
                'relasi_user',
                'relasi_karyawan'
            ])->where('status', '=', 3)
            ->latest()->get();
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;
        $date = Carbon::now()->format('dmY');

        // $pdf = PDF::loadView('backend.pages.laporan.contoh-invoice', compact('dataTransaksi', 'dateStart', 'dateEnd'));
        // return $pdf->download('Laporan-' . Carbon::now()->toDateTimeString() . '.pdf');
        return view('backend.pages.laporan.print', compact('dataTransaksi', 'dateStart', 'dateEnd'));
    }
}

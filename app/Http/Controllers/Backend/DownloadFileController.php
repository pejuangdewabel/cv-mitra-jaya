<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Keranjang;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class DownloadFileController extends Controller
{
    public function downloadFotoDesainKeranjang(Request $request)
    {
        $data = Keranjang::with(['relasi_user'])->where('id', Crypt::decryptString($request->id))->first();
        $path = "public/" . $data->file_desain;

        try {
            return Storage::disk('local')->download($path);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function testdownload()
    {
    }
}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan CV Mitra Jaya</title>

    <link href="{{ asset('assets/backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body onload="window.print()">
    <h3 class="text-center">Laporan Penjualan <br> CV Mitra Jaya</h3>
    <h6 class="text-center">
        Tanggal {{ tanggal_indonesia($dateStart, false) }}
        s/d
        Tanggal {{ tanggal_indonesia($dateEnd, false) }}
    </h6>
    <hr>

    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th width="5%" rowspan="2">No</th>
                <th scope="col" rowspan="2">Invoice</th>
                <th scope="col" rowspan="2">Tanggal Transaksi</th>
                <th scope="col" rowspan="2">Nama Pelanggan</th>
                <th scope="col" rowspan="2">Total</th>
                <th scope="col" colspan="3">Detail Pembelian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataTransaksi as $dT)
                @php
                    $detail = App\DetailTransaksi::with(['relasi_produk_detail'])
                        ->where('transaksi_id', $dT->id)
                        ->get();
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dT->invoice }}</td>
                    <td>{{ tanggal_indonesia(date('Y-m-d', strtotime($dT->created_at))) }}</td>
                    <td>{{ $dT->relasi_user->nama }}</td>
                    <td>{{ format_uang($dT->total) }}</td>
                    <td>
                    <td>
                        <table>
                            <tr>
                                <td>

                                </td>
                            </tr>

                        </table>
                        @foreach ($detail as $d)
                            <li>
                                {{ $d->relasi_produk_detail->desc }}
                                | {{ $d->jumlah }} | {{ format_uang($d->sub_total) }}
                            </li>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

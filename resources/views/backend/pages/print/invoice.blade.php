<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $date . '-' . $transaksi->invoice }}</title>

    <?php
    $style = '
                                                                                                                                                                                                                                                                                                                                    <style>
                                                                                                                                                                                                                                                                                                                                        * {
                                                                                                                                                                                                                                                                                                                                            font-family: "consolas", sans-serif;
                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                        p {
                                                                                                                                                                                                                                                                                                                                            display: block;
                                                                                                                                                                                                                                                                                                                                            margin: 3px;
                                                                                                                                                                                                                                                                                                                                            font-size: 10pt;
                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                        table td {
                                                                                                                                                                                                                                                                                                                                            font-size: 9pt;
                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                        .text-center {
                                                                                                                                                                                                                                                                                                                                            text-align: center;
                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                        .text-right {
                                                                                                                                                                                                                                                                                                                                            text-align: right;
                                                                                                                                                                                                                                                                                                                                        }

                                                                                                                                                                                                                                                                                                                                        @media print {
                                                                                                                                                                                                                                                                                                                                            @page {
                                                                                                                                                                                                                                                                                                                                                margin: 0;
                                                                                                                                                                                                                                                                                                                                                size: 75mm
                                                                                                                                                                                                                                                                                                                                    ';
    ?>
    <?php
    $style .= !empty($_COOKIE['innerHeight']) ? $_COOKIE['innerHeight'] . 'mm; }' : '}';
    ?>
    <?php
    $style .= '
                                                                                                                                                                                                                                                                                                                                            html, body {
                                                                                                                                                                                                                                                                                                                                                width: 70mm;
                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                            .btn-print {
                                                                                                                                                                                                                                                                                                                                                display: none;
                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                    </style>
                                                                                                                                                                                                                                                                                                                                    ';
    ?>

    {!! $style !!}
</head>

<body onload="window.print()">
    <button class="btn-print" style="position: absolute; right: 1rem; top: rem;" onclick="window.print()">Print</button>
    <div class="text-center">
        <h3 style="margin-bottom: 5px;">PERCETAKAN CV MITRA JAYA</h3>
        <p>{{ $tentang->alamat }}</p>
        <p>+{{ $tentang->wa }}</p>
    </div>
    <p class="text-center">
        <hr>
    </p>
    {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate('http://google.com')) !!} "> --}}
    <br>
    <div>
        <p style="float: left;">{{ date('d-m-Y') }}</p>
        <p style="float: right">{{ $transaksi->relasi_user->nama }}</p>
    </div>
    <div class="clear-both" style="clear: both;"></div>
    <p>No: {{ $transaksi->invoice }}</p>
    <p class="text-center">===================================</p>

    <br>
    <table width="100%" style="border: 0;">
        <tr>
            <td>No</td>
            <td>Produk</td>
            <td>Jumlah</td>
            <td>Subtotal</td>
        </tr>
        @foreach ($detail as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->relasi_produk_detail->desc }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ format_uang($item->sub_total) }}</td>
            </tr>
        @endforeach
    </table>
    <p class="text-center">-----------------------------------</p>

    <table width="100%" style="border: 0;">
        <tr>
            <td>Total Harga:</td>
            <td class="text-right">{{ format_uang($transaksi->total) }}</td>
        </tr>
        <tr>
            <td>Total Item:</td>
            <td class="text-right">{{ $detail->count() }}</td>
        </tr>
        <tr>
            <td>Bayar:</td>
            <td class="text-right">{{ format_uang($transaksi->bayar) }}</td>
        </tr>
        <tr>
            <td>Kembali:</td>
            <td class="text-right">{{ format_uang($transaksi->kembalian) }}</td>
        </tr>
    </table>

    <p class="text-center">===================================</p>
    <p class="text-center">Petugas : {{ $transaksi->relasi_karyawan->nama }}</p>
    <p class="text-center">-- TERIMA KASIH --</p>

    <br>
    <div class="visible-print text-center">
        {!! QrCode::size(100)->generate($transaksi->invoice) !!}
    </div>

    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
            body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight
        );

        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight=" + ((height + 50) * 0.264583);
    </script>
</body>

</html>

@extends('backend.layouts.app')
@push('after-link')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="pagetitle">
        <h1>Dashboard Pelanggan | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>
    <div class="row">
        @foreach ($listProduk as $dpr)
            <div class="col-lg-3">
                <!-- Card with an image on top -->
                <div class="card">
                    <img src="{{ Storage::url($dpr->produk->foto) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $dpr->desc }}</h5>
                        <p>{{ $dpr->produk->relasi_kategori->nama }}</p>
                        <p><span class="badge bg-primary">{{ format_uang($dpr->price) }}</span></p>
                        <p>Terjual : {{ App\DetailTransaksi::where('produk_id_detail', $dpr->produk->id)->sum('jumlah') }}
                        </p>
                        <p>Waktu Pengerjaan : {{ $dpr->produk->waktu_pengerjaan }} hari</p>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#{{ $dpr->produk->slug }}" aria-expanded="false"
                                        aria-controls="collapseOne">
                                        Deskripsi :
                                    </button>
                                </h2>
                                <div id="{{ $dpr->produk->slug }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        <p class="card-text">
                                            {!! $dpr->produk->deskripsi !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Card with an image on top -->
            </div>
        @endforeach
        {{ $listProduk->links() }}
    </div>


    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-12">
                    <div class="card top-selling">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Form Checkout Transaksi</h5>
                            <form class="row g-3" method="POST" action="{{ route('dashboard-checkout') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ Crypt::encryptString(Auth::guard('user')->user()->id) }}"
                                    name="user_id">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <select name="produk_id" id="produk_id" class="form-select js-example-basic-single"
                                            required>
                                            <option disabled selected></option>
                                            @foreach ($dataProduk as $dP)
                                                <option value="{{ $dP->id }}">{{ $dP->desc }} |
                                                    {{ format_uang($dP->price) }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <label for="produk_id">Pilih Produk</label> --}}
                                        @error('produk_id')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="size1" id="size1"
                                            placeholder="Size Awal" required value="0">
                                        <label for="size1">Panjang</label>
                                        @error('size1')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="size2" id="size2"
                                            placeholder="Size Akhir" required value="0">
                                        <label for="size2">Lebar</label>
                                        @error('size2')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="jumlah" id="jumlah"
                                            placeholder="Jumlah" required value="{{ old('jumlah') }}">
                                        <label for="jumlah">Jumlah</label>
                                        @error('jumlah')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" name="file_desain" id="file_desain"
                                            placeholder="FIie Desain">
                                        <label for="file_desain">File Desain</label>
                                        @error('file_desain')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="ket" id="ket"
                                            placeholder="Keterangan">
                                        <label for="ket">Keterangan</label>
                                        @error('ket')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                </div>
                            </form>
                            <hr>

                            <h5 class="card-title">Keranjang Transaksi</h5>

                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Sub Total</th>
                                        <th scope="col">Ukuran</th>
                                        <th scope="col">File Desain</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (empty($keranjang))
                                        <tr>
                                            <th>
                                                ---
                                            </th>
                                            <td>
                                                ---
                                            </td>
                                            <td>
                                                ---
                                            </td>
                                            <td>
                                                ---
                                            </td>
                                            <td>
                                                ---
                                            </td>
                                            <td>
                                                ---
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($keranjang as $k)
                                            <tr>
                                                <th scope="row">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td>
                                                    {{ $k->relasi_produk_detail->desc }}
                                                </td>
                                                <td>
                                                    {{ $k->jumlah }}
                                                </td>
                                                <td>
                                                    {{ format_uang($k->relasi_produk_detail->price) }}
                                                </td>
                                                <td class="fw-bold text-right">
                                                    {{ format_uang($k->sub_total) }}
                                                </td>
                                                <td class="fw-bold text-right">
                                                    {{ $k->ket }}
                                                </td>
                                                <td>
                                                    @if ($k->file_desain)
                                                        <form action="{{ route('download-file-user') }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ Crypt::encryptString($k->id) }}">
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                target="_blank">
                                                                <i class="bi bi-capslock-fill"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        ---
                                                    @endif
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('delete-checkout', Crypt::encryptString($k->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="fw-bold text-left">Total Pembayaran</td>
                                            <td class="fw-bold text-right">{{ format_uang($countKeranjang) }}</td>
                                        </tr>
                                    @endif

                                    {{-- <tr>
                                        <td colspan="3" class="fw-bold text-left">Total Pembayaran</td>
                                        <td class="fw-bold text-right">{{ format_uang($countKeranjang) }}</td>
                                    </tr> --}}
                                </tbody>
                            </table>
                            <hr>
                            @if ($keranjang->isEmpty())
                            @else
                                <form class="row g-3" action="{{ route('process-checkout') }}" method="post">
                                    @csrf
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <select name="metodePembayaran" id="metodePembayaran" class="form-select"
                                                required>
                                                <option selected disabled>PILIH</option>
                                                @foreach ($metodePembayaran as $mP)
                                                    <option value="{{ $mP->id }}">{{ $mP->nama_pembayaran }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="metodePembayaran">Metode Pembayaran</label>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" name="bayar" id="bayar"
                                                placeholder="Uang Bayar" required>
                                            <label for="file_desain">Uang Bayar</label>
                                        </div>
                                    </div> --}}
                                    <button type="submit" class="btn btn-success w-100">SELESAIKAN TRANSAKSI</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-12">
                    <div class="card top-selling">
                        <div class="card-body pb-0">
                            <h5 class="card-title">List Riwayat Transaksi</h5>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Invoice</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transaksi as $dP)
                                        <tr>
                                            <th scope="row">
                                                {{ $dP->invoice }}
                                            </th>
                                            <td>
                                                {{ format_uang($dP->total) }}
                                            </td>
                                            <td class="fw-bold">
                                                @if ($dP->status == 0)
                                                    <span class="badge bg-danger">Belum Bayar</span>
                                                @elseif($dP->status == 1)
                                                    <span class="badge bg-primary">Sudah Bayar</span>
                                                @elseif($dP->status == 2)
                                                    <span class="badge bg-warning">Proses Pengerjaan</span>
                                                @elseif($dP->status == 3)
                                                    <span class="badge bg-success">Selesai</span>
                                                @elseif($dP->status == 4)
                                                    <span class="badge bg-danger">Bukti Pembayaran Ditolak</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($dP->status != 4)
                                                    <a href="{{ route('detail-transaksi', Crypt::encryptString($dP->id)) }}"
                                                        class="btn btn-primary btn-sm">Lihat</a>
                                                    @if ($dP->status >= 1)
                                                        <a href="{{ route('cetak-invoice-user', Crypt::encryptString($dP->id)) }}"
                                                            class="btn btn-success btn-sm" target="_BLANK">Print
                                                            Invoice</a>
                                                    @endif
                                                @else
                                                    ---
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th>---</th>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('after-script')
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#produk_id').select2({
                placeholder: "Pilih Produk",
                allowClear: true,
                width: 'resolve',
                theme: "classic"
            });
        });
    </script>
@endpush

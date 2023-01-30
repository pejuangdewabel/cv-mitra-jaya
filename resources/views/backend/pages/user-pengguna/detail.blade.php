@extends('backend.layouts.app')
@push('after-link')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="pagetitle">
        <h1>TRANSAKSI | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>
    @php
        $mP = App\MetodePembayaran::where('id', $data->metode_pembayaran_id)->first();
    @endphp
    @if ($data->status == 0 and $data->metode_pembayaran_id != 3)
        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
            TRANSAKSI BELUM SELESAI, SEGERA MELAKUKAN PEMBAYARAN
        </div>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <img src="{{ Storage::url($mP->icon) }}" style="max-width: 50px !important">
                        Detail Metode Pembayaran
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample" style="">
                    <div class="accordion-body">
                        <table class="table">
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td>:</td>
                                <td>{{ $mP->nama_pembayaran }}</td>
                                <td>No Akun</td>
                                <td>:</td>
                                <td>{{ $mP->no_akun }}</td>
                                <td>Atas Nama</td>
                                <td>:</td>
                                <td>{{ $mP->an }}</td>
                            </tr>
                        </table>
                        <form class="row g-3" action="{{ route('upload-bukti-pembayaran') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ Crypt::encryptString($data->id) }}">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran"
                                        placeholder="Bukti Pembayaran" required>
                                    <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Upload Bukti Pembayaran</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <hr>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('dashboard-user') }}" class="btn btn-success btn-sm">
                            <i class="bi bi-arrow-left-circle"></i>
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Detail Transaksi | <strong>{{ $data->invoice }}</strong></h5>

                        <!-- Floating Labels Form -->
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <td>Invoice</td>
                                    <td>:</td>
                                    <td>{{ $data->invoice }}</td>
                                </tr>
                                <tr>
                                    <td>Pembeli</td>
                                    <td>:</td>
                                    <td>{{ $data->relasi_user->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Total Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ format_uang($data->total) }}</td>
                                </tr>
                                <tr>
                                    <td>Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ format_uang($data->bayar) }}</td>
                                </tr>
                                <tr>
                                    <td>Kembalian</td>
                                    <td>:</td>
                                    <td>{{ format_uang($data->kembalian) }}</td>
                                </tr>
                                <tr>
                                    <td>Metode Pembayaran</td>
                                    <td>:</td>
                                    <td>
                                        <img src="{{ Storage::url($data->relasi_metode_pembayaran->icon) }}"
                                            style="max-width: 30px !important">
                                        {{ $data->relasi_metode_pembayaran->nama_pembayaran }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>
                                        @if ($data->status == 0)
                                            <span class="badge bg-danger">Belum Bayar</span>
                                        @elseif($data->status == 1)
                                            <span class="badge bg-primary">Sudah Bayar</span>
                                        @elseif($data->status == 2)
                                            <span class="badge bg-warning">Proses Pengerjaan</span>
                                        @elseif($data->status == 3)
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bukti Pembayaran</td>
                                    <td>:</td>
                                    <td>
                                        @if ($data->bukti_pembayaran == null)
                                            ---
                                        @else
                                            <img src="{{ Storage::url($data->bukti_pembayaran) }}" class="img-thumbnail"
                                                style="max-width: 150px;">
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Transaksi | <strong>{{ $data->invoice }}</strong></h5>

                        <!-- Floating Labels Form -->
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Sub Total</th>
                                        <th>Catatan</th>
                                        <th>File Desain</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->relasi_produk_detail->desc }}</td>
                                            <td>{{ $d->jumlah }}</td>
                                            <td>{{ format_uang($d->sub_total) }}</td>
                                            <td>{{ $d->note }}</td>
                                            <td>
                                                @if ($d->file_desain)
                                                    <form action="{{ route('download-file-transaksi-user') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ Crypt::encryptString($d->id) }}">
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            target="_blank">
                                                            <i class="bi bi-capslock-fill"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    ----
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
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
            $('#user_id').select2({
                placeholder: "Pilih User",
                allowClear: true,
                width: 'resolve',
                theme: "classic"
            });
            $('#produk_id').select2({
                placeholder: "Pilih Produk",
                allowClear: true,
                width: 'resolve',
                theme: "classic"
            });
        });
    </script>
@endpush

@extends('backend.layouts.app')
@push('after-link')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="pagetitle">
        <h1>TRANSAKSI | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-success btn-sm">
                            <i class="bi bi-arrow-left-circle"></i>
                            Kembali
                        </a>
                        @if (Session::has('user_id'))
                            <a href="{{ route('transaksi.show', session()->get('user_id')) }}"
                                class="btn btn-warning btn-sm">
                                <i class="bi bi-arrow-left-circle"></i>
                                RESET
                            </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Data Transaksi | <strong>{{ $data->invoice }}</strong></h5>

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
                                <tr>
                                    <td>Petugas</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->relasi_karyawan->nama }}
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
                                        <th>NO</th>
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
                                                @if ($d->file_desain != null)
                                                    <form action="{{ route('download-file') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ Crypt::encryptString($data->id) }}">
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="bi bi-capslock-fill"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    ---
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

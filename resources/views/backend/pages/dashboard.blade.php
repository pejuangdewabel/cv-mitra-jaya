@extends('backend.layouts.app')
@push('after-link')
@endpush

@section('content')
    <div class="pagetitle">
        <h1>Dashboard | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Jenis Produk</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $countKategori }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Produk</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-bag-check-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $countProduk }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Transaksi</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-calculator-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $countTransaksi }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-12">
                    <div class="card top-selling">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Transaksi yang belum selesai</h5>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Invoice</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transaksiPennding as $dP)
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
@endpush

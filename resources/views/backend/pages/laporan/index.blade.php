@extends('backend.layouts.app')
@push('after-link')
@endpush
@section('content')
    <div class="pagetitle">
        <h1>Riwayat Laporan Transaksi | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-12">
                    <div class="card top-selling">
                        <div class="card-body pb-0">
                            <div class="card-title">
                                <form action="{{ route('laporan-filter') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="">Tanggal Awal</label>
                                            <input type="date" name="dateStart" class="form-control"
                                                value="{{ $dateStart }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Tanggal Akhir</label>
                                            <input type="date" name="dateEnd" class="form-control"
                                                value="{{ $dateEnd }}">
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-sm mt-2">
                                                FILTER DATA
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @if ($dataTransaksi != null)
                                    <form action="{{ route('laporan-print') }}" method="post">
                                        @csrf
                                        <div class="row mt-2">
                                            <input type="hidden" name="dateStart" class="form-control"
                                                value="{{ $dateStart }}">
                                            <input type="hidden" name="dateEnd" class="form-control"
                                                value="{{ $dateEnd }}">
                                            <div class="col-md-6">
                                                <button class="btn btn-success btn-sm" type="submit">CETAK LAPORAN</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                @endif
                            </div>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Invoice</th>
                                        <th scope="col">Tanggal Transaksi</th>
                                        <th scope="col">Nama Pelanggan</th>
                                        <th scope="col">Total</th>
                                        {{-- <th scope="col">Bayar</th>
                                        <th scope="col">Kembalian</th>
                                        <th scope="col">PJ Karyawan</th> --}}
                                        <th scope="col">Status</th>
                                        <th scope="col">Cetak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataTransaksi as $dT)
                                        <tr>
                                            <td>{{ $dT->invoice }}</td>
                                            <td>{{ tanggal_indonesia(date('Y-m-d', strtotime($dT->created_at))) }}</td>
                                            <td>{{ $dT->relasi_user->nama }}</td>
                                            <td>{{ format_uang($dT->total) }}</td>
                                            {{-- <td>{{ format_uang($dT->bayar) }}</td>
                                            <td>{{ format_uang($dT->kembalian) }}</td>
                                            <td>{{ $dT->relasi_karyawan->nama }}</td> --}}
                                            <td>
                                                @if ($dT->status == 0)
                                                    <span class="badge bg-danger">Belum Bayar</span>
                                                @elseif($dT->status == 1)
                                                    <span class="badge bg-primary">Sudah Bayar</span>
                                                @elseif($dT->status == 2)
                                                    <span class="badge bg-warning">Proses Pengerjaan</span>
                                                @elseif($dT->status == 3)
                                                    <span class="badge bg-success">Selesai</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('laporan-invoice', Crypt::encryptString($dT->id)) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="bi bi-printer"></i>
                                                </a>
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
@endpush

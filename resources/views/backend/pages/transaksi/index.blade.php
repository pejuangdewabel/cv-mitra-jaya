@extends('backend.layouts.app')
@push('after-link')
@endpush
@section('content')
    <div class="pagetitle">
        <h1>TRANSAKSI PRODUK | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-12">
                    <div class="card top-selling">
                        <div class="card-body pb-0">
                            <div class="card-title">
                                <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i>
                                    Tambah Data
                                </a>
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
                                        <th scope="col">Bukti Pembayaran</th>
                                        <th scope="col">Verifikasi</th>
                                        <th scope="col">Aksi</th>
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
                                                @elseif($dT->status == 4)
                                                    <span class="badge bg-warning">Bukti Pembayaran Ditolak</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($dT->status == 0)
                                                    <form action="{{ route('uploadBukti') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id"
                                                            value="{{ Crypt::encryptString($dT->id) }}">
                                                        <div class="form-group">
                                                            <input type="file" name="bukti_pembayaran"
                                                                id="bukti_pembayaran" class="form-control" required>
                                                        </div>
                                                        <br>
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            UPLOAD
                                                        </button>
                                                    </form>
                                                @elseif($dT->bukti_pembayaran)
                                                    <img src="{{ Storage::url($dT->bukti_pembayaran) }}"
                                                        class="img-thumbnail" style="max-width: 150px;">
                                                @else
                                                    ---------
                                                @endif
                                            </td>
                                            <td>
                                                @if ($dT->status == 1)
                                                    <a href="{{ route('verify-acc-transaksi', Crypt::encryptString($dT->id)) }}"
                                                        class="btn btn-success btn-sm">
                                                        <i class="bi bi-check-circle"></i>
                                                    </a>
                                                    <br>
                                                    <br>
                                                    <a href="{{ route('verify-reject-transaksi', Crypt::encryptString($dT->id)) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="bi bi-x-circle"></i>
                                                    </a>
                                                    <br>
                                                    <br>
                                                @elseif($dT->status == 2)
                                                    <a href="{{ route('verify-end-transaksi', Crypt::encryptString($dT->id)) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="bi bi-shield-check"></i>
                                                    </a>
                                                @else
                                                    ---
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('transaksi.edit', Crypt::encryptString($dT->id)) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <br>
                                                <br>
                                                <a href="{{ route('printInvoice-backend', Crypt::encryptString($dT->id)) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="bi bi-printer"></i>
                                                </a>
                                                <br>
                                                <br>
                                                <a href="https://wa.me/628{{ substr($dT->relasi_user->no_telp, 2) }}"
                                                    class="btn btn-success btn-sm" target="_BLANK">
                                                    <i class="bi bi-whatsapp"></i>
                                                </a>
                                                <br>
                                                <br>
                                                <form
                                                    action="{{ route('transaksi.destroy', Crypt::encryptString($dT->id)) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
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

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
                        <h5 class="card-title">Form Tambah Transaksi Pemesanan</h5>

                        <!-- Floating Labels Form -->
                        <form class="row g-3" method="POST" action="{{ route('transaksi.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                @if (Session::has('user_id'))
                                    <div class="form-floating">
                                        @php
                                            $dataUser2 = App\User::where('id', session()->get('user_id'))->first();
                                        @endphp
                                        <input type="text" value="{{ $dataUser2->nama }}" class="form-control" readonly>
                                        <input type="hidden" value="{{ session()->get('user_id') }}" name="user_id">
                                        <label for="jumlah">Nama User</label>
                                    </div>
                                @else
                                    <div class="form-floating">
                                        <select name="user_id" id="user_id" class="form-select js-example-basic-single"
                                            required>
                                            <option disabled selected></option>
                                            @foreach ($dataUser as $dU)
                                                <option value="{{ $dU->id }}">{{ $dU->nama }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <label for="produk_id">Pilih Produk</label> --}}
                                        @error('user_id')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="produk_id" id="produk_id" class="form-select js-example-basic-single"
                                        required>
                                        <option disabled selected></option>
                                        @foreach ($dataProduk as $dP)
                                            <option value="{{ $dP->id }}">{{ $dP->produk->nama }} |
                                                {{ $dP->desc }} | {{ format_uang($dP->price) }}</option>
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
                            <div class="col-md-4">
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
                            <div class="col-md-4">
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
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card top-selling">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Detail Transaksi
                            @if (Session::has('user_id'))
                                @php
                                    $dataUser = App\User::where('id', session()->get('user_id'))->first();
                                @endphp
                                <strong>
                                    : {{ $dataUser->nama }}
                                </strong>
                            @else
                            @endif
                        </h5>

                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">File Desain</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (Session::has('user_id'))
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
                                            <td class="fw-bold text-right">
                                                {{ format_uang($k->sub_total) }}
                                            </td>
                                            <td>
                                                @if ($k->file_desain != null)
                                                    <form action="{{ route('download-foto-desain-keranjang') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ Crypt::encryptString($k->id) }}">
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            target="_blank">
                                                            <i class="bi bi-capslock-fill"></i>
                                                            DOWNLOAD FILE</button>
                                                    </form>
                                                @else
                                                    ---
                                                @endif
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('detail-transaksi.destroy', Crypt::encryptString($k->id)) }}"
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
                                        <td colspan="3" class="fw-bold text-left">Total Pembayaran</td>
                                        <td class="fw-bold text-right">{{ format_uang($countKeranjang) }}</td>
                                    </tr>
                                @else
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
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <hr>
                        @if (Session::has('user_id'))
                            <form class="row g-3"
                                action="{{ route('transaksi.update', Crypt::encryptString(session()->get('user_id'))) }}"
                                method="post">
                                @csrf
                                @method('PATCH')
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="bayar" id="bayar"
                                            placeholder="Uang Bayar" required>
                                        <label for="file_desain">Uang Bayar</label>
                                    </div>
                                </div>
                                <button class="btn btn-success w-100">SELESAIKAN TRANSAKSI</button>
                            </form>
                        @else
                        @endif
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

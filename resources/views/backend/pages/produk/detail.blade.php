@extends('backend.layouts.app')
@push('after-link')
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
@endpush
@section('content')
    <div class="pagetitle">
        <h1>PRODUK | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('produk.index') }}" class="btn btn-success btn-sm">
                            <i class="bi bi-arrow-left-circle"></i>
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Form Tambah Detail Data Produk</h5>

                        <!-- Floating Labels Form -->
                        <form class="row g-3" method="POST" action="{{ route('produk.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama Kategori" required value="{{ $dataProduk->nama }}" readonly>
                                    <label for="nama">Nama Produk</label>
                                    @error('nama')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama Kategori" required
                                        value="{{ $dataProduk->relasi_kategori->nama }}" readonly>
                                    <label for="nama">Kategori</label>
                                    @error('nama')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </form>
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
                            <h5 class="card-title">Tambah Detail Produk</h5>
                            <form class="row g-3" method="POST" action="{{ route('detail-produk.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" name="idProduk" id="idProduk"
                                    value="{{ Crypt::encryptString($dataProduk->id) }}" readonly>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="desc" id="desc"
                                            placeholder="Desc" required value="{{ old('desc') }}">
                                        <label for="desc">Deskripsi</label>
                                        @error('desc')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="price" id="price"
                                            placeholder="Price" required value="{{ old('price') }}">
                                        <label for="price">Harga</label>
                                        @error('price')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="note" id="note"
                                            placeholder="note" value="{{ old('note') }}">
                                        <label for="note">Catatan</label>
                                        @error('note')
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
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Note</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (empty($dataDetailProduk))
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
                                    @else
                                        @foreach ($dataDetailProduk as $k)
                                            <tr>
                                                <th scope="row">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td>
                                                    {{ $k->produk->nama }}
                                                </td>
                                                <td>
                                                    {{ $k->desc }}
                                                </td>
                                                <td>
                                                    {{ format_uang($k->price) }}
                                                </td>
                                                <td>
                                                    {{ $k->note ? $k->note : '---' }}
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('detail-produk.destroy', Crypt::encryptString($k->id)) }}"
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
                                    @endif
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
    <script>
        CKEDITOR.replace('deskripsi');
    </script>
@endpush

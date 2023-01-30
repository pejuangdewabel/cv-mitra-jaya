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
                        <h5 class="card-title">Form Tambah Data Produk</h5>

                        <!-- Floating Labels Form -->
                        <form class="row g-3" method="POST" action="{{ route('produk.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="kategori_id" id="kategori_id" class="form-select" required>
                                        <option disabled selected></option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                        @endforeach
                                    </select>
                                    <label for="kategori_id">Pilih Kategori</label>
                                    @error('kategori_id')
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
                                        placeholder="Nama Kategori" required value="{{ old('nama') }}">
                                    <label for="nama">Nama Produk</label>
                                    @error('nama')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="hidden" class="form-control" name="harga" id="harga"
                                        placeholder="Harga Kategori" required value="0">
                                    <label for="harga">Harga Produk</label>
                                    @error('harga')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="file" class="form-control" name="foto" id="foto"
                                        placeholder="Foto" required>
                                    <label for="foto">Foto</label>
                                    @error('foto')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" required></textarea>
                                @error('deskripsi')
                                    <span class="badge bg-danger">
                                        <i class="bi bi-exclamation-octagon me-1"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="waktu_pengerjaan" id="waktu_pengerjaan"
                                        placeholder="Waktu Pengerjaan" required value="{{ old('waktu_pengerjaan') }}">
                                    <label for="waktu_pengerjaan">Waktu Pengerjaan</label>
                                    @error('waktu_pengerjaan')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="status" name="status"
                                            checked>
                                        <label class="form-check-label" for="status">Status</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
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

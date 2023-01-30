@extends('backend.layouts.app')
@push('after-link')
@endpush
@section('content')
    <div class="pagetitle">
        <h1>KATEGORI PRODUK | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>

    <section class="section dashboard">
        <img src="{{ Storage::url($dataKategori->icon) }}" class="img-thumbnail" style="max-width: 50px !important">
        <br>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('kategori.index') }}" class="btn btn-success btn-sm">
                            <i class="bi bi-arrow-left-circle"></i>
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Form Ubah Data Kategori Produk</h5>
                        <!-- Floating Labels Form -->
                        <form class="row g-3" method="POST"
                            action="{{ route('kategori.update', Crypt::encryptString($dataKategori->id)) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama Kategori" required value="{{ $dataKategori->nama }}">
                                    <label for="nama">Nama Jenis</label>
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
                                    <input type="file" class="form-control" name="icon" id="icon"
                                        placeholder="Icon">
                                    <label for="icon">Icon</label>
                                    @error('icon')
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
                                            {{ $dataKategori->status == true ? 'checked' : '' }}>
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
@endpush

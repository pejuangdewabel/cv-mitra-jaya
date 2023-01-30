@extends('backend.layouts.app')
@push('after-link')
@endpush
@section('content')
    <div class="pagetitle">
        <h1>METODE PEMBAYARAN | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>
    <section class="section dashboard">
        <img src="{{ Storage::url($dataMP->icon) }}" class="img-thumbnail" style="max-width: 100px !important">
        <br>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('metode-pembayaran.index') }}" class="btn btn-success btn-sm">
                            <i class="bi bi-arrow-left-circle"></i>
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Form Tambah Data METODE PEMBAYARAN</h5>

                        <!-- Floating Labels Form -->
                        <form class="row g-3" method="POST"
                            action="{{ route('metode-pembayaran.update', Crypt::encryptString($dataMP->id)) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="nama_pembayaran" id="nama_pembayaran"
                                        placeholder="Nama Pembayaran" required value="{{ $dataMP->nama_pembayaran }}">
                                    <label for="nama_pembayaran">Nama Pembayaran</label>
                                    @error('nama_pembayaran')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="no_akun" id="no_akun"
                                        placeholder="No Akun" required value="{{ $dataMP->no_akun }}">
                                    <label for="no_akun">No Akun</label>
                                    @error('no_akun')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="an" id="an"
                                        placeholder="Atas Nama" required value="{{ $dataMP->an }}">
                                    <label for="an">Atas Nama</label>
                                    @error('an')
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
                                            {{ $dataMP->status == true ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status">Status</label>
                                        @error('status')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                {{ $message }}
                                            </span>
                                        @enderror
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

@extends('backend.layouts.app')
@push('after-link')
@endpush
@section('content')
    <div class="pagetitle">
        <h1>USER | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>
    <section class="section dashboard">
        <img src="{{ Storage::url($dataUser->foto) }}" class="img-thumbnail" style="max-width: 100px !important">
        <br>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('user.index') }}" class="btn btn-success btn-sm">
                            <i class="bi bi-arrow-left-circle"></i>
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Form Tambah Data Ubah</h5>

                        <!-- Floating Labels Form -->
                        <form class="row g-3" method="POST"
                            action="{{ route('user.update', Crypt::encryptString($dataUser->id)) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Email" required value="{{ $dataUser->email }}">
                                    <label for="email">Email</label>
                                    @error('email')
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
                                        placeholder="Nama" required value="{{ $dataUser->nama }}">
                                    <label for="nama">Nama</label>
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
                                    <input type="number" class="form-control" name="no_telp" id="no_telp"
                                        placeholder="No Telp" required value="{{ $dataUser->no_telp }}">
                                    <label for="no_telp">No Telp</label>
                                    @error('no_telp')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="alamat" id="alamat"
                                        placeholder="Alamat" value="{{ $dataUser->alamat }}">
                                    <label for="alamat">Alamat</label>
                                    @error('alamat')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="file" class="form-control" name="foto" id="foto"
                                        placeholder="Foto">
                                    <label for="foto">Foto</label>
                                    @error('foto')
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
                                            {{ $dataUser->status == 1 ? 'checked' : '' }}>
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

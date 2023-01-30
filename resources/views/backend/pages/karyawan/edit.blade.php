@extends('backend.layouts.app')
@push('after-link')
@endpush
@section('content')
    <div class="pagetitle">
        <h1>KARYAWAN | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>

    <section class="section dashboard">
        <img src="{{ Storage::url($dataKaryawan->foto) }}" class="img-thumbnail" style="max-width: 100px !important">
        <br>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('karyawan.index') }}" class="btn btn-success btn-sm">
                            <i class="bi bi-arrow-left-circle"></i>
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Form Ubah Data Karyawan</h5>
                        <!-- Floating Labels Form -->
                        <form class="row g-3" method="POST"
                            action="{{ route('karyawan.update', Crypt::encryptString($dataKaryawan->id)) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Username" required value="{{ $dataKaryawan->username }}">
                                    <label for="username">Username</label>
                                    @error('username')
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
                                        placeholder="Nama" required value="{{ $dataKaryawan->nama }}">
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
                                    <select name="level" id="level" class="form-select" required>
                                        @if ($dataKaryawan->level == 1)
                                            <option value="1" selected>ADMIN</option>
                                            <option value="2">OPERATOR</option>
                                            <option value="3">PIMPINAN</option>
                                        @elseif($dataKaryawan->level == 2)
                                            <option value="1">ADMIN</option>
                                            <option value="2" selected>OPERATOR</option>
                                            <option value="3">PIMPINAN</option>
                                        @elseif($dataKaryawan->level == 3)
                                            <option value="1">ADMIN</option>
                                            <option value="2">OPERATOR</option>
                                            <option value="3" selected>PIMPINAN</option>
                                        @endif
                                    </select>
                                    <label for="level">Level</label>
                                    @error('level')
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
                            {{-- <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="oldPassword" id="oldPassword"
                                        placeholder="Password Lama">
                                    <label for="oldPassword">Password Lama</label>
                                    @error('oldPassword')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="newPassword" id="newPassword"
                                        placeholder="Password Baru">
                                    <label for="newPassword">Password Baru</label>
                                    @error('newPassword')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="status" name="status"
                                            {{ $dataKaryawan->status == true ? 'checked' : '' }}>
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

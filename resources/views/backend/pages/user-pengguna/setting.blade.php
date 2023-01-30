@extends('backend.layouts.app')
@push('after-link')
@endpush

@section('content')
    <div class="pagetitle">
        <h1>Setting Akun | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ubah Profile</h5>

                        <!-- Floating Labels Form -->
                        <form class="row g-3" method="POST" action="{{ route('setting-profile-user') }}">
                            @csrf
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Email" required value="{{ Auth::guard('user')->user()->email }}"
                                        readonly>
                                    <label for="username">Email</label>
                                    @error('email')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama" required value="{{ Auth::guard('user')->user()->nama }}">
                                    <label for="nama">Nama</label>
                                    @error('nama')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="no_telp" id="no_telp"
                                        placeholder="Nama" required value="{{ Auth::guard('user')->user()->no_telp }}">
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
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Password">
                                    <label for="password">Password Lama</label>
                                    @error('password')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm"
                                        placeholder="Konfirmasi Password">
                                    <label for="passwordConfirm">Password Baru</label>
                                    @error('passwordConfirm')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
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

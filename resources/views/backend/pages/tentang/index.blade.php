@extends('backend.layouts.app')
@push('after-link')
@endpush
@section('content')
    <div class="pagetitle">
        <h1>Tentang Toko | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>
    <section class="section dashboard">
        <img src="{{ Storage::url($dataTentang->hero) }}" class="img-thumbnail" style="max-width: 500px !important">
        <br>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Ubah Data Tentang Toko</h5>

                        <!-- Floating Labels Form -->
                        <form class="row g-3" method="POST"
                            action="{{ route('tentang.update', Crypt::encryptString($dataTentang->id)) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="wa" id="wa"
                                        placeholder="Whatsapp" required value="{{ $dataTentang->wa }}">
                                    <label for="wa">Whatsapp</label>
                                    @error('wa')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="Email" required value="{{ $dataTentang->email }}">
                                    <label for="email">Email</label>
                                    @error('email')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="alamat" id="alamat"
                                        placeholder="Alamat" required value="{{ $dataTentang->alamat }}">
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
                                    <input type="text" class="form-control" name="ig" id="ig"
                                        placeholder="Instagram" required value="{{ $dataTentang->ig }}">
                                    <label for="ig">Instagram</label>
                                    @error('ig')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="fb" id="fb"
                                        placeholder="Facebook" required value="{{ $dataTentang->fb }}">
                                    <label for="fb">Facebook</label>
                                    @error('fb')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="file" class="form-control" name="hero" id="hero"
                                        placeholder="Hero">
                                    <label for="hero">Hero</label>
                                    @error('hero')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="price_desain" id="price_desain"
                                        placeholder="Harga Jasa Desain" value="{{ $dataTentang->price_desain }}">
                                    <label for="price_desain">Harga Jasa Desain</label>
                                    @error('price_desain')
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
        </div>
    </section>
@endsection
@push('after-script')
@endpush

@extends('frontend.layouts.app')
@push('after-link')
@endpush

@section('content')
    <section class="login header bg-navy">
        <div class="container">
            <div class="row row-cols-md-12 row-cols-1 d-flex justify-content-center align-items-center hero">
                <div class="col-md-6">
                    <div class="hero-headline text-start">
                        Bergabung Dengan Pelanggan Lainnya
                        <br class="d-none d-md-block" />
                    </div>
                    <p class="hero-paragraph text-start">
                        Daftar Sekarang Secara Gratis
                    </p>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('post-register') }}" method="POST"
                        class="form-login d-flex flex-column mt-4 mt-md-0">
                        @csrf
                        <div class="d-flex flex-column align-items-start">
                            <label for="first_name" class="form-label">
                                Nama Lengkap
                            </label>
                            <input type="text" placeholder="Nama Lengkap" class="form-control" id="nama"
                                name="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <span class="badge bg-danger">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex flex-column align-items-start">
                            <label for="last_name" class="form-label">
                                Nomor Handphone
                            </label>
                            <input type="text" placeholder="Nomor Handphone" class="form-control" id="no_telp"
                                name="no_telp" value="{{ old('no_telp') }}">
                            @error('no_telp')
                                <span class="badge bg-danger">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex flex-column align-items-start">
                            <label for="email_address" class="form-label">
                                Email
                            </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                value="{{ old('email') }}">
                            @error('email')
                                <span class="badge bg-danger">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <!-- Password -->
                        <div class="d-flex flex-column align-items-start">
                            <label for="password" class="form-label">
                                Password (6 Karakter)
                            </label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password">
                            @error('password')
                                <span class="badge bg-danger">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex flex-column align-items-start">
                            <label for="role" class="form-label">
                                Konfirmasi Password
                            </label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                placeholder="Konfirmasi Password">
                            @error('confirmPassword')
                                <span class="badge bg-danger">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex flex-column align-items-start">
                            <label for="role" class="form-label">
                                Captcha Wajib Diisi
                            </label>
                            <strong>
                                <label for="answerCaptcha" class="form-label text-danger" id="questionCaptcha">
                                </label>
                            </strong>

                            <input type="text" class="form-control" id="answerCaptcha" name="answerCaptcha"
                                placeholder="Captcha">
                            @error('answerCaptcha')
                                <span class="badge bg-danger">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="a" id="a" value="">
                        <input type="hidden" name="b" id="b" value="">
                        <div class="d-grid mt-2">
                            <button class="btn-green" type="submit">
                                DAFTAR
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('after-script')
    <script>
        $(document).ready(function() {
            const a = (Math.random() * 10);
            const b = (Math.random() * 10);
            $('#questionCaptcha').text(parseInt(a) + '+' + parseInt(b) + ' ?');
            $('#a').attr('value', parseInt(a));
            $('#b').attr('value', parseInt(b));
        });
    </script>
@endpush

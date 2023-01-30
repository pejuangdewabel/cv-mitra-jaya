@extends('frontend.layouts.app')
@push('after-link')
@endpush

@section('content')
    <section class="login header bg-navy">
        <div class="container">
            <div class="d-flex flex-column align-items-center hero gap-5">
                <div>
                    <div class="hero-headline text-start">
                        Silahkan Masuk
                    </div>
                </div>
                <form action="{{ route('check-login') }}" method="POST"
                    class="form-login d-flex flex-column mt-4 mt-md-0 p-30">
                    @csrf
                    <!-- Email -->
                    <div class="d-flex flex-column align-items-start">
                        <label for="email_address" class="form-label">
                            Email
                        </label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="Masukkan Email">
                    </div>
                    <!-- Password -->
                    <div class="d-flex flex-column align-items-start">
                        <label for="password" class="form-label">
                            Password (6 characters)
                        </label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan password">
                    </div>
                    <div class="d-grid mt-2 gap-4">
                        <button type="submit" class="btn-green">
                            MASUK
                        </button>
                        <a href="{{ route('register') }}" class="btn-navy">
                            DAFTAR
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection

@push('after-script')
@endpush

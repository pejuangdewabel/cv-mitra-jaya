<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Mitra Jaya</title>
    @include('frontend.includes.link')
    @stack('after-link')
</head>

<body>
    <div class="whatsapp">
        <a class="icons" target="_blank" href="https://wa.me/{{ $about->wa }}" target="_BLANK"><svg
                viewBox="0 0 800 800">
                <path
                    d="M519 454c4 2 7 10-1 31-6 16-33 29-49 29-96 0-189-113-189-167 0-26 9-39 18-48 8-9 14-10 18-10h12c4 0 9 0 13 10l19 44c5 11-9 25-15 31-3 3-6 7-2 13 25 39 41 51 81 71 6 3 10 1 13-2l19-24c5-6 9-4 13-2zM401 200c-110 0-199 90-199 199 0 68 35 113 35 113l-20 74 76-20s42 32 108 32c110 0 199-89 199-199 0-111-89-199-199-199zm0-40c133 0 239 108 239 239 0 132-108 239-239 239-67 0-114-29-114-29l-127 33 34-124s-32-49-32-119c0-131 108-239 239-239z" />
            </svg><span>Hubungi Via WhatsApp</span></a>
    </div>
    <header class="header bg-navy">
        <!-- START: NAVBAR -->
        <nav class="container navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/frontend/images/Logo-new/plotter.png') }}" alt="logo"
                        class="logo-header" />
                    | CV MITRA JAYA
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav mx-auto my-3 my-lg-0">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('home') }}">Home</a>
                        <a class="nav-link" href="#grow-today">Produk Kami</a>
                        {{-- <a class="nav-link" href="#">Status Order</a> --}}
                        <a class="nav-link" href="#hubungi">Hubungi</a>
                        <a class="nav-link {{ request()->is('daftar') ? 'active' : '' }}"
                            href="{{ route('register') }}">Daftar</a>
                    </div>
                    <div class="d-grid">
                        <a class="btn-navy" href="{{ route('login') }}">
                            LOGIN
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- END: NAVBAR -->

        @yield('content1')

    </header>


    @yield('content')

    @include('frontend.includes.footer')
    @include('frontend.includes.script')
    @stack('after-script')
    @include('sweetalert::alert')
</body>

</html>

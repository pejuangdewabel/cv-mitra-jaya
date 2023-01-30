<section class="bg-navy">
    <nav class="container navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/frontend/images/Logo-new/plotter.png') }}" alt="logo" class="logo-header" />
                | CV MITRA JAYA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto my-3 my-lg-0">
                    <a class="nav-link {{ request()->is('') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('home') }}">Home</a>
                    {{-- <a class="nav-link" href="#grow-today">Produk Kami</a> --}}
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
</section>

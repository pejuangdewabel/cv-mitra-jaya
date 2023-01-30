<section class="bg-navy">
    <nav class="container navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/frontend/images/Logo-new/plotter.png') }}" alt="logo" class="logo-header" />
                | PRINTING CV MITRA JAYA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                @auth('user')
                    <div class="navbar-nav mx-auto my-3 my-lg-0">
                        <a class="nav-link {{ request()->is('') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('dashboard-user') }}">Dashboard</a>
                        {{-- <a class="nav-link" href="#grow-today">Produk Kami</a> --}}
                        {{-- <a class="nav-link" href="#">Status Order</a> --}}
                        <a class="nav-link" href="#hubungi">Hubungi</a>
                    </div>

                    <div class="navbar-nav ms-auto">
                        <div
                            class="nav-item dropdown d-flex flex-column flex-lg-row align-items-lg-center authenticated gap-3">
                            <span class="text-light d-none d-lg-block">Hello, {{ Auth::guard('user')->user()->nama }}</span>

                            <!-- START: Dropdown Toggler for Desktop -->
                            <a class="nav-link dropdown-toggle mx-0 d-none d-lg-block" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (Auth::guard('user')->user()->foto == null)
                                    <img src="{{ asset('assets/frontend/images/profile.png') }}" alt="semina"
                                        width="60" />
                                @else
                                    <img src="{{ Storage::url(Auth::guard('user')->user()->foto) }}" alt="semina"
                                        width="60" />
                                @endif
                            </a>
                            <!-- END: Dropdown Toggler for Desktop -->

                            <!-- START: Dropdown Toggler for Mobile -->
                            <a class="d-block d-lg-none dropdown-toggle text-light text-decoration-none"
                                data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                                aria-controls="collapseExample">
                                @if (Auth::guard('user')->user()->foto == null)
                                    <img src="{{ asset('assets/frontend/images/profile.png') }}" alt="semina"
                                        width="60" />
                                @else
                                    <img src="{{ Storage::url(Auth::guard('user')->user()->foto) }}" alt="semina"
                                        width="60" />
                                @endif
                            </a>
                            <!-- END: Dropdown Toggler for Mobile -->

                            <!-- START: Dropdown Menu for Desktop -->
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard-user') }}">Dashboard</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Settings</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Sign Out</a>
                                </li>
                            </ul>
                            <!-- END: Dropdown Menu for Desktop -->

                            <!-- START: Dropdown Menu for Mobile -->
                            <div class="collapse" id="collapseExample">
                                <ul class="list-group">
                                    <li>
                                        <a class="list-group-item" href="#">Dashboard</a>
                                    </li>
                                    <li>
                                        <a class="list-group-item" href="#">Settings</a>
                                    </li>
                                    <li>
                                        <a class="list-group-item" href="#">Rewards</a>
                                    </li>
                                    <li>
                                        <a class="list-group-item" href="{{ route('logout') }}">Sign Out</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END: Dropdown Menu for Mobile -->
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</section>

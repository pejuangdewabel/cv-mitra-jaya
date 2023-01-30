<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @auth('karyawan')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('index/dashboard') ? '' : 'collapsed' }}"
                    href="{{ route('dashboard-karyawan') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('index/data*') ? '' : 'collapsed' }}" data-bs-target="#components-nav"
                    data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav"
                    class="nav-content {{ request()->is('index/data*') ? '' : 'collapse' }} {{ request()->is('index/data*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('kategori.index') }}"
                            class="{{ request()->is('index/data/kategori*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Kategori Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('produk.index') }}"
                            class="{{ request()->is('index/data/produk*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tentang.index') }}"
                            class="{{ request()->is('index/data/tentang*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Tentang</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('metode-pembayaran.index') }}"
                            class="{{ request()->is('index/data/metode-pembayaran*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Metode Pembayaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.index') }}"
                            class="{{ request()->is('index/data/user*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>User</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('karyawan.index') }}"
                            class="{{ request()->is('index/data/karyawan*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Karyawan</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('index/transaksi*') ? '' : 'collapsed' }}"
                    href="{{ route('transaksi.index') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Data Transaksi</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('index/laporan*') ? '' : 'collapsed' }}"
                    href="{{ route('laporan-index') }}">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                    <span>Laporan Transaksi</span>
                </a>
            </li>
        @endauth

        @auth('user')
            <li class="nav-item">
                {{-- {{ request()->is('index/laporan*') ? '' : 'collapsed' }} --}}
                <a class="nav-link" href="#">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @endauth

    </ul>

</aside>

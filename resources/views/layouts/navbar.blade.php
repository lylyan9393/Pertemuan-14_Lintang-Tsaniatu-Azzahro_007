<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-book-fill"></i>
            Perpustakaan
        </a>
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('home') ? 'active':'' }}"
                       href="{{ route('home') }}">
                        <i class="bi bi-house"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('buku*') ? 'active':'' }}"
                       href="{{ route('buku.index') }}">
                        <i class="bi bi-book"></i>
                        Buku
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('anggota*') ? 'active':'' }}"
                       href="{{ route('anggota.index') }}">
                        <i class="bi bi-people"></i>
                        Anggota
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('transaksi.index','transaksi.create','transaksi.edit','transaksi.show') ? 'active' : '' }}"
                        href="{{ route('transaksi.index') }}">
                        <i class="bi bi-arrow-left-right"></i>
                        Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('transaksi.laporan','transaksi.laporan.pdf') ? 'active' : '' }}"
                        href="{{ route('transaksi.laporan') }}">
                        <i class="bi bi-file-earmark-bar-graph"></i>
                        Laporan
                    </a>
                </li>
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item"
                               href="{{ route('profile.edit') }}">
                                Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST"
                                  action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
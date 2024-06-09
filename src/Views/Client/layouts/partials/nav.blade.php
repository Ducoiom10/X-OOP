<header class="navigation fixed-top pb-3">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-white">
            <a class="navbar-brand order-1" href="{{ url('/') }}">
                <img class="img-fluid" width="100px" src="{{ asset('assets/img/logo.png') }}" alt="Logo"
                    onerror="this.onerror=null; this.src='{{ asset('assets/img/logo.png') }}';">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ url('home') }}" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Home </i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ url('about-us') }} role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            About Us </i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('contact') }}">Contact</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link" href="" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            Product </i>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('shop') }}">Shop</a>
                    </li>
                </ul>
            </div>
            <div class="order-2 order-lg-3 d-flex align-items-center">
                <form class="search-bar" action="{{ url('search') }}" method="POST">
                    <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
                    <button type="submit">Tìm kiếm</button>
                </form>
                
                <div class="container">
                    <div class="row">
                        <nav>
                            @if (isset($_SESSION['user']))
                                @if ($_SESSION['user']['type'] == 'admin')
                                    <a class="btn btn-primary" href="{{ url('admin') }}">Admin</a>
                                @endif
                                <a class="btn btn-primary" href="{{ url('logout') }}">Logout</a>
                            @else
                                <a class="btn btn-primary" href="{{ url('login') }}">Login</a>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">Ketjeh Catering</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cart">Cart ({{ $cart_count ?? 0 }})</a>
                </li>
                @if(session('username'))
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav> -->

<nav class="navbar bg-white py-3 shadow-sm">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- LEFT: LOGO -->
        <a href="/" class="navbar-brand">
            <img src="{{ asset('assets/img/logo.png') }}"
                alt="Ketjeh Catering"
                height="50">
        </a>


        <!-- RIGHT: CART + LOGIN -->
        <div class="d-flex align-items-center gap-4">

            <!-- CART -->
            <a href="/cart" class="position-relative text-dark fs-4 text-decoration-none">
                🛒
                @if(($cart_count ?? 0) > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $cart_count }}
                    </span>
                @endif
            </a>

            <!-- LOGIN / LOGOUT -->
            @if(session('username'))
                <a href="/logout"
                   class="btn px-4 text-white"
                   style="background:#004729;">
                    Logout
                </a>
            @else
                <a href="/login"
                   class="btn px-4 text-white"
                   style="background:#004729;">
                    Login
                </a>
            @endif

        </div>

    </div>
</nav>


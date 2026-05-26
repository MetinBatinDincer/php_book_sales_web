<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Metin Kitap') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Metin Kitap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <form class="d-flex ms-lg-4 my-2 my-lg-0" method="get" action="{{ route('home') }}">
                <input class="form-control me-2" name="q" value="{{ request('q') }}" placeholder="Kitap veya yazar ara">
                <button class="btn btn-outline-light">Ara</button>
            </form>
            <ul class="navbar-nav ms-auto align-items-lg-center">
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Sepet</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Siparislerim</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Profil</a></li>
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
                    @endif
                    <li class="nav-item ms-lg-2">
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-light">Cikis</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Giris</a></li>
                    <li class="nav-item"><a class="btn btn-sm btn-primary ms-lg-2" href="{{ route('register') }}">Kayit Ol</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
    @foreach (['success', 'danger', 'warning', 'info'] as $type)
        @if(session($type))
            <div class="alert alert-{{ $type }}">{{ session($type) }}</div>
        @endif
    @endforeach

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Formda eksik veya hatali alan var.</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

<footer class="border-top py-4 mt-5">
    <div class="container small text-muted d-flex flex-wrap justify-content-between gap-2">
        <span>Metin Batin Dincer - Laravel Kitap Satis Sitesi</span>
        <span>TBL304 Web Programlama Projesi</span>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


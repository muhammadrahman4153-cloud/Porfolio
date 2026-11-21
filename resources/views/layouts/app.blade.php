<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') | {{ $site->name ?? 'Portofolio' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark site-nav fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">{{ $site->name ?? 'Portofolio' }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                @php
                    $menu = [
                        ['home', 'Home', 'bi-house'], ['about', 'About', 'bi-person'],
                        ['skills', 'Skills', 'bi-bar-chart'], ['projects', 'Projects', 'bi-folder2-open'],
                        ['certificates', 'Certificates', 'bi-award'], ['contact', 'Contact', 'bi-envelope'],
                    ];
                @endphp
                @foreach ($menu as [$r, $label, $icon])
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs($r) ? 'active' : '' }}" href="{{ route($r) }}">
                            <i class="bi {{ $icon }} me-1"></i>{{ $label }}
                        </a>
                    </li>
                @endforeach
                <li class="nav-item ms-lg-2">
                    @auth
                        <a class="btn btn-sm btn-light" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-1"></i>Dashboard</a>
                    @else
                        <a class="btn btn-sm btn-outline-light" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i>Admin</a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="site-main">
    @if (session('success') || session('error'))
        <div class="container pt-3">@include('partials.alerts')</div>
    @endif
    @yield('content')
</main>

<footer class="site-footer">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <span>&copy; {{ date('Y') }} {{ $site->name ?? 'Portofolio' }}</span>
        <div class="social">
            @if ($site?->github)<a href="{{ $site->github }}" target="_blank" aria-label="GitHub"><i class="bi bi-github"></i></a>@endif
            @if ($site?->linkedin)<a href="{{ $site->linkedin }}" target="_blank" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>@endif
            @if ($site?->instagram)<a href="{{ $site->instagram }}" target="_blank" aria-label="Instagram"><i class="bi bi-instagram"></i></a>@endif
            @if ($site?->email)<a href="mailto:{{ $site->email }}" aria-label="Email"><i class="bi bi-envelope"></i></a>@endif
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

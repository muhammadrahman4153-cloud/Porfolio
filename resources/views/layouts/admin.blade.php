<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="admin-body">
@php
    $unread = \App\Models\Message::where('is_read', false)->count();
    $menu = [
        ['admin.dashboard', 'Dashboard', 'bi-speedometer2', 'admin.dashboard'],
        ['admin.profile.edit', 'Profil', 'bi-person-circle', 'admin.profile.*'],
        ['admin.educations.index', 'Pendidikan', 'bi-mortarboard', 'admin.educations.*'],
        ['admin.experiences.index', 'Pengalaman', 'bi-people', 'admin.experiences.*'],
        ['admin.skills.index', 'Keahlian', 'bi-bar-chart', 'admin.skills.*'],
        ['admin.categories.index', 'Kategori', 'bi-tags', 'admin.categories.*'],
        ['admin.projects.index', 'Proyek', 'bi-folder2-open', 'admin.projects.*'],
        ['admin.certificates.index', 'Sertifikat', 'bi-award', 'admin.certificates.*'],
        ['admin.messages.index', 'Pesan', 'bi-envelope', 'admin.messages.*'],
    ];
@endphp
<div class="admin-wrap">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand"><i class="bi bi-layers-fill me-2"></i>Admin Panel</div>
        <nav class="nav flex-column">
            @foreach ($menu as [$route, $label, $icon, $pattern])
                <a class="nav-link {{ request()->routeIs($pattern) ? 'active' : '' }}" href="{{ route($route) }}">
                    <i class="bi {{ $icon }}"></i> {{ $label }}
                    @if ($route === 'admin.messages.index' && $unread)<span class="badge bg-primary ms-auto">{{ $unread }}</span>@endif
                </a>
            @endforeach
        </nav>
        <div class="sidebar-foot">
            <a class="nav-link" href="{{ route('home') }}" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Lihat website</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link w-100 text-start border-0 bg-transparent"><i class="bi bi-box-arrow-left"></i> Logout</button>
            </form>
        </div>
    </aside>

    <div class="admin-content">
        <header class="admin-top">
            <button class="btn btn-outline-light d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('open')"><i class="bi bi-list"></i></button>
            <h4 class="mb-0 fw-bold">@yield('heading')</h4>
            <span class="ms-auto text-muted small d-none d-sm-inline"><i class="bi bi-person-check me-1"></i>{{ auth()->user()->name }}</span>
        </header>
        <div class="p-3 p-md-4">
            @include('partials.alerts')
            @yield('content')
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

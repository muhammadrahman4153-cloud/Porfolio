<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="login-page">
<div class="login-box">
    <h3 class="fw-bold mb-1">Masuk ke dashboard</h3>
    <p class="text-muted mb-4">Khusus admin portofolio.</p>
    @include('partials.alerts')
    <form method="POST" action="{{ route('login.process') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" autofocus required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Ingat saya</label>
        </div>
        <button class="btn btn-primary w-100"><i class="bi bi-box-arrow-in-right me-2"></i>Masuk</button>
    </form>
    <a href="{{ route('home') }}" class="d-block text-center mt-3 small text-decoration-none">Kembali ke website</a>
</div>
</body>
</html>

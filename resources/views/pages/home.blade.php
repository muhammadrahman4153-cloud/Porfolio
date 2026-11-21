@extends('layouts.app')
@section('title', 'Home')
@section('content')
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 order-2 order-lg-1">
                <p class="hero-hello">Halo, saya</p>
                <h1 class="hero-name">{{ $profile->name ?? 'Nama Anda' }}</h1>
                <p class="hero-role">{{ $profile->title ?? '' }}</p>
                <p class="hero-bio">{{ $profile->bio ?? 'Profil belum diisi.' }}</p>
                <div class="d-flex flex-wrap gap-2">
                    @if ($profile?->cv)
                        <a href="{{ route('cv.download') }}" class="btn btn-light btn-lg"><i class="bi bi-download me-2"></i>Download CV</a>
                    @endif
                    <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg">Tentang saya</a>
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Hubungi saya</a>
                </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2 text-center">
                @if ($profile?->photo)
                    <img src="{{ asset('storage/' . $profile->photo) }}" alt="Foto {{ $profile->name }}" class="hero-photo">
                @else
                    <div class="hero-photo hero-photo-empty"><i class="bi bi-person-fill"></i></div>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="section-title mb-0">Proyek terbaru</h2>
            <a href="{{ route('projects') }}" class="link-primary fw-semibold text-decoration-none">Lihat semua</a>
        </div>
        <div class="row g-4">
            @forelse ($projects as $project)
                <div class="col-md-6 col-lg-4">@include('pages._project-card', ['project' => $project])</div>
            @empty
                <p class="text-muted">Belum ada proyek. Tambahkan lewat dashboard admin.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection

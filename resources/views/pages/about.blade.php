@extends('layouts.app')
@section('title', 'About')
@section('content')
<section class="page-head"><div class="container"><h1>Tentang saya</h1></div></section>
<section class="section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card card-item reveal">
                    <div class="card-body">
                        <h5 class="mb-3">Biodata</h5>
                        <dl class="bio-list mb-0">
                            <dt>Nama</dt><dd>{{ $profile->name ?? '-' }}</dd>
                            <dt>Profesi</dt><dd>{{ $profile->title ?? '-' }}</dd>
                            <dt>Tanggal lahir</dt><dd>{{ $profile?->birth_date?->translatedFormat('d F Y') ?? '-' }}</dd>
                            <dt>Alamat</dt><dd>{{ $profile->address ?? '-' }}</dd>
                            <dt>Email</dt><dd>{{ $profile->email ?? '-' }}</dd>
                            <dt>Telepon</dt><dd>{{ $profile->phone ?? '-' }}</dd>
                        </dl>
                    </div>
                </div>
                <div class="card card-item reveal mt-4">
                    <div class="card-body">
                        <h5 class="mb-3">Keahlian utama</h5>
                        @forelse ($skills as $skill)<span class="tech">{{ $skill->name }}</span>@empty<p class="text-muted mb-0">Belum ada data.</p>@endforelse
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <h3 class="section-title">Riwayat pendidikan</h3>
                <div class="timeline mb-5">
                    @forelse ($educations as $edu)
                        <div class="timeline-item reveal">
                            <span class="timeline-year">{{ $edu->start_year }} - {{ $edu->end_year ?? 'Sekarang' }}</span>
                            <h5>{{ $edu->school }}</h5>
                            <p class="text-primary mb-1">{{ $edu->level }}{{ $edu->major ? ' - ' . $edu->major : '' }}</p>
                            <p class="text-muted mb-0">{{ $edu->description }}</p>
                        </div>
                    @empty<p class="text-muted">Belum ada data pendidikan.</p>@endforelse
                </div>

                <h3 class="section-title">Pengalaman organisasi</h3>
                <div class="timeline">
                    @forelse ($experiences as $exp)
                        <div class="timeline-item reveal">
                            <span class="timeline-year">{{ $exp->start_year }} - {{ $exp->end_year ?? 'Sekarang' }}</span>
                            <h5>{{ $exp->position }}</h5>
                            <p class="text-primary mb-1">{{ $exp->organization }}</p>
                            <p class="text-muted mb-0">{{ $exp->description }}</p>
                        </div>
                    @empty<p class="text-muted">Belum ada data pengalaman.</p>@endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

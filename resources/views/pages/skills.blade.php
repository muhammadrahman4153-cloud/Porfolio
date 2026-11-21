@extends('layouts.app')
@section('title', 'Skills')
@section('content')
<section class="page-head"><div class="container"><h1>Keahlian</h1></div></section>
<section class="section">
    <div class="container">
        <div class="row g-4">
            @forelse ($groups as $category => $skills)
                <div class="col-lg-6">
                    <div class="card card-item reveal h-100">
                        <div class="card-body">
                            <h5 class="mb-4"><i class="bi {{ ['Programming' => 'bi-code-slash', 'Design' => 'bi-palette', 'Database' => 'bi-database'][$category] ?? 'bi-stars' }} text-primary me-2"></i>{{ $category }}</h5>
                            @foreach ($skills as $skill)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between small fw-semibold mb-1">
                                        <span>{{ $skill->name }}</span><span>{{ $skill->percentage }}%</span>
                                    </div>
                                    <div class="progress"><div class="progress-bar" data-width="{{ $skill->percentage }}" style="width:0"></div></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada data keahlian.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection

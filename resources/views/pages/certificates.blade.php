@extends('layouts.app')
@section('title', 'Certificates')
@section('content')
<section class="page-head"><div class="container"><h1>Sertifikat</h1></div></section>
<section class="section">
    <div class="container">
        <div class="row g-4">
            @forelse ($certificates as $cert)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-item reveal h-100">
                        @if ($cert->image)
                            <a href="{{ asset('storage/' . $cert->image) }}" target="_blank">
                                <img src="{{ asset('storage/' . $cert->image) }}" class="card-img-top thumb" alt="{{ $cert->name }}">
                            </a>
                        @else
                            <div class="thumb thumb-empty"><i class="bi bi-award"></i></div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $cert->name }}</h5>
                            <p class="text-muted mb-1">{{ $cert->issuer }}</p>
                            <p class="small text-primary mb-0"><i class="bi bi-calendar3 me-1"></i>{{ $cert->issued_date->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12"><div class="empty-state"><i class="bi bi-award"></i><p>Belum ada sertifikat.</p></div></div>
            @endforelse
        </div>
    </div>
</section>
@endsection

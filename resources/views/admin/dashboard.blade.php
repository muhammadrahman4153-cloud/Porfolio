@extends('layouts.admin')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')
@section('content')
<div class="row g-3 mb-4">
    @foreach ([['Proyek', $projects, 'bi-folder2-open'], ['Keahlian', $skills, 'bi-bar-chart'], ['Sertifikat', $certificates, 'bi-award'], ['Pesan belum dibaca', $unread, 'bi-envelope']] as [$label, $count, $icon])
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <i class="bi {{ $icon }}"></i>
                <div><div class="stat-num">{{ $count }}</div><div class="text-muted small">{{ $label }}</div></div>
            </div>
        </div>
    @endforeach
</div>
<div class="card card-item">
    <div class="card-header fw-semibold">Pesan terbaru</div>
    <div class="list-group list-group-flush">
        @forelse ($latest as $m)
            <a href="{{ route('admin.messages.show', $m->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between">
                <span><strong>{{ $m->name }}</strong> - {{ $m->subject }}</span>
                <span class="small text-muted">{{ $m->created_at->diffForHumans() }}</span>
            </a>
        @empty
            <div class="list-group-item text-muted">Belum ada pesan masuk.</div>
        @endforelse
    </div>
</div>
@endsection

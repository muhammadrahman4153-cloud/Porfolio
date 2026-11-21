@extends('layouts.admin')
@section('title', 'Detail pesan')
@section('heading', 'Detail pesan')
@section('content')
<div class="card card-item">
    <div class="card-body p-4">
        <h5>{{ $message->subject }}</h5>
        <p class="text-muted small">Dari <strong>{{ $message->name }}</strong> ({{ $message->email }}) &middot; {{ $message->created_at->format('d M Y H:i') }}</p>
        <hr>
        <p style="white-space:pre-line">{{ $message->message }}</p>
        <div class="d-flex gap-2 mt-4">
            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary"><i class="bi bi-reply me-1"></i>Balas lewat email</a>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection

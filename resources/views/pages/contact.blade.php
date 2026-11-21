@extends('layouts.app')
@section('title', 'Contact')
@section('content')
<section class="page-head"><div class="container"><h1>Hubungi saya</h1></div></section>
<section class="section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card card-item"><div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">Pesan belum terkirim. Periksa kembali isian Anda.</div>
                    @endif
                    <form method="POST" action="{{ route('contact.send') }}" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Subjek</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" class="form-control @error('subject') is-invalid @enderror">
                                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Pesan</label>
                                <textarea name="message" rows="5" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12"><button class="btn btn-primary px-4"><i class="bi bi-send me-2"></i>Kirim pesan</button></div>
                        </div>
                    </form>
                </div></div>
            </div>
            <div class="col-lg-5">
                <div class="card card-item"><div class="card-body p-4">
                    <h5 class="mb-3">Kontak</h5>
                    <p><i class="bi bi-envelope text-primary me-2"></i>{{ $profile->email ?? '-' }}</p>
                    <p><i class="bi bi-telephone text-primary me-2"></i>{{ $profile->phone ?? '-' }}</p>
                    <p><i class="bi bi-geo-alt text-primary me-2"></i>{{ $profile->address ?? '-' }}</p>
                    <hr>
                    <div class="d-flex gap-2">
                        @if ($profile?->github)<a href="{{ $profile->github }}" target="_blank" class="btn btn-outline-dark"><i class="bi bi-github"></i></a>@endif
                        @if ($profile?->linkedin)<a href="{{ $profile->linkedin }}" target="_blank" class="btn btn-outline-primary"><i class="bi bi-linkedin"></i></a>@endif
                        @if ($profile?->instagram)<a href="{{ $profile->instagram }}" target="_blank" class="btn btn-outline-danger"><i class="bi bi-instagram"></i></a>@endif
                    </div>
                </div></div>
            </div>
        </div>
    </div>
</section>
@endsection

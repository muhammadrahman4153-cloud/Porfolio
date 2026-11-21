@extends('layouts.app')
@section('title', 'Projects')
@section('content')
<section class="page-head"><div class="container"><h1>Proyek</h1></div></section>
<section class="section">
    <div class="container">
        <form method="GET" action="{{ route('projects') }}" class="row g-2 mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama, deskripsi, atau teknologi...">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary flex-fill">Cari</button>
                @if (request('q') || request('category'))
                    <a href="{{ route('projects') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>

        <div class="row g-4">
            @forelse ($projects as $project)
                <div class="col-md-6 col-lg-4">@include('pages._project-card', ['project' => $project])</div>
            @empty
                <div class="col-12"><div class="empty-state"><i class="bi bi-folder-x"></i><p>Tidak ada proyek yang cocok. Coba kata kunci atau kategori lain.</p></div></div>
            @endforelse
        </div>
        <div class="mt-4">{{ $projects->links() }}</div>
    </div>
</section>
@endsection

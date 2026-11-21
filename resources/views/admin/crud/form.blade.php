@extends('layouts.admin')
@section('title', $title)
@section('heading', ($item ? 'Edit ' : 'Tambah ') . $title)
@section('content')
<div class="card card-item">
    <div class="card-body p-4">
        <form method="POST" enctype="multipart/form-data"
              action="{{ $item ? route($route . '.update', $item->id) : route($route . '.store') }}">
            @csrf
            @if ($item) @method('PUT') @endif

            @include('admin.crud._fields')

            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                <a href="{{ route($route . '.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

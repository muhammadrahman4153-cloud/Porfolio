@extends('layouts.admin')
@section('title', 'Profil')
@section('heading', 'Edit profil')
@section('content')
<div class="card card-item">
    <div class="card-body p-4">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.profile.update') }}">
            @csrf @method('PUT')
            @include('admin.crud._fields')
            <div class="mt-4"><button class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan profil</button></div>
        </form>
    </div>
</div>
@endsection

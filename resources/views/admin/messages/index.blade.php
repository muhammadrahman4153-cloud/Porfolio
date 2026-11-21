@extends('layouts.admin')
@section('title', 'Pesan')
@section('heading', 'Pesan pengunjung')
@section('content')
<div class="card card-item">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead><tr><th>Status</th><th>Pengirim</th><th>Subjek</th><th>Tanggal</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
            @forelse ($messages as $m)
                <tr class="{{ $m->is_read ? '' : 'fw-semibold' }}">
                    <td>@if ($m->is_read)<span class="badge bg-secondary">Dibaca</span>@else<span class="badge bg-primary">Baru</span>@endif</td>
                    <td>{{ $m->name }}<div class="small text-muted fw-normal">{{ $m->email }}</div></td>
                    <td>{{ \Illuminate\Support\Str::limit($m->subject, 50) }}</td>
                    <td class="small">{{ $m->created_at->format('d M Y H:i') }}</td>
                    <td class="text-end text-nowrap">
                        <a href="{{ route('admin.messages.show', $m->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        <form method="POST" action="{{ route('admin.messages.destroy', $m->id) }}" class="d-inline" onsubmit="return confirm('Yakin hapus pesan ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada pesan masuk.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $messages->links() }}</div>
@endsection

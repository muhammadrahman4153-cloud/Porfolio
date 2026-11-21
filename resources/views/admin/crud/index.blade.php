@extends('layouts.admin')
@section('title', $title)
@section('heading', 'Data ' . $title)
@section('content')
<div class="d-flex justify-content-between mb-3">
    <span class="text-muted">Total: {{ $items->total() }} data</span>
    <a href="{{ route($route . '.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah {{ $title }}</a>
</div>
<div class="card card-item">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th style="width:50px">#</th>
                    @foreach ($columns as $col)<th>{{ $col['label'] }}</th>@endforeach
                    <th style="width:130px" class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $items->firstItem() + $loop->index }}</td>
                        @foreach ($columns as $col)
                            @php $val = data_get($item, $col['key']); $type = $col['type'] ?? 'text'; @endphp
                            <td>
                                @if ($type === 'image')
                                    @if ($val)<img src="{{ asset('storage/' . $val) }}" class="admin-thumb" alt="">@else<span class="text-muted">-</span>@endif
                                @elseif ($type === 'badge')
                                    @if ($val)<span class="badge badge-soft">{{ $val }}</span>@else<span class="text-muted">-</span>@endif
                                @elseif ($type === 'percent')
                                    {{ $val }}%
                                @elseif ($type === 'date')
                                    {{ $val?->format('d M Y') }}
                                @else
                                    {{ \Illuminate\Support\Str::limit((string) $val, 60) ?: '-' }}
                                @endif
                            </td>
                        @endforeach
                        <td class="text-end text-nowrap">
                            <a href="{{ route($route . '.edit', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route($route . '.destroy', $item->id) }}" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="{{ count($columns) + 2 }}" class="text-center text-muted py-4">Belum ada data. Klik "Tambah {{ $title }}" untuk mulai.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $items->links() }}</div>
@endsection

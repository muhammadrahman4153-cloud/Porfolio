<div class="card card-item reveal h-100">
    @if ($project->image)
        <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top thumb" alt="{{ $project->title }}">
    @else
        <div class="thumb thumb-empty"><i class="bi bi-code-slash"></i></div>
    @endif
    <div class="card-body d-flex flex-column">
        @if ($project->category)<span class="badge badge-soft align-self-start mb-2">{{ $project->category->name }}</span>@endif
        <h5 class="card-title">{{ $project->title }}</h5>
        <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($project->description, 110) }}</p>
        <div class="mb-3">
            @foreach ($project->tech_list as $tech)<span class="tech">{{ $tech }}</span>@endforeach
        </div>
        <div class="mt-auto d-flex gap-2">
            @if ($project->project_url)<a href="{{ $project->project_url }}" target="_blank" rel="noopener" class="btn btn-sm btn-primary"><i class="bi bi-box-arrow-up-right me-1"></i>Buka</a>@endif
            @if ($project->github_url)<a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-dark"><i class="bi bi-github me-1"></i>GitHub</a>@endif
        </div>
    </div>
</div>

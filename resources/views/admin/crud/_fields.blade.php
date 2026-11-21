{{-- Dipakai oleh form CRUD dan form profil. Variabel: $fields, $item (boleh null) --}}
<div class="row g-3">
@foreach ($fields as $f)
    @php
        $name = $f['name'];
        $type = $f['type'] ?? 'text';
        $val  = old($name, $item ? data_get($item, $name) : '');
        if ($val instanceof \Carbon\Carbon) { $val = $val->format('Y-m-d'); }
        $full = in_array($type, ['textarea']);
    @endphp
    <div class="{{ $full ? 'col-12' : 'col-md-6' }}">
        <label class="form-label fw-semibold">{{ $f['label'] }} @if (!empty($f['required']))<span class="text-danger">*</span>@endif</label>

        @if ($type === 'textarea')
            <textarea name="{{ $name }}" rows="4" class="form-control @error($name) is-invalid @enderror">{{ $val }}</textarea>

        @elseif ($type === 'select')
            <select name="{{ $name }}" class="form-select @error($name) is-invalid @enderror">
                <option value="">{{ $f['empty'] ?? '- Pilih -' }}</option>
                @foreach ($f['options'] as $k => $label)
                    <option value="{{ $k }}" @selected((string) $val === (string) $k)>{{ $label }}</option>
                @endforeach
            </select>

        @elseif ($type === 'file')
            @if ($item && data_get($item, $name))
                @if (in_array(pathinfo(data_get($item, $name), PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'webp']))
                    <div class="mb-2"><img src="{{ asset('storage/' . data_get($item, $name)) }}" class="admin-preview" alt=""></div>
                @else
                    <div class="mb-2 small"><i class="bi bi-file-earmark-pdf text-danger me-1"></i>File saat ini sudah diunggah</div>
                @endif
            @endif
            <input type="file" name="{{ $name }}" @if(!empty($f['accept'])) accept="{{ $f['accept'] }}" @else accept="image/*" @endif
                   class="form-control @error($name) is-invalid @enderror">
            @if ($item)<div class="form-text">Kosongkan jika tidak ingin mengganti file.</div>@endif

        @else
            <input type="{{ $type }}" name="{{ $name }}" value="{{ $val }}" class="form-control @error($name) is-invalid @enderror">
        @endif

        @error($name)<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
@endforeach
</div>

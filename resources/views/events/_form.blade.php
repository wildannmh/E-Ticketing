@php
    $isEdit = isset($event);
@endphp

<form action="{{ $isEdit ? route('events.update', $event->id) : route('events.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="title" class="form-label">Judul Acara</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $event->title ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $event->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="location" class="form-label">Lokasi (alamat lengkap)</label>
        <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $event->location ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="location_link" class="form-label">Link Lokasi Google Maps (embed URL atau link)</label>
        <textarea name="location_link" id="location_link" class="form-control" rows="3" placeholder="Masukkan link Google Maps atau embed URL">{{ old('location_link', $event->location_link ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="start_date" class="form-label">Tanggal Mulai</label>
        <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', isset($event) ? date('Y-m-d\TH:i', strtotime($event->start_date)) : '') }}" required>
    </div>

    <div class="mb-3">
        <label for="end_date" class="form-label">Tanggal Berakhir</label>
        <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', isset($event) ? date('Y-m-d\TH:i', strtotime($event->end_date)) : '') }}" required>
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Kategori</label>
        <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $event->category ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="policies" class="form-label">Kebijakan (Opsional)</label>
        <textarea name="policies" id="policies" class="form-control" rows="3">{{ old('policies', $event->policies ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="banner_image" class="form-label">Banner Acara (Opsional)</label>
        <input type="file" name="banner_image" id="banner_image" class="form-control">
        @if($isEdit && $event->banner_image)
            <img src="{{ asset('storage/' . $event->banner_image) }}" alt="Banner" class="img-fluid mt-2" style="max-height: 200px;">
        @endif
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" name="is_published" id="is_published" class="form-check-input" value="1" {{ old('is_published', $event->is_published ?? false) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_published">Publikasikan</label>
    </div>

    <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Update' : 'Buat' }} Acara</button>
</form>

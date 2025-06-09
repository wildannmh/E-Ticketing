@extends('layouts.user')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1>Dashboard User</h1>
        <p>Selamat datang, {{ Auth::user()->name }}!</p>
    </div>
</div>

<div class="row g-4">
    {{-- Card event contoh --}}
    @foreach(range(1, 4) as $event)
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-sm h-100">
            <img src="https://picsum.photos/seed/event{{$event}}/400/200" class="card-img-top" alt="Event {{$event}}">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Event #{{$event}}</h5>
                <p class="card-text flex-grow-1">Deskripsi singkat event nomor {{$event}} yang menarik dan informatif.</p>
                <a href="#" class="btn btn-primary mt-auto">Detail Event</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

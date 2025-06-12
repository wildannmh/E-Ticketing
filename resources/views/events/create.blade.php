@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card justify-content-center p-4 w-100 h-100">
        <h1>Buat Acara Baru</h1>
        @include('events._form')
    </div>
</div>

<style>
    .container-fluid {
        padding: 0 50px;
        padding-top: 90px;
        padding-bottom: 4rem;
        background: var(--bg-default);
    }
</style>
@endsection

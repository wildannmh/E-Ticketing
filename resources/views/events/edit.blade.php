@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Acara</h1>
    @include('events._form', ['event' => $event])
</div>
@endsection

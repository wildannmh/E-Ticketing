@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card w-100 h-100">
                <div class="card-header">Buat Profil Organizer</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('organizer.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Organizer</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                        </div>

                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Email Kontak</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email" required>
                        </div>

                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">Telepon Kontak</label>
                            <input type="tel" class="form-control" id="contact_phone" name="contact_phone" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Daftar sebagai Organizer</button>
                    </form>
                </div>
            </div>
        </div>
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
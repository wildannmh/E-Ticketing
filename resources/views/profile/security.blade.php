@extends('layouts.app')

@section('title', 'Moeket - Security')

@section('content')
  <!-- Breadcrumb -->
<div class="container-fluid">
  <nav aria-label="breadcrumb" class="mt-3">
      <ol class="breadcrumb">
          @foreach($breadcrumbs as $item)
              @if(isset($item['url']))
                  <li class="breadcrumb-item">
                      <a href="{{ $item['url'] }}" class="text-decoration-none">
                          @if($loop->first)<i class="fas fa-home me-1"></i>@endif
                          {{ $item['text'] }}
                      </a>
                  </li>
              @else
                  <li class="breadcrumb-item active" aria-current="page">{{ $item['text'] }}</li>
              @endif
          @endforeach
      </ol>
  </nav>
  <div class="main-container my-4 mb-0">
    <!-- Container utama -->
    <div class="wrapper-container">
      <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-3 sidebar">
          <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('profile.show') }}" id="navProfile">Profile</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{ route('profile.security') }}" id="navKeamanan">Keamanan</a></li>
            <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('profile.wishlist') }}" id="navWishlist">Wishlist</a></li>
            <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('profile.history') }}" id="navRiwayat">Riwayat Pembelian</a></li>
          </ul>
        </div>

        <!-- Content -->
        <div class="col-md-9 ps-md-4">
          <h5 class="fw-bold mb-4">Keamanan</h5>
          <form id="formKeamanan" method="POST" action="{{ route('profile.security.update') }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="oldPassword" class="form-label">Password Lama</label>
              <input type="password" class="form-control" name="old_password" id="oldPassword" placeholder="Masukkan password lama" required />
            </div>
            <div class="mb-3">
              <label for="newPassword" class="form-label">Password Baru</label>
              <input type="password" class="form-control" name="new_password" id="newPassword" placeholder="Masukkan password baru" required />
            </div>
            <div class="mb-3">
              <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
              <input type="password" class="form-control" name="new_password_confirmation" id="confirmPassword" placeholder="Ulangi password baru" required />
            </div>
            <button type="submit" class="btn btn-gradient">Simpan</button>
          </form>
        </div>
        @if(session('success'))
          <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger mt-3">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
    </div>
  </div>
</div>
<style>
</style>
@include('profile._style')
@endsection
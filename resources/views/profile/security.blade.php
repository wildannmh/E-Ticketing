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
          <form id="formKeamanan">
            <div class="mb-3">
              <label for="oldPassword" class="form-label">Password Lama</label>
              <input type="password" class="form-control" id="oldPassword" placeholder="Masukkan password lama" />
            </div>
            <div class="mb-3">
              <label for="newPassword" class="form-label">Password Baru</label>
              <input type="password" class="form-control" id="newPassword" placeholder="Masukkan password baru" />
            </div>
            <div class="mb-3">
              <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
              <input type="password" class="form-control" id="confirmPassword" placeholder="Ulangi password baru" />
            </div>
            <button type="submit" class="btn btn-gradient">Simpan</button>
          </form>
        </div>
    </div>
  </div>
</div>
<style>
</style>
@include('profile._style')
@endsection
@extends('layouts.app')

@section('title', 'Moeket - Profile')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumb -->
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
                <li class="nav-item"><a class="nav-link active" href="{{ route('profile.show') }}" id="navProfile">Profile</a></li>
                <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('profile.security') }}" id="navKeamanan">Keamanan</a></li>
                <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('profile.wishlist') }}" id="navWishlist">Wishlist</a></li>
                <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('profile.history') }}" id="navRiwayat">Riwayat Pembelian</a></li>
              </ul>
          </div>
  
          <!-- Profile Content -->
          <div class="col-md-9">
            <div class="content-card d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center">
                <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/profil-img.jpg') }}"
                                alt="Profile"
                                class="rounded-2 me-2"
                                style="width: 60px; height: 60px; object-fit: cover;">
                <div>
                  <h5 class="fw-bold" style="margin-bottom: -8px;">{{ auth()->user()->name }}</h5>
                  <small class="text-muted">{{ auth()->user()->role }}</small>
                </div>
              </div>
              <button class="btn btn-outline-secondary btn-sm edit-btn" id="editProfile">Edit ✎</button>
            </div>
  
            <div class="content-card">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold">Informasi Personal</h6>
                <button class="btn btn-outline-secondary btn-sm edit-btn" id="editPersonal">Edit ✎</button>
              </div>
              <div class="row" id="personalInfo">
              <div class="col-md-6">
                  <p class="mb-1 text-muted">Nama Pengguna</p>
                  <p class="fw-bold" id="namaDepan">{{ auth()->user()->name }}</p>
              </div>
              <div class="col-md-6">
                  <p class="mb-1 text-muted">Alamat</p>
                  <p class="fw-bold" id="namaBelakang">{{ auth()->user()->address ?? '-' }}</p>
              </div>

              <div class="col-md-6">
                  <p class="mb-1 text-muted">Email</p>
                  <p class="fw-bold" id="emailUser">{{ auth()->user()->email }}</p>
              </div>
              <div class="col-md-6">
                  <p class="mb-1 text-muted">Nomor Telepon</p>
                  <p class="fw-bold" id="teleponUser">{{ auth()->user()->phone ?? '-' }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('profile._style')
@include('profile.modals.edit-profile')
@include('profile.modals.edit-personal')
@endsection
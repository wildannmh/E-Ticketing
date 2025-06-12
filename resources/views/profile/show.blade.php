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
<script>
$(document).ready(function() {
  console.log("Document ready - script loaded");
  
  // Handle profile edit button
  $('#editProfile').click(function() {
    console.log("Edit Profile button clicked");
    $('#editProfileModal').modal('show');
  });
  
  // Handle personal info edit button
  $('#editPersonal').click(function() {
    console.log("Edit Personal button clicked");
    $('#editPersonalModal').modal('show');
  });
  
  // Preview profile image before upload
  $('#profilePhoto').change(function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(event) {
        $('#profileImagePreview').attr('src', event.target.result);
      }
      reader.readAsDataURL(file);
    }
  });
  
  // Handle form submissions with AJAX
  $('#profileForm, #personalInfoForm').submit(function(e) {
    e.preventDefault();
    const form = $(this);
    const formData = new FormData(form[0]);
    
    $.ajax({
      url: form.attr('action'),
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        toastr.success('Profil berhasil diperbarui');
        form.closest('.modal').modal('hide');
        setTimeout(() => location.reload(), 1000);
      },
      error: function(xhr) {
        toastr.error(xhr.responseJSON.message || 'Terjadi kesalahan');
      }
    });
  });
  
  // Initialize Toastr
  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "5000",
    "escapeHtml": true,
    // Custom styling untuk warna teks
    "toastClass": "toast-black-text",
    "iconClasses": {
      "success": "toast-success-black",
      "error": "toast-error",
      "info": "toast-info",
      "warning": "toast-warning"
    }
  };
});
</script>
<style>
  .toast-black-text {
    color: #000000 !important;
    margin-top: 4rem;
  }
  
  .toast-success-black {
    background-color: #d4edda !important;
    color: #000000 !important;
    border-color: #c3e6cb !important;
  }
  
  /* Optional: styling untuk konten */
  .toast-black-text .toast-message {
    color: #000000 !important;
  }
  
  .toast-black-text .toast-title {
    color: #000000 !important;
    font-weight: bold;
  }
</style>
@include('profile._style')
@include('profile.modals.edit-profile')
@include('profile.modals.edit-personal')
@endsection
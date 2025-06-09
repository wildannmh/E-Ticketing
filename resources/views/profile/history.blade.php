@extends('layouts.app')

@section('title', 'Moeket - Riwayat Pembelian')

@section('content')
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
      <div class="wrapper-container">
          <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 mb-3 sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('profile.show') }}" id="navProfile">Profile</a></li>
                    <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('profile.security') }}" id="navKeamanan">Keamanan</a></li>
                    <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('profile.wishlist') }}" id="navWishlist">Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('profile.history') }}" id="navRiwayat">Riwayat Pembelian</a></li>
                </ul>
            </div>
            <!-- Riwayat Pembelian Table -->
            <div class="col-md-9 ps-md-4 mt-4 mt-md-0">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Riwayat Pembelian</h5>
                <input type="text" class="form-control form-control-sm w-50" placeholder="Search" id="searchHistory">
              </div>
              <div class="table-responsive" id="historyTableContainer">
                @include('profile.partials.history_table')
              </div>
            </div>
          </div>
        </div>
  </div>
</div>

@include('profile._style')

<script>
$(document).ready(function() {
    // Search functionality
    $('#searchHistory').on('keyup', function() {
        const search = $(this).val();
        
        $.ajax({
            url: "{{ route('profile.history') }}",
            type: "GET",
            data: { search: search },
            success: function(data) {
                $('#historyTableContainer').html(data);
            }
        });
    });

    // Pagination with AJAX
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const page = $(this).attr('href').split('page=')[1];
        const search = $('#searchHistory').val();
        
        $.ajax({
            url: "{{ route('profile.history') }}?page=" + page,
            type: "GET",
            data: { search: search },
            success: function(data) {
                $('#historyTableContainer').html(data);
                window.scrollTo(0, 0);
            }
        });
    });
});
</script>
@endsection
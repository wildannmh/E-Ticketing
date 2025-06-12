<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="margin-top: 7rem">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <!-- Field Foto Profil -->
          <div class="mb-3 text-center">
            <img id="profileImagePreview" src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/profil-img.jpg') }}" 
                 class="rounded-circle mb-2" style="width: 120px; height: 120px; object-fit: cover;">
            <input type="file" class="form-control d-none" id="profilePhoto" name="profile_photo" accept="image/*">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('profilePhoto').click()">
              Pilih Foto
            </button>
            <small class="d-block text-muted mt-1">Format: JPG, PNG (max 2MB)</small>
            @error('profile_photo')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>
          
          <!-- Field Nama (Hidden) -->
          <input type="hidden" name="name" value="{{ auth()->user()->name }}">
          
          <!-- Field Email (Hidden) -->
          <input type="hidden" name="email" value="{{ auth()->user()->email }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Preview image sebelum upload
  document.getElementById('profilePhoto').addEventListener('change', function(e) {
    const [file] = e.target.files;
    if (file) {
      const preview = document.getElementById('profileImagePreview');
      preview.src = URL.createObjectURL(file);
    }
  });
</script>
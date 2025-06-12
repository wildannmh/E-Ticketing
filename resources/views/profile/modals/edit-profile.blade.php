<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3 text-center">
            <img id="profileImagePreview" src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/profil-img.jpg') }}" 
                 class="rounded-circle mb-2" style="width: 120px; height: 120px; object-fit: cover;">
            <input type="file" class="form-control d-none" id="profilePhoto" name="profile_photo" accept="image/*">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('profilePhoto').click()">
              Pilih Foto
            </button>
            <small class="d-block text-muted mt-1">Format: JPG, PNG (max 2MB)</small>
          </div>
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
  $(document).ready(function() {
    // Handle profile edit button
    $('#editProfile').click(function() {
      $('#editProfileModal').modal('show');
    });
    
    // Handle personal info edit button
    $('#editPersonal').click(function() {
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
          // Show success message
          toastr.success('Profil berhasil diperbarui');
          
          // Close modal
          form.closest('.modal').modal('hide');
          
          // Reload page to see changes
          setTimeout(() => location.reload(), 1000);
        },
        error: function(xhr) {
          // Show error message
          toastr.error(xhr.responseJSON.message || 'Terjadi kesalahan');
        }
      });
    });
  });
</script>
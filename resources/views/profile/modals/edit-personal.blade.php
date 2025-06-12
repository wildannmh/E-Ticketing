<div class="modal fade" id="editPersonalModal" tabindex="-1" aria-labelledby="editPersonalModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPersonalModalLabel">Edit Informasi Personal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="personalInfoForm" action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea class="form-control" id="address" name="address" rows="3">{{ auth()->user()->address }}</textarea>
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
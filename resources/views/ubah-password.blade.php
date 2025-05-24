<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Ubah Password</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body, html {
      height: 100%;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }
    .wrapper {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }
    .sidebar {
      width: 250px;
      background-color: #f8f9fa;
      border-right: 1px solid #dee2e6;
      flex-shrink: 0;
      padding-top: 20px;
    }
    .content {
      flex-grow: 1;
      overflow-y: auto;
      padding: 2rem;
    }
    .card-setting {
      border-radius: 1rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      background-color: white;
      max-width: 500px;
      margin: auto;
      padding: 2rem;
    }
    .form-label {
      font-weight: 500;
    }
  </style>
</head>
<body>

<div class="wrapper">
  <div class="sidebar">
    @include('layout.navbar')
  </div>

  <div class="content">
    <div class="card-setting">
      <h4 class="mb-4 fw-bold text-center">Ubah Password</h4>

      <form action="{{ route('ubah-password.update') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label for="current_password" class="form-label">Password Lama</label>
          <input type="password" name="current_password" id="current_password" 
                 class="form-control @error('current_password') is-invalid @enderror" required>
          @error('current_password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="new_password" class="form-label">Password Baru</label>
          <input type="password" name="new_password" id="new_password" 
                 class="form-control @error('new_password') is-invalid @enderror" required>
          @error('new_password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
          <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                 class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">
          <i class="bi bi-key-fill"></i> Ubah Password
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Modal Sukses -->
@if(session('success'))
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="successModalLabel">Berhasil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        {{ session('success') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@if(session('success'))
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
    successModal.show();
  });
</script>
@endif

</body>
</html>

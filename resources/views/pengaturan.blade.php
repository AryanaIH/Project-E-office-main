<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pengaturan Aplikasi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      padding: 0;
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
      background-color: #f5f5f5;
    }

    .card-setting {
      border-radius: 1rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .form-label {
      font-weight: 500;
    }
  </style>
</head>
<body>

<div class="wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    @include('layout.navbar')
  </div>

  <!-- Content Area -->
  <div class="content">
    <div class="content-inner">
      <h4 class="mb-4 fw-bold">Pengaturan Aplikasi</h4>

      <!-- Success Message -->
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <div class="row g-4">
  <!-- Form Tambah / Edit Akun -->
  <div class="col-md-6">
    <div class="card card-setting p-4">
      <h5 class="mb-3">{{ isset($editData) ? 'Edit Akun' : 'Tambah Akun' }}</h5>
      <form action="{{ isset($editData) ? route('pengaturan.update', $editData->id) : route('pengaturan.store') }}" method="POST">
        @csrf
        @if(isset($editData))
          @method('PUT')
        @endif

        <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input type="text" class="form-control" id="name" name="name"
                 value="{{ old('name', $editData->name ?? '') }}" placeholder="Masukkan Nama" required>
          @error('name')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email"
                 value="{{ old('email', $editData->email ?? '') }}" placeholder="Masukkan Email" required>
          @error('email')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="mb-3">
          <label for="level" class="form-label">Level</label>
          <select class="form-select" id="level" name="level" required>
            <option value="" disabled {{ old('level', $editData->level ?? '') == '' ? 'selected' : '' }}>Pilih Level</option>
            <option value="admin" {{ old('level', $editData->level ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="operator" {{ old('level', $editData->level ?? '') == 'operator' ? 'selected' : '' }}>operator</option>
          </select>
          @error('level')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">
          <i class="bi bi-save"></i> {{ isset($editData) ? 'Update' : 'Tambah' }} Akun
        </button>
      </form>
    </div>
  </div>

  <!-- Tabel Daftar Akun -->
  <div class="col-md-6">
    <div class="card card-setting p-4">
      <h5 class="mb-3">Daftar Akun</h5>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>Level</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($akunList as $item)
              <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ ucfirst($item->level) }}</td>
                <td class="text-center d-flex gap-1 justify-content-center">
                  <a href="{{ route('pengaturan', ['edit' => $item->id]) }}" class="btn btn-sm btn-warning" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <form action="{{ route('pengaturan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center">Belum ada akun</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Master Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
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
    }

    .content {
      flex-grow: 1;
      overflow-y: auto;
      padding: 2rem;
      background-color: #f5f5f5;
    }

    .content-inner {
      min-height: 100%;
    }
  </style>
</head>
<body>

<div class="wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    @include('layout.navbar')
  </div>

  <!-- Konten Scrollable -->
  <div class="content">
    <div class="content-inner">

      <!-- Header -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold m-0">Master Pengguna</h5>
        <div class="d-flex align-items-center">
          <img src="{{ asset('img/user-icon.png') }}" alt="User Icon" width="20" class="me-2" />
          <span>Admin User</span>
        </div>
      </div>

      <hr class="mb-4 mt-2">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-body-tertiary p-2 rounded">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
        </ol>
      </nav>

<!-- Form Master Pengguna -->
<div class="card shadow-sm mb-5">
  <div class="card-body">
    <h4 class="card-title text-center mb-4">Form Master Pengguna</h4>

    <form action="{{ isset($editData) ? route('pengguna.update', $editData->id) : route('pengguna.store') }}" method="POST">
      @csrf
      @if(isset($editData))
        @method('PUT')
      @endif

      <div class="mb-3">
        <label for="id_pengguna" class="form-label">ID Pengguna</label>
        <input type="text" class="form-control" name="id_pengguna" id="id_pengguna" value="{{ old('id_pengguna', $editData->id_pengguna ?? '') }}" placeholder="Masukkan ID Pengguna" {{ isset($editData) ? 'readonly' : '' }}>
      </div>

      <div class="mb-3">
        <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
        <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna" value="{{ old('nama_pengguna', $editData->nama_pengguna ?? '') }}" placeholder="Masukkan Nama Pengguna">
      </div>

      <div class="mb-3">
        <label for="jabatan" class="form-label">Jabatan</label>
        <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ old('jabatan', $editData->jabatan ?? '') }}" placeholder="Masukkan Jabatan">
      </div>

      <div class="mb-3">
        <label for="hak_akses" class="form-label">Hak Akses</label>
        <select class="form-select" name="hak_akses" id="hak_akses">
          <option value="">Pilih Hak Akses</option>
          <option value="admin" {{ (old('hak_akses', $editData->hak_akses ?? '') == 'admin') ? 'selected' : '' }}>Admin</option>
          <option value="user" {{ (old('hak_akses', $editData->hak_akses ?? '') == 'user') ? 'selected' : '' }}>User</option>
        </select>
      </div>

      <div class="mb-4">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Kata Sandi">
        @if(isset($editData))
          <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
        @endif
      </div>

      <div class="d-flex flex-wrap gap-2">
        <button type="submit" class="btn btn-success">{{ isset($editData) ? 'Update' : 'Simpan' }}</button>
        <a href="{{ route('pengguna.index') }}" class="btn btn-primary">Reset</a>
      </div>
    </form>
  </div>
</div>


      <!-- Tabel Data Pengguna -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-3">Data Pengguna</h5>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-light">
                <tr>
                  <th>ID Pengguna</th>
                  <th>Nama Pengguna</th>
                  <th>Jabatan</th>
                  <th>Hak Akses</th>
                  <th class="text-center" style="width: 80px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
  @forelse ($pengguna as $item)
    <tr>
      <td>{{ $item->id_pengguna }}</td>
      <td>{{ $item->nama_pengguna }}</td>
      <td>{{ $item->jabatan }}</td>
      <td>{{ ucfirst($item->hak_akses) }}</td>
      <td class="text-center d-flex gap-1 justify-content-center">
        <!-- Tombol Edit -->
        <a href="{{ route('pengguna.index', ['edit' => $item->id]) }}" class="btn btn-sm btn-warning" title="Edit">
          <i class="bi bi-pencil-square"></i>
        </a>

        <!-- Tombol Hapus -->
        <form action="{{ route('pengguna.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
      <td colspan="5" class="text-center">Tidak ada data pengguna</td>
    </tr>
  @endforelse
</tbody>

            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

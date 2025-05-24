<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Master Tujuan Surat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"/>
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

  <!-- Konten -->
  <div class="content">
    <div class="content-inner">

      <!-- Header -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold m-0">Master Tujuan Surat</h5>
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
          <li class="breadcrumb-item active" aria-current="page">Tujuan Surat</li>
        </ol>
      </nav>

      <!-- Flash Message -->
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <!-- Form -->
      <div class="card shadow-sm mb-5">
        <div class="card-body">
          <h4 class="card-title text-center mb-4">
            {{ isset($editMode) ? 'Edit Tujuan Surat' : 'Form Master Tujuan Surat' }}
          </h4>

          <form action="{{ isset($editMode) ? route('tujuan-surat.update', $tujuanEdit->id_tujuan) : route('tujuan-surat.store') }}" method="POST">
            @csrf
            @if(isset($editMode))
              @method('PUT')
            @endif

            <div class="mb-3">
              <label for="id_tujuan" class="form-label">ID Tujuan</label>
              <input type="text" class="form-control" name="id_tujuan" value="{{ old('id_tujuan', $tujuanEdit->id_tujuan ?? '') }}" {{ isset($editMode) ? 'readonly' : 'required' }}>
            </div>

            <div class="mb-3">
              <label class="form-label">Nama Penerima</label>
              <input type="text" class="form-control" name="nama_penerima" value="{{ old('nama_penerima', $tujuanEdit->nama_penerima ?? '') }}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Instansi</label>
              <input type="text" class="form-control" name="instansi" value="{{ old('instansi', $tujuanEdit->instansi ?? '') }}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $tujuanEdit->alamat ?? '') }}" required>
            </div>

            <div class="mb-4">
              <label class="form-label">Kontak</label>
              <input type="text" class="form-control" name="kontak" value="{{ old('kontak', $tujuanEdit->kontak ?? '') }}" required>
            </div>

            <div class="d-flex flex-wrap gap-2">
              <button class="btn btn-success" type="submit">{{ isset($editMode) ? 'Update' : 'Simpan' }}</button>
              @if(isset($editMode))
                <a href="{{ route('tujuan-surat.index') }}" class="btn btn-secondary">Batal</a>
              @else
                <a href="{{ route('tujuan-surat.index') }}" class="btn btn-primary">Tampilkan</a>
              @endif
            </div>
          </form>
        </div>
      </div>

      <!-- Tabel Data -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-3">Data Tujuan Surat</h5>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-light">
                <tr>
                  <th>ID Tujuan</th>
                  <th>Nama Penerima</th>
                  <th>Instansi</th>
                  <th>Alamat</th>
                  <th>Kontak</th>
                  <th class="text-center" style="width: 100px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($tujuanSurat as $tujuan)
                  <tr>
                    <td>{{ $tujuan->id_tujuan }}</td>
                    <td>{{ $tujuan->nama_penerima }}</td>
                    <td>{{ $tujuan->instansi }}</td>
                    <td>{{ $tujuan->alamat }}</td>
                    <td>{{ $tujuan->kontak }}</td>
                    <td class="text-center d-flex gap-1 justify-content-center">
                      <a href="{{ route('tujuan-surat.edit', $tujuan->id_tujuan) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                      <form action="{{ route('tujuan-surat.destroy', $tujuan->id_tujuan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="6" class="text-center">Belum ada data.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div> <!-- end content-inner -->
  </div> <!-- end content -->
</div> <!-- end wrapper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

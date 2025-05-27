<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Master Jenis Surat</title>
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

  <!-- Konten utama scrollable -->
  <div class="content">
    <div class="content-inner">

      <!-- Header -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold m-0">Master Jenis Surat</h5>
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
          <li class="breadcrumb-item active" aria-current="page">Jenis Surat</li>
        </ol>
      </nav>

      <!-- Alert -->
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <!-- Form -->
      <div class="card shadow-sm w-100 mb-5">
        <div class="card-body">
          <h4 class="card-title text-center mb-4">Form Jenis Surat</h4>
          <form action="{{ isset($editData) ? route('jenis-surat.update', $editData->id) : route('jenis-surat.store') }}" method="POST">
            @csrf
            @if(isset($editData))
              @method('PUT')
            @endif

            <div class="mb-3">
              <label for="id_jenis_surat" class="form-label">ID Jenis Surat</label>
              <input type="text" class="form-control @error('id_jenis_surat') is-invalid @enderror" name="id_jenis_surat" id="id_jenis_surat"
                     value="{{ old('id_jenis_surat', $editData->id_jenis_surat ?? '') }}" {{ isset($editData) ? 'readonly' : '' }} placeholder="Masukkan ID">
              @error('id_jenis_surat')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="nama_jenis_surat" class="form-label">Nama Jenis Surat</label>
              <input type="text" class="form-control @error('nama_jenis_surat') is-invalid @enderror" name="nama_jenis_surat" id="nama_jenis_surat"
                     value="{{ old('nama_jenis_surat', $editData->nama_jenis_surat ?? '') }}" placeholder="Contoh: Surat Permohonan">
              @error('nama_jenis_surat')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-flex flex-wrap gap-2">
              <button type="submit" class="btn btn-success">
                {{ isset($editData) ? 'Update' : 'Simpan' }}
              </button>
              <a href="{{ route('jenis-surat.index') }}" class="btn btn-primary">Reset</a>
            </div>
          </form>
        </div>
      </div>

      <!-- Table -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-3">Data Jenis Surat</h5>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-light">
                <tr>
                  <th scope="col">ID Jenis Surat</th>
                  <th scope="col">Nama Jenis Surat</th>
                  <th scope="col" class="text-center" style="width: 120px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($data as $row)
                  <tr>
                    <td>{{ $row->id_jenis_surat }}</td>
                    <td>{{ $row->nama_jenis_surat }}</td>
                    <td class="text-center">
                      <a href="{{ route('jenis-surat.edit', $row->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                      <form action="{{ route('jenis-surat.destroy', $row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" title="Hapus">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="text-center">Data tidak ditemukan.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div> <!-- content-inner -->
  </div> <!-- content -->
</div> <!-- wrapper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

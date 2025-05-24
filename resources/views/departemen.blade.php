<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Master Departement</title>
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
        <h5 class="fw-bold m-0">Master Departement</h5>
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
          <li class="breadcrumb-item active" aria-current="page">Departement</li>
        </ol>
      </nav>

      <!-- Form Departement -->
      <div class="card shadow-sm mb-5">
        <div class="card-body">
          <h4 class="card-title text-center mb-4">Form Master Departement</h4>
          @if(isset($departement))
<form action="{{ route('departement.update', $departement->id) }}" method="POST">
  @method('PUT')
@else
<form action="{{ route('departement.store') }}" method="POST">
@endif
  @csrf
  <div class="mb-3">
    <label for="kode" class="form-label">ID Departement</label>
    <input type="text" class="form-control" name="kode" value="{{ old('kode', $departement->kode ?? '') }}" placeholder="Masukkan ID Departement">
  </div>
  <div class="mb-4">
    <label for="nama" class="form-label">Nama Departement</label>
    <input type="text" class="form-control" name="nama" value="{{ old('nama', $departement->nama ?? '') }}" placeholder="Masukkan Nama Departement">
  </div>
  <div class="d-flex flex-wrap gap-2">
    <button type="submit" class="btn btn-success">{{ isset($departement) ? 'Update' : 'Simpan' }}</button>
    <a href="{{ route('departement.index') }}" class="btn btn-primary">Tampilkan</a>
    </div>
</form>
        </div>
      </div>

      <!-- Tabel Departement -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-3">Data Departement</h5>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-light">
                <tr>
                  <th scope="col">ID Departement</th>
                  <th scope="col">Nama Departement</th>
                  <th scope="col" class="text-center" style="width: 80px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
  @forelse ($departements as $dept)
    <tr>
      <td>{{ $dept->kode }}</td>
      <td>{{ $dept->nama }}</td>
      <td class="text-center d-flex gap-1 justify-content-center">
        <a href="{{ route('departement.edit', $dept->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
        <form action="{{ route('departement.destroy', $dept->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
        </form>
      </td>
    </tr>
  @empty
    <tr><td colspan="3" class="text-center">Tidak ada data</td></tr>
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

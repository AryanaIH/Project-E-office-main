<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Master Proyek</title>
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
  <div class="sidebar">
    @include('layout.navbar')
  </div>

  <div class="content">
    <div class="content-inner">

      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold m-0">Master Proyek</h5>
        <div class="d-flex align-items-center">
          <img src="{{ asset('img/user-icon.png') }}" alt="User Icon" width="20" class="me-2" />
          <span>Admin</span>
        </div>
      </div>

      <hr class="mb-4 mt-2">

      <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-body-tertiary p-2 rounded">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Master Proyek</li>
        </ol>
      </nav>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <!-- Form -->
      <div class="card shadow-sm w-100 mb-5">
        <div class="card-body">
          <h4 class="card-title text-center mb-4">Form Proyek</h4>
          <form action="{{ isset($editData) ? route('master-proyek.update', $editData->id) : route('master-proyek.store') }}" method="POST">
            @csrf
            @if(isset($editData)) @method('PUT') @endif

            <div class="row mb-3">
              <div class="col">
                <label for="id_proyek" class="form-label">ID Proyek</label>
                <input type="number" class="form-control" name="id_proyek" id="id_proyek"
                  value="{{ old('id_proyek', $editData->id_proyek ?? '') }}" required {{ isset($editData) ? 'readonly' : '' }}>
              </div>
              <div class="col">
                <label for="nama_proyek" class="form-label">Nama Proyek</label>
                <input type="text" class="form-control" name="nama_proyek" id="nama_proyek"
                  value="{{ old('nama_proyek', $editData->nama_proyek ?? '') }}" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col">
                <label for="client" class="form-label">Client</label>
                <input type="text" class="form-control" name="client" id="client"
                  value="{{ old('client', $editData->client ?? '') }}" required>
              </div>
              <div class="col">
                <label for="lokasi_proyek" class="form-label">Lokasi Proyek</label>
                <input type="text" class="form-control" name="lokasi_proyek" id="lokasi_proyek"
                  value="{{ old('lokasi_proyek', $editData->lokasi_proyek ?? '') }}" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col">
                <label for="jenis_proyek" class="form-label">Jenis Proyek</label>
                <input type="text" class="form-control" name="jenis_proyek" id="jenis_proyek"
                  value="{{ old('jenis_proyek', $editData->jenis_proyek ?? '') }}" required>
             <div class="row mb-3">
            <div class="col">
              <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
              <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai"
                value="{{ old('tanggal_mulai', isset($editData) ? \Carbon\Carbon::parse($editData->tanggal_mulai)->format('Y-m-d') : '') }}" required>
            </div>
            <div class="col">
              <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
              <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai"
                value="{{ old('tanggal_selesai', isset($editData) ? \Carbon\Carbon::parse($editData->tanggal_selesai)->format('Y-m-d') : '') }}" required>
            </div>
          </div>
            <div class="mb-3">
              <label for="status_proyek" class="form-label">Status Proyek</label>
              <select class="form-select" name="status_proyek" id="status_proyek" required>
                @php
                  $statusOptions = [
                    'terkirim' => 'Terkirim',
                    'menunggu persetujuan' => 'Menunggu Persetujuan',
                    'draft' => 'Draft',
                    'disetujui' => 'Disetujui',
                    'ditolak' => 'Ditolak',
                  ];
                  $selectedStatus = old('status_proyek', $editData->status_proyek ?? '');
                @endphp

                <option value="" disabled {{ $selectedStatus == '' ? 'selected' : '' }}>-- Pilih Status --</option>
                @foreach($statusOptions as $key => $label)
                  <option value="{{ $key }}" {{ $selectedStatus == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>

            <div class="d-flex flex-wrap gap-2">
              <button type="submit" class="btn btn-success">{{ isset($editData) ? 'Update' : 'Simpan' }}</button>
              <a href="{{ route('master-proyek.index') }}" class="btn btn-primary">Reset</a>
            </div>
          </form>
        </div>
      </div>

      <!-- Table -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-3">Data Proyek</h5>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-light">
                <tr>
                  <th>ID Proyek</th>
                  <th>Nama Proyek</th>
                  <th>Client</th>
                  <th>Lokasi</th>
                  <th>Jenis</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Status</th>
                  <th class="text-center" style="width: 120px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($data as $row)
                  @php
                    $statusClass = match($row->status_proyek) {
                      'terkirim' => 'bg-info',
                      'menunggu persetujuan' => 'bg-warning text-dark',
                      'draft' => 'bg-secondary',
                      'disetujui' => 'bg-success',
                      'ditolak' => 'bg-danger',
                      default => 'bg-light text-dark',
                    };
                  @endphp
                  <tr>
                    <td>{{ $row->id_proyek }}</td>
                    <td>{{ $row->nama_proyek }}</td>
                    <td>{{ $row->client }}</td>
                    <td>{{ $row->lokasi_proyek }}</td>
                    <td>{{ $row->jenis_proyek }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d-m-Y') }}</td>
                    <td>
                      <span class="badge {{ $statusClass }}">
                        {{ ucfirst($row->status_proyek) }}
                      </span>
                    </td>
                    <td class="text-center">
                      <a href="{{ route('master-proyek.edit', $row->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                      <form action="{{ route('master-proyek.destroy', $row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus?')">
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
                    <td colspan="9" class="text-center">Data tidak ditemukan.</td>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

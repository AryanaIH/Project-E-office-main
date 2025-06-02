<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Proyek</title>
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

    .project-header {
      background-color: #ffffff;
      border: 1px solid #dee2e6;
      border-left: 5px solid orange;
      padding: 1.5rem;
      margin-bottom: 1rem;
    }

    .project-info label {
      font-weight: bold;
    }

    .doc-item {
      background-color: #fff;
      border: 1px solid #dee2e6;
      border-radius: 6px;
      padding: 1rem;
      margin-bottom: 1rem;
    }

    .doc-item .bi-check-circle {
      color: green;
    }

    .doc-item .bi-x-circle {
      color: red;
    }
  </style>
</head>
<body>

<div class="wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    @include('layout.navbar')
  </div>

  <!-- Content -->
  <div class="content">
    <h4 class="mb-4 fw-bold">Detail Proyek</h4>

      <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/monitoringProyek">Monitoring Proyek</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail Proyek</li>
    </ol>
  </nav>
  <!-- Tombol Kembali -->
  <div class="mb-4">
    <a href="/monitoringProyek" class="btn btn-secondary">
      <i class="bi bi-arrow-left"></i> Kembali ke Monitoring Proyek
    </a>
  </div>
    <!-- Project Header -->
    <div class="project-header">
      <div class="row">
        <div class="col-md-8">
          <h5 class="fw-bold">
            {{ $proyek->nama_proyek }}
            <span class="badge 
              @if(strtolower($proyek->status_proyek) === 'at risk') bg-warning text-dark
              @elseif(strtolower($proyek->status_proyek) === 'on track') bg-success
              @elseif(strtolower($proyek->status_proyek) === 'terlambat') bg-danger
              @else bg-secondary
              @endif ms-2">
              {{ $proyek->status_proyek }}
            </span>
          </h5>

          <div class="row mt-3">
            <div class="col-md-6">
              <p><label>ID Proyek:</label> {{ $proyek->id_proyek ?? 'PRI-'.$proyek->id }}</p>
              <p><label>Tanggal Mulai:</label> {{ \Carbon\Carbon::parse($proyek->tanggal_mulai)->translatedFormat('d F Y') }}</p>
              <p><label>Deadline:</label> <span class="text-danger">{{ \Carbon\Carbon::parse($proyek->tanggal_selesai)->translatedFormat('d F Y') }}</span></p>
              <p><label>Nilai Proyek:</label> Rp {{ number_format($proyek->nilai_proyek ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="col-md-6">
              <p><label>Client:</label> {{ $proyek->client }}</p>
            </div>
          </div>
        </div>

        <!-- Progress -->
        <div class="col-md-4 text-end">
          <p><label>Progress Syarat Dokumen:</label></p>
          @php
            $progress = $totalSyarat > 0 ? round(($dokumenUploaded / $totalSyarat) * 100) : 0;
          @endphp
          <div class="progress mb-2" style="height: 8px;">
            <div class="progress-bar bg-info" role="progressbar"
                 style="width: {{ $progress }}%;"
                 aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <small>{{ $dokumenUploaded }}/{{ $totalSyarat }} ({{ $progress }}%)</small>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

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
      margin: 0;
      padding: 0;
      height: 100%;
      overflow: hidden;
      background-color: #f8f9fa;
    }

    .wrapper {
      display: flex;
      height: 100vh;
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
      padding: 1.5rem;
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
  </style>
</head>
<body>

<div class="wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    @include('layout.navbar') <!-- Include your sidebar/navbar here -->
  </div>

  <!-- Content Area -->
  <div class="content">
    <div class="content-inner">
      <h4 class="mb-4 fw-bold">Detail Proyek</h4>

    <!-- Header Project Detail -->
    <div class="project-header">
      <div class="row">
        <div class="col-md-8">
          <h5 class="fw-bold">Pengembangan Sistem ERP <span class="badge bg-warning text-dark ms-2">At Risk</span></h5>
          <div class="row mt-3">
            <div class="col-md-6">
              <p><label>ID Proyek:</label> PRI-2025-001</p>
              <p><label>Tanggal Mulai:</label> 10 Januari 2025</p>
              <p><label>Deadline:</label> <span class="text-danger">20 Juli 2025</span></p>
              <p><label>Nilai Proyek:</label> Rp 500.000.000</p>
            </div>
            <div class="col-md-6">
              <p><label>Client:</label> PT Maju Bersama</p>
              <p><label>PIC Client:</label> Budi Santoso (IT Manager)</p>
              <p><label>PIC Internal:</label> Ahmad Rizki (Project Manager)</p>
              <p><label>Departemen:</label> Divisi Teknologi Informasi</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-end">
          <p><label>Progress Syarat Dokumen:</label></p>
          <div class="progress mb-2">
            <div class="progress-bar bg-info" role="progressbar" style="width: 53%;" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100">8/15 (53%)</div>
          </div>
          <button class="btn btn-primary me-2"><i class="bi bi-pencil"></i> Edit Proyek</button>
          <button class="btn btn-warning"><i class="bi bi-download"></i> Export Data</button>
        </div>
      </div>
    </div>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item">
        <a class="nav-link active" href="#">Dokumen Syarat</a>
    </ul>

    <!-- Dokumen Syarat -->
    <div>
      <div class="doc-item d-flex justify-content-between align-items-center">
        <div><i class="bi bi-check-circle me-2"></i>1. Surat Perjanjian Kerjasama (SPK)</div>
        <div>
          <span class="text-success">Lengkap - Diupload 15 Jan 2025</span>
          <button class="btn btn-sm btn-outline-secondary ms-3"><i class="bi bi-paperclip"></i> Attachment</button>
        </div>
      </div>

      <div class="doc-item d-flex justify-content-between align-items-center">
        <div><i class="bi bi-check-circle me-2"></i>2. Dokumen Penawaran</div>
        <div>
          <span class="text-success">Lengkap - Diupload 15 Jan 2025</span>
          <button class="btn btn-sm btn-outline-secondary ms-3"><i class="bi bi-paperclip"></i> Attachment</button>
        </div>
      </div>

      <div class="doc-item d-flex justify-content-between align-items-center">
        <div><i class="bi bi-check-circle me-2"></i>3. Rencana Anggaran Biaya (RAB)</div>
        <div>
          <span class="text-success">Lengkap - Diupload 15 Jan 2025</span>
          <button class="btn btn-sm btn-outline-secondary ms-3"><i class="bi bi-paperclip"></i> Attachment</button>
        </div>
      </div>

      <div class="doc-item d-flex justify-content-between align-items-center">
        <div><i class="bi bi-check-circle me-2"></i>4. Dokumen Spesifikasi Teknis</div>
        <div>
          <span class="text-success">Lengkap - Diupload 20 Jan 2025</span>
          <button class="btn btn-sm btn-outline-secondary ms-3"><i class="bi bi-paperclip"></i> Attachment</button>
        </div>
      </div>

      <div class="doc-item d-flex justify-content-between align-items-center">
        <div><i class="bi bi-check-circle me-2"></i>5. Jadwal Pelaksanaan Proyek</div>
        <div>
          <span class="text-success">Lengkap - Diupload 28 Jan 2025</span>
          <button class="btn btn-sm btn-outline-secondary ms-3"><i class="bi bi-paperclip"></i> Attachment</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

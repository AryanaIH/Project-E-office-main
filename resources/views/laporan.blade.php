<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Proyek</title>
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

    .content-inner {
      min-height: 100%;
    }

    .badge-custom {
      font-size: 0.75rem;
      padding: 6px 10px;
      border-radius: 12px;
    }

    .btn-purple {
      background-color: #6f42c1;
      color: #fff;
    }

    .btn-purple:hover {
      background-color: #5a32a3;
      color: #fff;
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
      <h4 class="mb-4 fw-bold">Laporan Proyek</h4>

    <!-- Filter Laporan -->
    <div class="row g-3 mb-4">
      <div class="col-md-3">
        <label>Rentang Waktu</label>
        <input type="date" class="form-control">
      </div>
      <div class="col-md-3">
        <label>Sampai Tanggal</label>
        <input type="date" class="form-control">
      </div>
      <div class="col-md-3">
        <label>Status Proyek</label>
        <select class="form-select">
          <option>Semua</option>
          <option>On Track</option>
          <option>Completed</option>
          <option>Delayed</option>
        </select>
      </div>
      <div class="col-md-3 d-flex align-items-end">
        <button class="btn btn-primary w-100"><i class="bi bi-funnel-fill"></i> Filter</button>
      </div>
    </div>

    <!-- Tabel Laporan -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped text-center">
        <thead class="table-light">
          <tr>
            <th>Nama Proyek</th>
            <th>Client</th>
            <th>Tanggal Mulai</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Progress</th>
            <th>Laporan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Aplikasi Keuangan</td>
            <td>PT Abadi</td>
            <td>01 Jan 2025</td>
            <td>30 Jun 2025</td>
            <td><span class="badge bg-success">On Track</span></td>
            <td>75%</td>
            <td><a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i> Unduh</a></td>
          </tr>
          <tr>
            <td>Sistem HRD</td>
            <td>CV Sejahtera</td>
            <td>15 Feb 2025</td>
            <td>30 Jul 2025</td>
            <td><span class="badge bg-warning text-dark">At Risk</span></td>
            <td>50%</td>
            <td><a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i> Unduh</a></td>
          </tr>
          <tr>
            <td>Infrastruktur IT</td>
            <td>PT Sukses Makmur</td>
            <td>01 Mar 2025</td>
            <td>01 Sep 2025</td>
            <td><span class="badge bg-danger">Delayed</span></td>
            <td>35%</td>
            <td><a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i> Unduh</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

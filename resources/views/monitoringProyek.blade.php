<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Monitoring Proyek</title>
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
    .progress-bar {
      height: 6px;
      border-radius: 4px;
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
  <div class="sidebar">
    @include('layout.navbar')
  </div>

  <div class="content">
    <h4 class="mb-4 fw-bold">Daftar Monitoring Proyek</h4>

    <!-- Filter -->
    <div class="row g-2 align-items-end mb-4">
      <div class="col-md-2">
        <label>Status</label>
        <select class="form-select" id="filter-status">
          <option value="">Semua Status</option>
          <option value="Baru">Baru</option>
          <option value="Berjalan">Berjalan</option>
          <option value="Selesai">Selesai</option>
          <option value="Ditolak">Ditolak</option>
          <option value="ditolak">Disetujui</option>
        </select>
      </div>
      <div class="col-md-2">
      <label>Client</label>
      <select class="form-select" id="filter-klien">
        <option value="">Semua Client</option>
        @foreach($klienList as $klien)
          <option value="{{ $klien }}">{{ $klien }}</option>
        @endforeach
      </select>
    </div>
      <div class="col-md-2">
        <label>Tanggal Mulai</label>
        <input type="date" class="form-control" id="filter-mulai">
      </div>
      <div class="col-md-2">
        <label>Tanggal Selesai</label>
        <input type="date" class="form-control" id="filter-selesai">
      </div>
      <div class="col-md-3">
        <label>Cari proyek...</label>
        <input type="text" class="form-control" placeholder="Cari proyek..." id="filter-keyword">
      </div>
      <div class="col-md-1 text-end">
        <button class="btn btn-primary w-100" id="filter-btn"><i class="bi bi-funnel-fill"></i></button>
      </div>
    </div>

    <!-- Tabel -->
    <div class="table-responsive mb-3">
      <table class="table" id="project-table">
        <thead>
          <tr>
            <th>Nama Proyek</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Klien</th>
            <th>Status</th>
            <th>File</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="project-table-body">
          @foreach($praProyeks as $proyek)
            <tr data-visible="true">
              <td>{{ $proyek->nama_proyek }}</td>
              <td>{{ $proyek->tanggal_mulai }}</td>
              <td>{{ $proyek->tanggal_selesai }}</td>
              <td>{{ $proyek->client }}</td>
              <td>
                @php
                  $status = strtolower($proyek->status_proyek);
                  $badgeClass = match ($status) {
                    'on track' => 'bg-success',
                    'terlambat' => 'bg-warning',
                    'selesai' => 'bg-primary',
                    default => 'bg-secondary'
                  };
                @endphp
                <span class="badge {{ $badgeClass }}">{{ $proyek->status_proyek }}</span>
              </td>
              <td>
                @php
                  $docs = [
                    'surat_permohonan',
                    'rab',
                    'dokumen_teknis',
                    'proposal_teknis',
                    'izin_lokasi',
                    'kontrak_kerja',
                  ];
                  $totalDocs = count($docs);
                  $uploadedCount = $proyek->dokumen_proyeks_count;

                  foreach ($docs as $docKey) {
                    if (!empty($proyek->$docKey)) {
                      $uploadedCount++;
                    }
                  }

                  $progressPercent = ($uploadedCount / $totalDocs) * 100;
                  $progressBarClass = $progressPercent == 100 ? 'bg-success' : 'bg-secondary';
                @endphp
                {{ $uploadedCount }} / {{ $totalDocs }} syarat
                <div class="progress mt-1">
                  <div class="progress-bar {{ $progressBarClass }}" style="width: {{ $progressPercent }}%"></div>
                </div>
              </td>
              <td>
                <a href="{{ url('/detail/'.$proyek->id) }}" class="btn btn-sm btn-primary">Detail</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
      <nav>
        <ul class="pagination" id="pagination"></ul>
      </nav>
    </div>
  </div>
</div>

<!-- Scripts -->
<script>
  const rowsPerPage = 10;
  let currentPage = 1;

  function showPage(page) {
    const allRows = document.querySelectorAll('#project-table-body tr:not(.detail-row)');
    const visibleRows = Array.from(allRows).filter(row => row.dataset.visible === "true");

    const totalPages = Math.ceil(visibleRows.length / rowsPerPage);
    if (totalPages === 0) {
      document.getElementById('pagination').innerHTML = '';
      allRows.forEach(row => row.style.display = 'none');
      return;
    }

    if (page < 1) page = 1;
    if (page > totalPages) page = totalPages;

    allRows.forEach(row => row.style.display = 'none');
    visibleRows.forEach((row, index) => {
      row.style.display = (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) ? '' : 'none';
    });

    renderPagination(visibleRows.length, page);
    currentPage = page;
  }

  function renderPagination(totalVisible, activePage) {
    const totalPages = Math.ceil(totalVisible / rowsPerPage);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    if (totalPages <= 1) return;

    const createPageItem = (label, page, isActive = false, isDisabled = false) => {
      const li = document.createElement('li');
      li.className = `page-item ${isActive ? 'active' : ''} ${isDisabled ? 'disabled' : ''}`;
      const a = document.createElement('a');
      a.className = 'page-link';
      a.href = '#';
      a.dataset.page = page;
      a.innerText = label;
      li.appendChild(a);
      return li;
    };

    pagination.appendChild(createPageItem('«', activePage - 1, false, activePage === 1));
    for (let i = 1; i <= totalPages; i++) {
      pagination.appendChild(createPageItem(i, i, i === activePage));
    }
    pagination.appendChild(createPageItem('»', activePage + 1, false, activePage === totalPages));

    pagination.querySelectorAll('a.page-link').forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        const page = parseInt(this.dataset.page);
        if (!isNaN(page)) showPage(page);
      });
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('#project-table-body tr:not(.detail-row)').forEach(row => {
      row.dataset.visible = "true";
    });

    document.getElementById('filter-btn').addEventListener('click', function () {
      const status = document.getElementById('filter-status').value.toLowerCase();
      const klien = document.getElementById('filter-klien').value.toLowerCase();
      const mulai = document.getElementById('filter-mulai').value;
      const selesai = document.getElementById('filter-selesai').value;
      const keyword = document.getElementById('filter-keyword').value.toLowerCase();

      const rows = document.querySelectorAll('#project-table-body tr:not(.detail-row)');
      rows.forEach(row => {
        const nama = row.cells[0].textContent.toLowerCase();
        const tglMulai = row.cells[1].textContent;
        const tglSelesai = row.cells[2].textContent;
        const klienRow = row.cells[3].textContent.toLowerCase();
        const statusRow = row.cells[4].textContent.toLowerCase();

        const cocokStatus = !status || statusRow.includes(status);
        const cocokKlien = !klien || klienRow.includes(klien);
        const cocokKeyword = !keyword || nama.includes(keyword);
        const cocokTanggal = (!mulai || tglMulai >= mulai) && (!selesai || tglSelesai <= selesai);

        row.dataset.visible = (cocokStatus && cocokKlien && cocokKeyword && cocokTanggal) ? "true" : "false";
      });

      showPage(1);
    });

    showPage(1);
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

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
    .content-inner {
      min-height: 100%;
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
    <div class="content-inner">
      <h4 class="mb-4 fw-bold">Daftar Monitoring Proyek</h4>

      <!-- Filter -->
      <div class="row g-2 align-items-end mb-4">
        <div class="col-md-2">
          <label>Status</label>
          <select class="form-select" id="filter-status">
            <option value="">Semua Status</option>
            <option value="On Track">On Track</option>
            <option value="Terlambat">Terlambat</option>
            <option value="Selesai">Selesai</option>
          </select>
        </div>
        <div class="col-md-2">
          <label>Client</label>
          <select class="form-select" id="filter-klien">
            <option value="">Semua Client</option>
            <option value="PT Maju Bersama">PT Maju Bersama</option>
            <option value="PT ABC">PT ABC</option>
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
      <div class="table-responsive">
        <table class="table" id="project-table">
          <thead>
            <tr>
              <th>Nama Proyek</th>
              <th>Mulai</th>
              <th>Selesai</th>
              <th>Klien</th>
              <th>Status</th>
              <th>Progress</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="project-table-body">
            <tr>
              <td>Pengembangan Sistem ERP</td>
              <td>2025-01-10</td>
              <td>2025-07-20</td>
              <td>PT Maju Bersama</td>
              <td><span class="badge bg-success">On Track</span></td>
              <td>
                12 / 18 syarat
                <div class="progress mt-1">
                  <div class="progress-bar bg-primary" style="width: 66.7%"></div>
                </div>
              </td>
              <td>
              <a href="/laporan" class="btn btn-sm btn-primary">Detail</a>
              </td>
            </tr>
            <tr>
              <td>Aplikasi Inventory</td>
              <td>2025-02-01</td>
              <td>2025-06-30</td>
              <td>PT ABC</td>
              <td><span class="badge bg-warning">Terlambat</span></td>
              <td>
                5 / 10 syarat
                <div class="progress mt-1">
                  <div class="progress-bar bg-warning" style="width: 50%"></div>
                </div>
              </td>
              <td>
              <a href="/laporan" class="btn btn-sm btn-primary">Detail</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-center mt-3">
        <nav>
          <ul class="pagination" id="pagination"></ul>
        </nav>
      </div>

    </div>
  </div>
</div>

<script>
  const rowsPerPage = 1;
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
    // Set all rows visible initially
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

    document.getElementById('project-table-body').addEventListener('click', function (e) {
      if (e.target.closest('.detail-btn')) {
        e.preventDefault();
        const btn = e.target.closest('.detail-btn');
        const detailText = btn.getAttribute('data-detail');
        const existingDetailRow = this.querySelector('.detail-row');
        if (existingDetailRow) existingDetailRow.remove();

        const currentRow = btn.closest('tr');
        const detailRow = document.createElement('tr');
        detailRow.classList.add('detail-row');
        detailRow.innerHTML = `
          <td colspan="7">
            <div class="p-3 bg-light border rounded">
              <strong>Detail Proyek:</strong>
              <p>${detailText}</p>
            </div>
          </td>`;
        currentRow.insertAdjacentElement('afterend', detailRow);
      }
    });

    showPage(1);
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

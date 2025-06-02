<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Pra-Proyek</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
        }
        .content {
            flex-grow: 1;
            overflow-y: auto;
            padding: 2rem;
            background-color: #f5f5f5;
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
        #modalSyaratDokumen .modal-body {
          max-height: 70vh;
          overflow-y: auto;
        }
    </style>
</head>
<body>

<div class="wrapper">
  <nav class="sidebar">
    @include('layout.navbar')
  </nav>

  <main class="content">
    <h4 class="mb-4 fw-bold">Daftar Pra-Proyek</h4>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah -->
    <div class="mb-3 d-flex justify-content-end flex-wrap gap-2">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Pra-Proyek
      </button>
    </div>
    <!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form action="{{ route('pra-proyek.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahLabel">Tambah Pra-Proyek</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label for="nama_proyek" class="form-label">Nama Proyek</label>
            <select name="nama_proyek" id="nama_proyek" class="form-select" required>
              <option value="" disabled selected>-- Pilih Nama Proyek --</option>
              @foreach($listProyek as $proyek)
                <option value="{{ $proyek->id }}" 
                  data-client="{{ $proyek->client }}" 
                  data-lokasi="{{ $proyek->lokasi_proyek }}" 
                  data-jenis="{{ $proyek->jenis_proyek }}" 
                  data-tanggal_mulai="{{ $proyek->tanggal_mulai }}" 
                  data-tanggal_selesai="{{ $proyek->tanggal_selesai }}" 
                  data-status="{{ $proyek->status_proyek }}">
                  {{ $proyek->nama_proyek }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="row g-3">
            <div class="col-12 col-md-6">
              <label for="client" class="form-label">Client</label>
              <input type="text" name="client" id="client" class="form-control" readonly />
            </div>
            <div class="col-12 col-md-6">
              <label for="lokasi" class="form-label">Lokasi</label>
              <input type="text" name="lokasi_proyek" id="lokasi_proyek" class="form-control" readonly />
            </div>
          </div>

          <div class="row g-3 mt-2">
            <div class="col-12 col-md-6">
              <label for="jenis_proyek" class="form-label">Jenis Proyek</label>
              <input type="text" name="jenis_proyek" id="jenis_proyek" class="form-control" readonly />
            </div>
            <div class="col-6 col-md-3">
              <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
              <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" readonly />
            </div>
            <div class="col-6 col-md-3">
              <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
              <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" readonly />
            </div>
          </div>

          <div class="mt-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" name="status_proyek" id="status_proyek" class="form-control" readonly />
          </div>

        </div>
        <div class="modal-footer d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Simpan Proyek</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Syarat Dokumen -->
<div class="modal fade" id="modalSyaratDokumen" tabindex="-1" aria-labelledby="modalSyaratDokumenLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('pra-proyek.storeDokumen') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="pra_proyek_id" id="pra_proyek_id">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="modalSyaratDokumenLabel">Syarat Dokumen Proyek</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-4 p-3 border rounded bg-light">
            <h6 class="fw-bold">Informasi Proyek</h6>
            <p class="mb-1"><strong>Nama Proyek:</strong> <span id="syarat_nama_proyek"></span></p>
            <p class="mb-1"><strong>Klien:</strong> <span id="syarat_client"></span></p>
            <p class="mb-1"><strong>Lokasi:</strong> <span id="syarat_lokasi"></span></p>
            <p class="mb-1"><strong>Jenis:</strong> <span id="syarat_jenis"></span></p>
            <p class="mb-1"><strong>Tanggal:</strong> <span id="syarat_tanggal"></span></p>
            <p class="mb-0"><strong>Status:</strong> <span id="syarat_status_proyek"></span></p>
          </div>

          <!-- Checklist Dokumen -->
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input doc-toggle" type="checkbox" id="surat_permohonan" name="surat_permohonan" />
                <label class="form-check-label" for="suratPermohonan">Surat Permohonan</label>
              </div>
              <div class="form-check">
                <input class="form-check-input doc-toggle" type="checkbox" id="rab" name="rab" />
                <label class="form-check-label" for="rab">Rencana Anggaran Biaya (RAB)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input doc-toggle" type="checkbox" id="dokumen_teknis" name="dokumen_teknis" />
                <label class="form-check-label" for="dokumenTeknis">Dokumen Teknis</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input doc-toggle" type="checkbox" id="proposal_teknis" name="proposal_teknis" />
                <label class="form-check-label" for="proposalTeknis">Proposal Teknis</label>
              </div>
              <div class="form-check">
                <input class="form-check-input doc-toggle" type="checkbox" id="izin_lokasi" name="izin_lokasi" />
                <label class="form-check-label" for="izinLokasi">Surat Izin Lokasi</label>
              </div>
              <div class="form-check">
                <input class="form-check-input doc-toggle" type="checkbox" id="kontrak_kerja" name="kontrak_kerja" />
                <label class="form-check-label" for="kontrakKerja">Kontrak Kerja</label>
              </div>
            </div>
          </div>

          <!-- Upload Dokumen -->
          <div id="uploadSections">
            @php
              $docs = [
            'surat_permohonan' => 'Surat Permohonan',
            'rab'              => 'Rencana Anggaran Biaya (RAB)',
            'dokumen_teknis'   => 'Dokumen Teknis',
            'proposal_teknis'  => 'Proposal Teknis',
            'izin_lokasi'      => 'Surat Izin Lokasi',
            'kontrak_kerja'    => 'Kontrak Kerja',
          ];

            @endphp

            @foreach($docs as $id => $label)
              <div class="mb-3 upload-section d-none" id="upload_{{ $id }}">
                <label for="file_{{ $id }}" class="form-label fw-bold">{{ $label }} (Pilih Dokumen)</label>
                <select name="{{ $id }}" id="file_{{ $id }}" class="form-select">
                  <option value="">-- Pilih Dokumen --</option>
                  @foreach($dropdownOptions as $docId => $docName)
                    <option value="{{ $docId }}">{{ $docName }}</option>
                  @endforeach
                </select>
              </div>
            @endforeach

          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan Dokumen</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Filter -->
           <form method="GET" action="{{ route('pra-proyek.index') }}">
    <div class="row g-2 mb-3 align-items-end">
        <div class="col-md-2">
            <label for="status_proyek" class="form-label">Status Proyek</label>
            <select class="form-select" name="status_proyek" id="status_proyek">
                <option value="">Semua Status</option>
                <option value="Baru" {{ request('status_proyek') == 'Baru' ? 'selected' : '' }}>Baru</option>
                <option value="Berjalan" {{ request('status_proyek') == 'Berjalan' ? 'selected' : '' }}>Berjalan</option>
                <option value="Selesai" {{ request('status_proyek') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Ditolak" {{ request('status_proyek') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                <option value="Disetujui" {{ request('status_proyek') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
            </select>
        </div>

        <div class="col-md-2">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
        </div>

        <div class="col-md-2">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
        </div>

        <div class="col-md-2">
            <label for="jenis_proyek" class="form-label">Jenis Proyek</label>
            <select class="form-select" name="jenis_proyek" id="jenis_proyek">
                <option value="">Semua Jenis</option>
                <option value="Konstruksi" {{ request('jenis_proyek') == 'Konstruksi' ? 'selected' : '' }}>Konstruksi</option>
                <option value="IT" {{ request('jenis_proyek') == 'IT' ? 'selected' : '' }}>IT</option>
                <option value="Pengadaan" {{ request('jenis_proyek') == 'Pengadaan' ? 'selected' : '' }}>Pengadaan</option>
                <option value="Lainnya" {{ request('jenis_proyek') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>

        <div class="col-md-2">
            <label for="search" class="form-label">Pencarian</label>
            <input type="text" class="form-control" name="search" id="search" placeholder="Cari nama proyek, client, lokasi..." value="{{ request('search') }}">
        </div>

        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>


    <!-- Tabel Daftar Pra-Proyek -->
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-light">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Proyek</th>
            <th scope="col">Client</th>
            <th scope="col">Lokasi</th>
            <th scope="col">Jenis</th>
            <th scope="col">Tanggal Mulai</th>
            <th scope="col">Tanggal Selesai</th>
            <th scope="col">Status</th>
            <th scope="col" style="min-width:130px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($praProyek as $index => $proyek)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $proyek->nama_proyek }}</td>
            <td>{{ $proyek->client }}</td>
            <td>{{ $proyek->lokasi_proyek }}</td>
            <td>{{ $proyek->jenis_proyek }}</td>
            <td>{{ \Carbon\Carbon::parse($proyek->tanggal_mulai)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($proyek->tanggal_selesai)->format('d-m-Y') }}</td>
            <td>
            <span class="badge badge-status
              @if($proyek->status_proyek === 'Aktif') bg-success
              @elseif($proyek->status_proyek === 'Selesai') bg-secondary
              @elseif($proyek->status_proyek === 'Pending') bg-warning text-dark
              @else bg-info
              @endif
            ">
            {{ $proyek->status_proyek }}
            </span>
          </td>
            <td>
        <!-- Tombol Atur Syarat Dokumen -->
          <button class="btn btn-sm btn-warning me-1 btnAturSyarat" 
                data-bs-toggle="modal" 
                data-bs-target="#modalSyaratDokumen"
                data-id="{{ $proyek->id }}"
                data-nama="{{ $proyek->nama_proyek }}"
                data-client="{{ $proyek->client }}"
                data-lokasi="{{ $proyek->lokasi_proyek }}"
                data-jenis="{{ $proyek->jenis_proyek }}"
                data-tanggal="{{ $proyek->tanggal_mulai }} s/d {{ $proyek->tanggal_selesai }}"
                data-status="{{ $proyek->status_proyek }}">
                <i class="bi bi-pencil-square"></i>
          </button>

        <!-- Tombol Hapus -->
        <form action="{{ route('pra-proyek.destroy', $proyek->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus proyek ini?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger">
            <i class="bi bi-trash"></i>
          </button>
        </form>
      </td>
          </tr>
          @empty
          <tr>
            <td colspan="9" class="text-center text-muted">Belum ada data pra-proyek.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const namaProyek = document.getElementById('nama_proyek');

  if (namaProyek) {
    namaProyek.addEventListener('change', function () {
      const selected = this.selectedOptions[0];
      document.getElementById('client').value = selected.getAttribute('data-client') || '';
      document.getElementById('lokasi_proyek').value = selected.getAttribute('data-lokasi') || '';
      document.getElementById('jenis_proyek').value = selected.getAttribute('data-jenis') || '';
      document.getElementById('tanggal_mulai').value = selected.getAttribute('data-tanggal_mulai') || '';
      document.getElementById('tanggal_selesai').value = selected.getAttribute('data-tanggal_selesai') || '';
      document.getElementById('status_proyek').value = selected.getAttribute('data-status') || '';
    });
  }

  function resetDokumenForm() {
    document.querySelectorAll('.doc-toggle').forEach(cb => {
      cb.checked = false;
    });
    document.querySelectorAll('.upload-section').forEach(section => {
      section.classList.add('d-none');
      const inputFile = section.querySelector('input[type="file"]');
      if (inputFile) inputFile.value = '';
    });
  }

  // Toggle upload input saat centang dokumen
  document.querySelectorAll('.doc-toggle').forEach(checkbox => {
    checkbox.addEventListener('change', function () {
      const uploadSection = document.getElementById('upload_' + this.id);
      if (this.checked) {
        uploadSection.classList.remove('d-none');
      } else {
        uploadSection.classList.add('d-none');
        const inputFile = uploadSection.querySelector('input[type="file"]');
        if (inputFile) inputFile.value = '';
      }
    });
  });

  // Event show modal dari Bootstrap untuk isi data ke dalam modal
  const modalSyarat = document.getElementById('modalSyaratDokumen');
  modalSyarat.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    if (!button) return;

    const praProyekId = button.getAttribute('data-id');
    const nama = button.getAttribute('data-nama') || '-';
    const client = button.getAttribute('data-client') || '-';
    const lokasi = button.getAttribute('data-lokasi') || '-';
    const jenis = button.getAttribute('data-jenis') || '-';
    const tanggal = button.getAttribute('data-tanggal') || '-';
    const status = button.getAttribute('data-status') || '-';

    document.getElementById('pra_proyek_id').value = praProyekId;
    document.getElementById('syarat_nama_proyek').textContent = nama;
    document.getElementById('syarat_client').textContent = client;
    document.getElementById('syarat_lokasi').textContent = lokasi;
    document.getElementById('syarat_jenis').textContent = jenis;
    document.getElementById('syarat_tanggal').textContent = tanggal;
    document.getElementById('syarat_status_proyek').textContent = status;

    resetDokumenForm();

    // **Tambah fitur cek file sudah upload**
    // Contoh: ambil data file yang sudah diupload dari backend via API atau data attribute
    // Simulasi data file yang sudah ada (sesuaikan ini dengan backendmu)
    const uploadedFiles = {
      // contoh: 'surat_permohonan': true,
      // 'rab': false,
      // dst...
    };

    // Contoh kalau kamu bisa kirim data lewat attribute, misal data-uploaded-files='{"surat_permohonan":true,...}'
    // let uploadedFiles = {};
    // try {
    //   uploadedFiles = JSON.parse(button.getAttribute('data-uploaded-files') || '{}');
    // } catch(e) {}

    // Toggle checkbox dan tampilkan upload section jika sudah ada file
    Object.entries(uploadedFiles).forEach(([docId, isUploaded]) => {
      if (isUploaded) {
        const cb = document.getElementById(docId);
        const uploadSection = document.getElementById('upload_' + docId);
        if (cb && uploadSection) {
          cb.checked = true;
          uploadSection.classList.remove('d-none');
        }
      }
    });
  });
});
</script>


</body>
</html>
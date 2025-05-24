<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Pra-Proyek</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body, html { height: 100%; margin: 0; padding: 0; }
    .wrapper { display: flex; height: 100vh; overflow: hidden; }
    .sidebar { width: 250px; background-color: #f8f9fa; border-right: 1px solid #dee2e6; flex-shrink: 0; }
    .content { flex-grow: 1; overflow-y: auto; padding: 2rem; background-color: #f5f5f5; }
    .content-inner { min-height: 100%; }
    .badge-status { font-size: 0.75rem; padding: 5px 10px; border-radius: 12px; }
    .btn-purple { background-color: #6f42c1; color: #fff; }
    .btn-purple:hover { background-color: #5a32a3; color: #fff; }
  </style>
</head>
<body>

<div class="wrapper">
  <div class="sidebar">
    @include('layout.navbar')
  </div>

  <div class="content">
    <div class="content-inner">
      <div class="container mt-4">
        <h4 class="mb-4 fw-bold">Daftar Pra-Proyek</h4>

        <!-- Tombol Tambah -->
        <div class="mb-3">
          <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Tambah Pra-Proyek
          </button>
        </div>

      <!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('pra-proyek.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pra-Proyek</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2">
            <label class="form-label">Nama Proyek</label>
            <input type="text" name="nama_proyek" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Klient</label>
            <input type="text" name="klient" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Jenis Proyek</label>
            <select name="jenis_proyek" class="form-select" required>
              <option value="master">Master</option>
              <option value="konsultasi">Konsultasi</option>
              <option value="pengembangan">Pengembangan</option>
            </select>
          </div>
          <div class="row">
            <div class="col-md-6 mb-2">
              <label class="form-label">Tanggal Mulai</label>
              <input type="date" name="tanggal_mulai" class="form-control" required>
            </div>
            <div class="col-md-6 mb-2">
              <label class="form-label">Tanggal Selesai</label>
              <input type="date" name="tanggal_selesai" class="form-control" required>
            </div>
          </div>
          <div class="mb-2">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
              <option value="draft">Draft</option>
              <option value="berjalan">Berjalan</option>
              <option value="selesai">Selesai</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <!-- Button Atur Syarat Dokumen -->
          <button type="button" class="btn btn-secondary" id="btnAturSyarat">Atur Syarat Dokumen</button>

          <!-- Button Simpan Proyek -->
          <button type="submit" class="btn btn-primary">Simpan Proyek</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Syarat Dokumen -->
<div class="modal fade" id="modalSyaratDokumen" tabindex="-1" aria-labelledby="modalSyaratDokumenLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="modalSyaratDokumenLabel">Syarat Dokumen Proyek</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="mb-4 p-3 border rounded bg-light">
          <h6 class="fw-bold">Informasi Proyek</h6>
          <p class="mb-1"><strong>Nama Proyek:</strong> <span id="syarat_nama_proyek"></span></p>
          <p class="mb-1"><strong>Klien:</strong> <span id="syarat_klient"></span></p>
          <p class="mb-1"><strong>Lokasi:</strong> <span id="syarat_lokasi"></span></p>
          <p class="mb-1"><strong>Jenis:</strong> <span id="syarat_jenis"></span></p>
          <p class="mb-1"><strong>Tanggal:</strong> <span id="syarat_tanggal"></span></p>
          <p class="mb-0"><strong>Status:</strong> <span id="syarat_status"></span></p>
        </div>

       <!-- Checklist Dokumen -->
<div class="row mb-3">
  <div class="col-md-6">
    <div class="form-check">
      <input class="form-check-input doc-toggle" type="checkbox" id="suratPermohonan">
      <label class="form-check-label" for="suratPermohonan">Surat Permohonan</label>
    </div>
    <div class="form-check">
      <input class="form-check-input doc-toggle" type="checkbox" id="rab">
      <label class="form-check-label" for="rab">Rencana Anggaran Biaya (RAB)</label>
    </div>
    <div class="form-check">
      <input class="form-check-input doc-toggle" type="checkbox" id="dokumenTeknis">
      <label class="form-check-label" for="dokumenTeknis">Dokumen Teknis</label>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-check">
      <input class="form-check-input doc-toggle" type="checkbox" id="proposalTeknis">
      <label class="form-check-label" for="proposalTeknis">Proposal Teknis</label>
    </div>
    <div class="form-check">
      <input class="form-check-input doc-toggle" type="checkbox" id="izinLokasi">
      <label class="form-check-label" for="izinLokasi">Surat Izin Lokasi</label>
    </div>
    <div class="form-check">
      <input class="form-check-input doc-toggle" type="checkbox" id="kontrakKerja">
      <label class="form-check-label" for="kontrakKerja">Kontrak Kerja</label>
    </div>
  </div>
</div>

<!-- Container Upload Dokumen -->
<div id="uploadSections">
  <div class="upload-section" id="upload_suratPermohonan" style="display: none;">
    <label for="file_suratPermohonan">Surat Permohonan</label>
    <select class="form-select mb-2" id="select_suratPermohonan">
      <option selected>Upload Baru</option>
      <option value="arsip">Ambil dari Arsip</option>
    </select>
    <input class="form-control" type="file" id="file_suratPermohonan">
  </div>

  <div class="upload-section" id="upload_rab" style="display: none;">
    <label for="file_rab">Rencana Anggaran Biaya (RAB)</label>
    <select class="form-select mb-2" id="select_rab">
      <option selected>Upload Baru</option>
      <option value="arsip">Ambil dari Arsip</option>
    </select>
    <input class="form-control" type="file" id="file_rab">
  </div>

  <div class="upload-section" id="upload_dokumenTeknis" style="display: none;">
    <label for="file_dokumenTeknis">Dokumen Teknis</label>
    <select class="form-select mb-2" id="select_dokumenTeknis">
      <option selected>Upload Baru</option>
      <option value="arsip">Ambil dari Arsip</option>
    </select>
    <input class="form-control" type="file" id="file_dokumenTeknis">
  </div>

  <div class="upload-section" id="upload_proposalTeknis" style="display: none;">
    <label for="file_proposalTeknis">Proposal Teknis</label>
    <select class="form-select mb-2" id="select_proposalTeknis">
      <option selected>Upload Baru</option>
      <option value="arsip">Ambil dari Arsip</option>
    </select>
    <input class="form-control" type="file" id="file_proposalTeknis">
  </div>

  <div class="upload-section" id="upload_izinLokasi" style="display: none;">
    <label for="file_izinLokasi">Surat Izin Lokasi</label>
    <select class="form-select mb-2" id="select_izinLokasi">
      <option selected>Upload Baru</option>
      <option value="arsip">Ambil dari Arsip</option>
    </select>
    <input class="form-control" type="file" id="file_izinLokasi">
  </div>

  <div class="upload-section" id="upload_kontrakKerja" style="display: none;">
    <label for="file_kontrakKerja">Kontrak Kerja</label>
    <select class="form-select mb-2" id="select_kontrakKerja">
      <option selected>Upload Baru</option>
      <option value="arsip">Ambil dari Arsip</option>
    </select>
    <input class="form-control" type="file" id="file_kontrakKerja">
  </div>
</div>


        <button class="btn btn-dark" id="btnKembaliInfoProyek">Kembali ke Info Proyek</button>
      </div>
    </div>
  </div>
</div>


        <!-- Tabel -->
        <div class="table-responsive mt-4">
          <table class="table table-bordered table-hover">
            <thead class="table-light">
              <tr>
                <th>Nama Proyek</th>
                <th>Klient</th>
                <th>Lokasi</th>
                <th>Jenis Proyek</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($praProyeks as $item)
              <tr>
                <td>{{ $item->nama_proyek }}</td>
                <td>{{ $item->klient }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ ucfirst($item->jenis_proyek) }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}</td>
                <td>
                  <span class="badge bg-{{ $item->status === 'draft' ? 'warning' : ($item->status === 'berjalan' ? 'primary' : 'success') }}">
                    {{ ucfirst($item->status) }}
                  </span>
                </td>
                <td>
                  <!-- Edit -->
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">Edit</button>

                  <!-- Hapus -->
                  <form action="{{ route('pra-proyek.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                  </form>

                  <!-- Modal Edit -->
                  <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="{{ route('pra-proyek.update', $item->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Pra-Proyek</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <div class="mb-2">
                              <label class="form-label">Nama Proyek</label>
                              <input type="text" name="nama_proyek" class="form-control" value="{{ old('nama_proyek', $item->nama_proyek) }}" required>
                            </div>
                            <div class="mb-2">
                              <label class="form-label">Klient</label>
                              <input type="text" name="klient" class="form-control" value="{{ old('klient', $item->klient) }}" required>
                            </div>
                            <div class="mb-2">
                              <label class="form-label">Lokasi</label>
                              <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $item->lokasi) }}" required>
                            </div>
                            <div class="mb-2">
                              <label class="form-label">Jenis Proyek</label>
                              <select name="jenis_proyek" class="form-select" required>
                                <option value="master" {{ $item->jenis_proyek == 'master' ? 'selected' : '' }}>Master</option>
                                <option value="konsultasi" {{ $item->jenis_proyek == 'konsultasi' ? 'selected' : '' }}>Konsultasi</option>
                                <option value="pengembangan" {{ $item->jenis_proyek == 'pengembangan' ? 'selected' : '' }}>Pengembangan</option>
                              </select>
                            </div>
                            <div class="row">
                              <div class="col-md-6 mb-2">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $item->tanggal_mulai) }}" required>
                              </div>
                              <div class="col-md-6 mb-2">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $item->tanggal_selesai) }}" required>
                              </div>
                            </div>
                            <div class="mb-2">
                              <label class="form-label">Status</label>
                              <select name="status" class="form-select" required>
                                <option value="draft" {{ $item->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="berjalan" {{ $item->status == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                                <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <!-- Paginasi -->
          <div class="mt-3">
            {{ $praProyeks->links() }}
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('btnAturSyarat').addEventListener('click', function () {
    // Ambil nilai input dari modalTambah
    const namaProyek = document.querySelector('[name="nama_proyek"]').value;
    const klient = document.querySelector('[name="klient"]').value;
    const lokasi = document.querySelector('[name="lokasi"]').value;
    const jenis = document.querySelector('[name="jenis_proyek"]').value;
    const tanggalMulai = document.querySelector('[name="tanggal_mulai"]').value;
    const tanggalSelesai = document.querySelector('[name="tanggal_selesai"]').value;
    const status = document.querySelector('[name="status"]').value;

    // Isi konten di modalSyaratDokumen
    document.getElementById('syarat_nama_proyek').textContent = namaProyek;
    document.getElementById('syarat_klient').textContent = klient;
    document.getElementById('syarat_lokasi').textContent = lokasi;
    document.getElementById('syarat_jenis').textContent = jenis;
    document.getElementById('syarat_tanggal').textContent = `${tanggalMulai} s/d ${tanggalSelesai}`;
    document.getElementById('syarat_status').textContent = status;

    // Tutup modalTambah, lalu buka modalSyaratDokumen
    const modalTambah = bootstrap.Modal.getInstance(document.getElementById('modalTambah'));
    modalTambah.hide();

    setTimeout(() => {
      const modalSyarat = new bootstrap.Modal(document.getElementById('modalSyaratDokumen'));
      modalSyarat.show();
    }, 500);
  });
</script>

<script>
  document.getElementById('btnKembaliInfoProyek').addEventListener('click', function () {
    const modalSyarat = bootstrap.Modal.getInstance(document.getElementById('modalSyaratDokumen'));
    if (modalSyarat) modalSyarat.hide();

    setTimeout(() => {
      const modalTambah = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalTambah'));
      modalTambah.show();
    }, 500);
  });
</script>

<script>
  document.querySelectorAll('.doc-toggle').forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
      const sectionId = 'upload_' + this.id;
      const section = document.getElementById(sectionId);
      if (this.checked) {
        section.style.display = 'block';
      } else {
        section.style.display = 'none';
      }
    });
  });
</script>


</body>
</html>

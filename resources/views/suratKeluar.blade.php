<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Surat Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>

<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
        @include('layout.navbar')
    </div>

    <!-- Konten -->
    <div class="content">
        <div class="content-inner">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0"><strong>Daftar Surat Keluar</strong></h4>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBuatSurat">
                    + Buat Surat Baru
                </button>
            </div>
    <!-- Filter -->
            <form method="GET" action="{{ route('surat-keluar.index') }}">
    <div class="row g-2 mb-3 align-items-end">
        <div class="col-md-2">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status" id="status">
                <option value="">Semua Status</option>
                <option value="Terkirim" {{ request('status') == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                <option value="Menunggu Persetujuan" {{ request('status') == 'Menunggu Persetujuan' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
        </div>
        <div class="col-md-2">
            <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
            <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
        </div>
        <div class="col-md-2">
            <label for="jenis_surat" class="form-label">Jenis Surat</label>
            <select class="form-select" name="jenis_surat" id="jenis_surat">
                <option value="">Semua Jenis</option>
                <option value="Surat Permohonan" {{ request('jenis_surat') == 'Surat Permohonan' ? 'selected' : '' }}>Surat Permohonan</option>
                <option value="Surat Pemberitahuan" {{ request('jenis_surat') == 'Surat Pemberitahuan' ? 'selected' : '' }}>Surat Pemberitahuan</option>
                <option value="Surat Undangan" {{ request('jenis_surat') == 'Surat Undangan' ? 'selected' : '' }}>Surat Undangan</option>
                <option value="Surat Keterangan" {{ request('jenis_surat') == 'Surat Keterangan' ? 'selected' : '' }}>Surat Keterangan</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="search" class="form-label">Pencarian</label>
            <input type="text" class="form-control" name="search" id="search" placeholder="Cari nomor surat, tujuan, ..." value="{{ request('search') }}">
        </div>
        <div class="col-md-1 d-grid">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>

            <!-- Tabel Surat -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Jenis Surat</th>
                                    <th>Perihal</th>
                                    <th>Tujuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($suratKeluar as $surat)
                                    @php
                                        $statusLower = strtolower($surat->status);
                                        $badgeColor = match($statusLower) {
                                            'terkirim' => 'bg-info',
                                            'menunggu persetujuan' => 'bg-warning text-dark',
                                            'draft' => 'bg-secondary',
                                            'disetujui' => 'bg-success',
                                            'ditolak' => 'bg-danger',
                                            default => 'bg-light text-dark',
                                        };
                                    @endphp
                                    <tr>
                                        <td>{{ $surat->nomor_surat }}</td>
                                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $surat->jenis_surat }}</td>
                                        <td>{{ $surat->perihal }}</td>
                                        <td>{{ $surat->tujuan }}</td>
                                        <td>
                                            <span class="badge {{ $badgeColor }} badge-custom">{{ $surat->status }}</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetailSurat{{ $surat->id }}">
                                                Lihat
                                            </button>

                                            @if(in_array($statusLower, ['menunggu persetujuan', 'draft', 'ditolak']))
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditSurat{{ $surat->id }}">
                                             Edit
                                            </button>
                                            @else
                                            <a class="btn btn-sm btn-purple" href="{{ route('surat-keluar.preview', $surat->id) }}" target="_blank">Cetak</a>

                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data surat keluar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-end">
                        {{ $suratKeluar->links() }}
                    </div>
                </div>
            </div>

            <!-- Modal Detail Surat -->
            @foreach($suratKeluar as $surat)
                <div class="modal fade" id="modalDetailSurat{{ $surat->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Surat: {{ $surat->nomor_surat }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <dl class="row">
                                    <dt class="col-sm-4">Tanggal Surat</dt>
                                    <dd class="col-sm-8">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</dd>
                                    <dt class="col-sm-4">Jenis Surat</dt>
                                    <dd class="col-sm-8">{{ $surat->jenis_surat }}</dd>
                                    <dt class="col-sm-4">Perihal</dt>
                                    <dd class="col-sm-8">{{ $surat->perihal }}</dd>
                                    <dt class="col-sm-4">Tujuan</dt>
                                    <dd class="col-sm-8">{{ $surat->tujuan }}</dd>
                                    <dt class="col-sm-4">Isi Surat</dt>
                                    <dd class="col-sm-8"><div style="white-space: pre-line;">{{ $surat->isi_surat }}</div></dd>
                                </dl>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

<!-- Modal Buat Surat -->
<<!-- Modal: Form Pembuatan Surat Keluar -->
<div class="modal fade" id="modalBuatSurat" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('surat-keluar.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Formulir Pembuatan Surat Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <!-- Informasi Dasar Surat -->
                    <h6 class="mb-3">Informasi Dasar Surat</h6>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="jenis_surat" class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                            <select name="jenis_surat" id="jenis_surat" class="form-select" required>
                                <option value="">-- Pilih Jenis Surat --</option>
                                <option value="Surat Permohonan">Surat Permohonan</option>
                                <option value="Surat Pemberitahuan">Surat Pemberitahuan</option>
                                <option value="Surat Undangan">Surat Undangan</option>
                                <option value="Surat Keterangan">Surat Keterangan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_surat" class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_surat" id="tanggal_surat" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="perihal" class="form-label">Perihal <span class="text-danger">*</span></label>
                            <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukkan perihal surat" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nomor_surat" class="form-label">Nomor Surat</label>
                            <input type="text" name="nomor_surat" id="nomor_surat" class="form-control" placeholder="Diisi manual oleh pengguna">
                        </div>
                    </div>

                    <!-- Informasi Tujuan -->
                    <h6 class="mb-3">Informasi Tujuan</h6>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="jenis_alamat" class="form-label">Jenis Alamat</label>
                            <select name="jenis_alamat" id="jenis_alamat" class="form-select">
                                <option value="">Pilih dari Master Data</option>
                                <option value="Instansi">Instansi</option>
                                <option value="Perusahaan">Perusahaan</option>
                                <option value="Pribadi">Pribadi</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tujuan" class="form-label">Tujuan Surat <span class="text-danger">*</span></label>
                            <select name="tujuan" id="tujuan" class="form-select" required>
                                <option value="">-- Pilih Tujuan Surat --</option>
                                <option value="PT Maju Jaya">PT Maju Jaya</option>
                                <option value="Kepolisian Sektor Kota">Kepolisian Sektor Kota</option>
                            </select>
                        </div>
                    </div>

                    <!-- Isi Surat -->
                    <div class="mb-3">
                        <label for="isi_surat" class="form-label">Isi Surat</label>
                        <textarea name="isi_surat" id="isi_surat" class="form-control" rows="6" placeholder="Tulis isi surat disini..."></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Surat</button>
                </div>
            </form>
        </div>
    </div>
</div>




@foreach($suratKeluar as $surat)
    {{-- Modal Edit --}}
    <div class="modal fade" id="modalEditSurat{{ $surat->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('surat-keluar.update', $surat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Surat: {{ $surat->nomor_surat }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
                    <div class="mb-3">
                        <label for="nomor_surat_{{ $surat->id }}" class="form-label">Nomor Surat</label>
                        <input type="text" name="nomor_surat" id="nomor_surat_{{ $surat->id }}" class="form-control" value="{{ $surat->nomor_surat }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_surat_{{ $surat->id }}" class="form-label">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" id="tanggal_surat_{{ $surat->id }}" class="form-control" value="{{ $surat->tanggal_surat }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_surat_{{ $surat->id }}" class="form-label">Jenis Surat</label>
                        <select name="jenis_surat" id="jenis_surat_{{ $surat->id }}" class="form-select" required>
                            <option value="">Pilih Jenis</option>
                            <option value="Pengantar" {{ $surat->jenis_surat == 'Pengantar' ? 'selected' : '' }}>Pengantar</option>
                            <option value="Pemberitahuan" {{ $surat->jenis_surat == 'Pemberitahuan' ? 'selected' : '' }}>Pemberitahuan</option>
                            <option value="Undangan" {{ $surat->jenis_surat == 'Undangan' ? 'selected' : '' }}>Undangan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="perihal_{{ $surat->id }}" class="form-label">Perihal</label>
                        <input type="text" name="perihal" id="perihal_{{ $surat->id }}" class="form-control" value="{{ $surat->perihal }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tujuan_{{ $surat->id }}" class="form-label">Tujuan</label>
                        <input type="text" name="tujuan" id="tujuan_{{ $surat->id }}" class="form-control" value="{{ $surat->tujuan }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="isi_surat_{{ $surat->id }}" class="form-label">Isi Surat</label>
                        <textarea name="isi_surat" id="isi_surat_{{ $surat->id }}" class="form-control" rows="6" required>{{ $surat->isi_surat }}</textarea>
                    </div>
                    <div class="col-md-6">
                         <label for="status" class="form-label">Status</label>
                         <select name="status" id="status" class="form-select">
                         <option value="Draft" selected>Draft</option>
                         <option value="Dikirim">Dikirim</option>
                         <option value="Disetujui">Disetujui</option>
                         <option value="Ditolak">Ditolak</option>
                         </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

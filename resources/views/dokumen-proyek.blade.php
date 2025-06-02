<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Master Dokumen Proyek</title>
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

@php
  use Illuminate\Support\Facades\Storage;
@endphp

<div class="wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    @include('layout.navbar')
  </div>

  <!-- Konten utama -->
  <div class="content">
    <div class="content-inner">

      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold m-0">Master Dokumen Proyek</h5>
        <div class="d-flex align-items-center">
        </div>
      </div>

      <hr class="mb-4 mt-2">

      <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-body-tertiary p-2 rounded">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dokumen Proyek</li>
        </ol>
      </nav>

      <div class="card shadow-sm mb-5">
        <div class="card-body">
          <h4 class="card-title text-center mb-4">
            {{ isset($dokumen) ? 'Edit Dokumen Proyek' : 'Form Master Dokumen Proyek' }}
          </h4>

          <form action="{{ isset($dokumen) ? route('dokumen-proyek.update', $dokumen->id_dokumen) : route('dokumen-proyek.store') }}" 
                method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($dokumen))
              @method('PUT')
            @endif

            {{-- ID Dokumen --}}
            <div class="mb-3">
              <label for="id_dokumen" class="form-label">ID Dokumen</label>
              <input type="text" class="form-control" name="id_dokumen"
                     value="{{ old('id_dokumen', $dokumen->id_dokumen ?? '') }}"
                     {{ isset($dokumen) ? 'readonly' : '' }}
                     required placeholder="Contoh: DOC-001">
              @error('id_dokumen')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            {{-- Jenis Surat --}}
            <div class="mb-3">
              <label for="jenis_surat_id" class="form-label">Jenis Surat</label>
              <select class="form-select" name="jenis_surat_id" required>
                <option disabled {{ !isset($dokumen) ? 'selected' : '' }}>-- Pilih Jenis Surat --</option>
                @foreach($jenisSurat as $jenis)
                  <option value="{{ $jenis->id }}" {{ (old('jenis_surat_id', $dokumen->jenis_surat_id ?? '') == $jenis->id) ? 'selected' : '' }}>
                    {{ $jenis->nama_jenis_surat }}
                  </option>
                @endforeach
              </select>
              @error('jenis_surat_id')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>
            {{-- Template Dokumen --}}
            <div class="mb-3">
              <label for="template_dokumen" class="form-label">Template Dokumen</label>
              <input type="file" class="form-control" name="template_dokumen">
              @if(isset($dokumen) && $dokumen->template_dokumen)
                <small class="text-muted">
                  File saat ini: 
                  <a href="{{ Storage::url(path: $dokumen->template_dokumen) }}" target="_blank">
                    {{ basename($dokumen->template_dokumen) }}
                  </a>
                </small>
              @endif
              @error('template_dokumen')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

            {{-- Approval --}}
            <div class="mb-4">
              <label for="approval" class="form-label">Persyaratan Approval</label>
              <input type="text" class="form-control" name="approval"
                     value="{{ old('approval', $dokumen->approval ?? '') }}"
                     placeholder="Contoh: Manajer Proyek, Direktur">
              @error('approval')
                <div class="text-danger small">{{ $message }}</div>
              @enderror
            </div>

              <div class="mb-3">
              <label for="proyeks_id" class="form-label">Nama Proyek</label>
              <select class="form-select" name="proyeks_id" required>
                <option disabled >-- Pilih Id Proyeks --</option>
                @foreach($id_proyeks as $proyeks)
                  <option value="{{ $proyeks->id }}">
                    {{ $proyeks->nama_proyek }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="d-flex flex-wrap gap-2">
              <button type="submit" class="btn btn-success">
                {{ isset($dokumen) ? 'Update' : 'Simpan' }}
              </button>
              <a href="{{ route('dokumen-proyek.index') }}" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-3">Data Dokumen Proyek</h5>
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-light">
                <tr>
                  <th>ID Dokumen</th>
                  <th>Jenis Dokumen</th>
                  <th>Nama File</th>
                  <th>Persyaratan Approval</th>
                  <th class="text-center" style="width: 80px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($data as $item)
                  <tr>
                    <td>{{ $item->id_dokumen }}</td>
                    <td>{{ $item->jenisSurat->nama_jenis_surat ?? '-' }}</td>
                    <td>
                      @if($item->nama_file)
                        <a href="{{ asset('templates/' . $item->nama_file) }}" target="_blank">
                          {{ basename($item->nama_file) }}
                        </a>
                      @else
                        <em>Tidak ada file</em>
                      @endif
                    </td>
                    <td>{{ $item->approval }}</td>
                    <td class="text-center d-flex gap-1 justify-content-center">
                      <a href="{{ asset('storage/' . $item->template_dokumen) }}" target="_blank">  
                      <form action="{{ route('dokumen-proyek.destroy', $item->id_dokumen) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
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

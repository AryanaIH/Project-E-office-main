@extends('layout.app') {{-- Ganti dengan layout yang kamu pakai --}}

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><strong>Formulir Pembuatan Surat Keluar</strong></h4>
        <a href="{{ route('surat-keluar.index') }}" class="text-decoration-none">← Kembali ke Daftar Surat</a>
    </div>

    <form action="{{ route('surat-keluar.store') }}" method="POST">
        @csrf

        {{-- Informasi Dasar Surat --}}
        <div class="row mb-3">
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
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="perihal" class="form-label">Perihal <span class="text-danger">*</span></label>
                <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Masukkan perihal surat" required>
            </div>
            <div class="col-md-6">
                <label for="nomor_surat" class="form-label">Nomor Surat</label>
                <input type="text" class="form-control" placeholder="Akan dibuat otomatis setelah disetujui" disabled>
                <small class="text-muted">Nomor surat akan diberikan setelah surat disetujui</small>
            </div>
        </div>

        {{-- Informasi Tujuan --}}
        <h5 class="mt-4">Informasi Tujuan</h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Jenis Alamat</label>
                <select class="form-select">
                    <option value="">Pilih dari Master Data</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="tujuan" class="form-label">Tujuan Surat <span class="text-danger">*</span></label>
                <select name="tujuan" id="tujuan" class="form-select" required>
                    <option value="">-- Pilih Tujuan Surat --</option>
                    <option value="PT Maju Jaya">PT Maju Jaya</option>
                    <option value="PT Abadi Sentosa">PT Abadi Sentosa</option>
                    <option value="Dinas Pekerjaan Umum">Dinas Pekerjaan Umum</option>
                    <option value="Kepolisian Sektor Kota">Kepolisian Sektor Kota</option>
                    <option value="Semua Mitra">Semua Mitra</option>
                </select>
            </div>
        </div>

        {{-- Isi Surat --}}
        <div class="mb-3">
            <label for="isi" class="form-label">Isi Surat</label>
            <textarea name="isi" id="isi" class="form-control" rows="7" placeholder="Tulis isi surat disini..." required></textarea>
        </div>

        {{-- Tombol --}}
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Simpan Surat</button>
        </div>
    </form>
</div>
@endsection

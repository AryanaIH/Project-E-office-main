<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keluar - {{ $surat->nomor_surat }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 30px;
        }

        h2, h3 {
            text-align: center;
            margin: 0;
        }

        .info-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px;
            vertical-align: top;
        }

        .isi-surat {
            margin-top: 30px;
            white-space: pre-line;
            text-align: justify;
        }

        .ttd {
            margin-top: 50px;
            text-align: right;
        }

        .line {
            border-bottom: 1px solid #000;
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <h2>KANTOR XYZ</h2>
    <h3>Surat Keluar</h3>
    <div class="line"></div>

    <table class="info-table">
        <tr>
            <td width="30%"><strong>Nomor Surat</strong></td>
            <td>: {{ $surat->nomor_surat }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Surat</strong></td>
            <td>: {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td><strong>Jenis Surat</strong></td>
            <td>: {{ $surat->jenis_surat }}</td>
        </tr>
        <tr>
            <td><strong>Perihal</strong></td>
            <td>: {{ $surat->perihal }}</td>
        </tr>
        <tr>
            <td><strong>Tujuan</strong></td>
            <td>: {{ $surat->tujuan }}</td>
        </tr>
        <tr>
            <td><strong>Status</strong></td>
            <td>: {{ ucfirst($surat->status) }}</td>
        </tr>
    </table>

    <div class="isi-surat">
        {!! nl2br(e($surat->isi)) !!}
    </div>

    <div class="ttd">
        <p>Hormat kami,</p>
        <br><br>
        <p><strong>Nama Pejabat</strong></p>
        <p>Jabatan</p>
    </div>

</body>
</html>

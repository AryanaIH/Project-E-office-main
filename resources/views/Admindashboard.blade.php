<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        @include('layout.navbar')
        <div class="flex-grow-1 p-3 m-2">
            <div class=" mx-auto my-5 row col-9" >
                <div>
                    <div class="col-md-12 text-center mt-3">
                        <h1 class="display-12">Selamat Datang, {{ Auth::user()->name }}!</h1>
                        <p class="lead">Di Dashboard {{ ucfirst(Auth::user()->level) }}</p>
                    </div>
                    <div class="info-box mt-5 ml-4">
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="hasil">
                                    <p style="border: 1px solid black; padding: 20px; margin-top:20px; border-radius: 10px;">
                                        <a href="{{ route('surat-keluar.index', ['status' => 'Draft']) }}" style="text-decoration: none; color: black;">
                                            <span style="font-size:24px; padding-top: 10px;">{{ $jumlahDraft }}</span>
                                        </a>
                                        <br>
                                        <span>Draft Surat</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="hasil">
                                    <p style="border: 1px solid black; padding: 20px; margin-top:20px; border-radius: 10px;">
                                    <a href="{{ route('surat-keluar.index', ['status' => 'Disetujui']) }}" style="text-decoration: none; color: black;">
                                    <span style="font-size:24px; padding-top: 10px;">{{ $jumlahDisetujui }}</span>
                                    </a>    
                                    <br>
                                    <span >Surat Disetujui</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="hasil">
                                    <p style="border: 1px solid black; padding: 20px; margin-top:20px; border-radius: 10px;">
                                    <a href="{{ route('surat-keluar.index', ['status' => 'Dikirim']) }}" style="text-decoration: none; color: black;">
                                    <span style="font-size:24px; padding-top: 10px;">{{ $jumlahTerkirim }}</span>
                                    </a>    
                                    <br>
                                    <span >Surat Terkirim</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="hasil">
                                    <p style="border: 1px solid black; padding: 20px; margin-top:20px; border-radius: 10px;">
                                    <a href="{{ route('pra-proyek.index', ['status_proyek' => 'baru']) }}" style="text-decoration: none; color: black;">
                                    <span style="font-size:24px; padding-top: 10px;">{{ $jumlahBaru }}</span>
                                    </a>    
                                    <br>
                                    <span >Proyek Baru </span>
                                    </div>
                                    </p>
                            </div>
                            <div class="col-md-4">
                                <div class="hasil">
                                    <p style="border: 1px solid black; padding: 20px; margin-top:20px; border-radius: 10px;">
                                    <a href="{{ route('pra-proyek.index', ['status_proyek' => 'berjalan']) }}" style="text-decoration: none; color: black;">
                                    <span style="font-size:24px; padding-top: 10px;">{{ $jumlahBerjalan }}</span>
                                    </a>    
                                    <br>
                                    <span >Proyek Berjalan </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4    ">
                                <div class="hasil">
                                    <p style="border: 1px solid black; padding: 20px; margin-top:20px; border-radius: 10px;">
                                    <a href="{{ route('pra-proyek.index', ['status_proyek' => 'selesai']) }}" style="text-decoration: none; color: black;">
                                    <span style="font-size:24px; padding-top: 10px;">{{ $jumlahSelesai }}</span>
                                    </a>    
                                    <br>
                                    <span >Proyek Selesai</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>

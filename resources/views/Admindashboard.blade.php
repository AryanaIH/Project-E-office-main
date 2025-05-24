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
                        <h1 class="display-12">Selamat Datang!</h1>
                        <p class="lead">Di Dashboard Admin</p>
                    </div>
                    <div class="info-box mt-5 ml-4">
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="hasil">
                                    <p style="border: 1px solid black; padding: 20px; margin-top:20px; border-radius: 10px;">
                                        <span style="font-size:24px; padding-top: 10px;"><?php ?></span> <br>
                                    <span >Draft Surat</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="hasil">
                                    <p style="border: 1px solid black; padding: 20px; margin-top:20px; border-radius: 10px;">
                                        <span style="font-size:24px; padding-top: 10px;"><?php ?></span> <br>
                                    <span >Surat Disetujui</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="hasil">
                                    <p style="border: 1px solid black; padding: 20px; margin-top:20px; border-radius: 10px;">
                                        <span style="font-size:24px; padding-top: 10px;"><?php  ?></span> <br>
                                    <span >Surat Terkirim</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="hasil">
                                    <p style="border: 1px solid black; padding: 20px; margin-top:20px; border-radius: 10px;">
                                        <span style="font-size:24px; padding-top: 10px;"><?php  ?></span> <br>
                                    <span >Proyek Baru </span>
                                    </div>
                                    </p>
                            </div>
                            <div class="col-md-4">
                                <div class="hasil">
                                    <p style="border: 1px solid black; padding: 20px; margin-top:20px; border-radius: 10px;">
                                        <span style="font-size:24px; padding-top: 10px;"><?php  ?></span> <br>
                                    <span >Proyek Berjalan </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4    ">
                                <div class="hasil">
                                    <p style="border: 1px solid black; padding: 20px; margin-top:20px; border-radius: 10px;">
                                        <span style="font-size:24px; padding-top: 10px;"><?php  ?></span> <br>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Gambar ke Cloudinary</title>
</head>
<body>
    <h1>Upload Gambar</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
        <img src="{{ session('image_url') }}" alt="Uploaded Image" width="300">
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="image">Pilih Gambar:</label><br>
        <input type="file" name="image" id="image" required><br><br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>

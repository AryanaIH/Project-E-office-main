<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ImageController extends Controller
{
    /**
     * Handle image upload and store Cloudinary info to database
     */
    public function upload(Request $request)
    {
        // Validasi input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload ke Cloudinary
        $uploadedFile = $request->file('image')->getRealPath();

        $uploaded = Cloudinary::upload($uploadedFile, [
            'folder' => 'laravel-uploads'
        ]);

        // Simpan ke database
        $image = Image::create([
            'url' => $uploaded->getSecurePath(),
            'public_id' => $uploaded->getPublicId(),
        ]);

        // Jika dari browser (form), redirect
        if (!$request->expectsJson()) {
            return redirect('/upload')->with([
                'success' => 'Upload berhasil!',
                'image_url' => $uploaded->getSecurePath()
            ]);
        }

        // Jika dari API (Postman, JS)
        return response()->json([
            'message' => 'Upload berhasil!',
            'data' => $image
        ]);
    }
}

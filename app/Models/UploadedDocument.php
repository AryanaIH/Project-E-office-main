<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadedDocument extends Model
{
    protected $fillable = [
        'user_id',
        'document_type',
        'file_name',
        'file_path',
    ];
}

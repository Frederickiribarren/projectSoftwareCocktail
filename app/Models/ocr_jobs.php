<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ocr_jobs extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'status',
        'original_image_path',
        'raw_result',
        'error_message',
    ];
}

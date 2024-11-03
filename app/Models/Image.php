<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        "file_name",
        "file_path",
        "file_type",
        "file_size",
        "upload_by",
        "delete_time"
    ];
    protected $primaryKey = 'Id';
    public $timestamps = false;
}

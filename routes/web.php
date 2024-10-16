<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\HandleUpdateImage;
use GuzzleHttp\Psr7\UploadedFile;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/uploadfile', [UploadController::class, 'index'])->name('upload_file');

Route::post('/upload-image', [UploadController::class, 'update'])->name('upload_images');

Route::get('/images', [UploadController::class, 'show'])->name('images.index');
Route::get('/download/{id}', [UploadController::class, 'download'])->name('images.download');

Route::get('/download',[UploadController::class, "index"])->name("index");
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\LoginController;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Support\Facades\Artisan;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UploadController::class, 'index'])->name('upload_file');
Route::get('/xoa', [UploadController::class, 'xoaxoa']);
Route::post('/upload-image', [UploadController::class, 'update'])->name('upload_images');

Route::get('/images', [UploadController::class, 'show'])->name('images.index');
Route::get('/download/{id}', [UploadController::class, 'download'])->name('images.download');

Route::get('/download',[UploadController::class, "index"])->name("index");

Route::get('/register',[LoginController::class, "index"])->name("register");
Route::post('/register', [LoginController::class, 'handlogin'])->name('handregister');
Route::get('/logout', [LoginController::class, 'handleLogout'])->name('handleLogout');

Route::get('/check-schedule', function () {
    Artisan::call('schedule:list');
    return Artisan::output();
});
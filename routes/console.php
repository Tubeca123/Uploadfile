<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use App\Console\Commands\DeleteFileCommand;

use Illuminate\Console\Scheduling\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('app:delete-file-command', function () {
    $controller = new DeleteFileCommand();
    $controller->handle();
})->describe('Oke');

app(Schedule::class)->command('app:delete-file-command')->everyMinute();
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Image;

class DeleteFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-file-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Oke';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredImages = Image::where('delete_time', '<=', now())->pluck('id');
        // dd($expiredImages ?? "không có gì");
        if ($expiredImages->isNotEmpty()) {
            Image::destroy($expiredImages);
            $this->info('Deleted images: ' . implode(', ', $expiredImages->toArray()));
        } else {
            $this->info('No expired images to delete.');
        }
        

    }
}

<?php

namespace App\Modules\Application\Commands;

use Throwable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Modules\Application\Models\UploadImage;

class ClearUploadImageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload-image:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Image to storage and database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info('Clearing Upload Images!');

        $this->storage = Storage::disk(config('upload-file.image.storage'));

        $this->clearEmptyFolder();

        $uploads = $this->getUploads();
        if(!$uploads->count()) {
            $this->warn(' No uploads to delete! ');
            $this->newLine();

            return Command::SUCCESS;
        }

        $result = $this->processUploads($uploads);
        if($result['success']) {
            $this->info($result['message']);
        } else {
            $this->error($result['message']);
        }
        $this->newLine();

        return $result['code'];
    }

    /**
     * Get Uploads to process
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getUploads(): Collection
    {
        $uploads = UploadImage::where('days_active', '!=', -999)->get();

        return $uploads->filter(fn($upload) => !$upload->isActive);
    }

    /**
     * Process Uploads
     *
     * @param \Illuminate\Database\Eloquent\Collection $uploads
     * @return array
     */
    private function processUploads(Collection $uploads): array
    {
        try {
            $this->withProgressBar($uploads, fn(UploadImage $upload) => $this->removeUpload($upload));

            $this->newLine();
            
            return [
                'success' => true,
                'message' => ' Uploads deleted with successfully. ',
                'code' => Command::SUCCESS,
            ];
        } catch(Throwable $e) {
            return [
                'success' => false,
                'message' => " Error on delete Uploads: [{$e->getMessage()}]! ",
                'code' => Command::FAILURE,
            ];
        }
    }

    /**
     * Remove Upload to database and storage folder
     *
     * @param \App\Modules\Application\Models\UploadImage $upload
     * @return void
     */
    private function removeUpload(UploadImage $upload): void
    {
        if($this->storage->has($upload->path)) {
            $this->storage->delete($upload->path);
        }

        $upload->delete();
    }

    /**
     * Clear emptys folders
     *
     * @return void
     */
    private function clearEmptyFolder(): void
    {
        $directories = $this->storage->directories('images');

        foreach ($directories as $dir) {
            if($this->storage->allFiles($dir)) {
                continue;
            }

            $this->storage->deleteDirectory($dir);
        }
    }
}
<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SaveImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $imageSize;
    protected string $size;

    /**
     * Create a new job instance.
     *
     * @param string $imageSize
     * @param string $size
     * @return void
     */
    public function __construct(string $imageSize, string $size)
    {
        $this->imageSize = $imageSize;
        $this->size = $size;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $parsedUrl = parse_url($this->imageSize, PHP_URL_PATH);
            if (!$parsedUrl) {
                throw new Exception("Invalid URL: $this->imageSize");
            }

            $pathInfo = pathinfo($parsedUrl);

            $contents = file_get_contents($this->imageSize);
            if ($contents === false) {
                throw new Exception("Could not fetch image from URL: $this->imageSize");
            }

            $path = 'images/' .  $pathInfo['filename'] . '/' . $this->size . '.' . $pathInfo['extension'];

            $success = Storage::disk('public')->put($path, $contents);
            if (!$success) {
                throw new Exception("Could not save image to disk: $path");
            }
        } catch (\Exception $e) {
            Log::error('Error saving image asynchronously: ' . $e->getMessage());
        }
    }
}

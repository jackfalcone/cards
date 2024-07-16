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

    public string $imageUrl;
    public string $size;

    /**
     * Create a new job instance.
     *
     * @param string $imageUrl
     * @param string $size
     */
    public function __construct(string $imageUrl, string $size)
    {
        $this->imageUrl = $imageUrl;
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
            $parsedUrl = parse_url($this->imageUrl, PHP_URL_PATH);
            if (!$parsedUrl) {
                throw new Exception("Invalid URL: $this->imageUrl");
            }

            $pathInfo = pathinfo($parsedUrl);

            $contents = file_get_contents($this->imageUrl);
            if ($contents === false) {
                throw new Exception("Could not fetch image from URL: $this->imageUrl");
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

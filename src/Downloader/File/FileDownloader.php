<?php

namespace App\Downloader\File;


class FileDownloader
{
    public function download(string $file): string {
        return file_get_contents($file);
    }
}
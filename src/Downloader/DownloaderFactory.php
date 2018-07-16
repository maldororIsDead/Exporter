<?php

namespace App\Downloader;

use App\Downloader\File\FileDownloader;
use App\Downloader\URL\URLDownloader;
use GuzzleHttp\Client;

class DownloaderFactory
{
    public static function createDownloader(string $source)
    {
        if (filter_var($source, FILTER_VALIDATE_URL)) {
            return new URLDownloader(new Client);
        }

        if (file_exists($source)) {
            return new FileDownloader;
        }

        throw new \Exception("Invalid source");
    }
}
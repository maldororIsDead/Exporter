<?php

namespace App\Downloader;

use App\Downloader\File\FileDownloader;
use App\Downloader\Url\UrlDownloader;
use GuzzleHttp\Client;

class DownloaderFactory
{
    public static function createDownloader(string $source)
    {
        if (filter_var($source, FILTER_VALIDATE_URL)) {
            return new UrlDownloader(new Client);
        }

        if (file_exists($source)) {
            return new FileDownloader;
        }

        throw new \Exception("Invalid source");
    }
}
<?php

namespace App\Downloader;

class Downloader
{
    public static function download(string $type): string
    {
        $downloader = DownloaderFactory::createDownloader($type);

        return $downloader->download($type);
    }
}
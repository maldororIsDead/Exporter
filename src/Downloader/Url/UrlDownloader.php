<?php

namespace App\Downloader\Url;

use Generator;
use GuzzleHttp\ClientInterface;

class UrlDownloader
{
    /** @var ClientInterface */
    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function download(string $url): string
    {
        return $this->client->get($url)->getBody();
    }
}
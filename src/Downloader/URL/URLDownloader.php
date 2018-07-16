<?php

namespace App\Downloader\URL;

use Generator;
use GuzzleHttp\ClientInterface;

class URLDownloader
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
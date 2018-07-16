<?php

namespace Tests\Unit\Downloader;

use App\Downloader\URL\URLDownloader;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Mockery;
use PHPUnit\Framework\TestCase;

class URLDownloaderTest extends TestCase
{
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /** @test */
    public function download()
    {
        $content = '1';

        $client = $this->getClient($content);

        $downloader = new URLDownloader($client);

        $actualContents = $downloader->download("/");

        $this->assertEquals($content, $actualContents);
    }

    public function getClient(string $content)
    {
        $handler = new MockHandler(new Response(200, [], $content));

        return new Client($handler);
    }
}
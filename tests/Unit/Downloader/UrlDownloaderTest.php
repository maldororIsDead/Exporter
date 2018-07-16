<?php

namespace Tests\Unit\Downloader;

use App\Downloader\Url\URLDownloader;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Mockery;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;

class UrlDownloaderTest extends TestCase
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
        $mock = new MockHandler([new Response(200, [], $content)]);
        $handler = HandlerStack::create($mock);

        return new Client(['handler' => $handler]);
    }
}
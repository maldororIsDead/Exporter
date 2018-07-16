<?php

namespace Tests\Unit\Exporter;

use App\Exporter\Exporter;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;
use PHPUnit\Framework\TestCase;

class JsonExporterTest extends TestCase
{
    private function clean()
    {
        if (file_exists(dirname(__FILE__, 4) . '\test.json')) {
            unlink(dirname(__FILE__, 4) . '\test.json');
        }
    }

    public function setUp()
    {
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory(__FILE__, 4));
    }

    /** @test */
    public function it_returns_the_json_data()
    {
        $content = '<?xml version="1.0"?>' . "\n" . '<test><version>https://jsonfeed.org/version/1</version></test>' . "\n";

        $exporter = new Exporter();

        $this->assertFalse(vfsStreamWrapper::getRoot()->hasChild('test.json'));

        $exporter->export($content, 'json', 'test');

        $this->assertFileExists(dirname(__FILE__, 4) . DIRECTORY_SEPARATOR . 'test.json');

        $expected = "{\"version\":\"https://jsonfeed.org/version/1\"}";

        $this->assertEquals($expected, file_get_contents('test.json'));

        echo memory_get_peak_usage();
    }

    public function tearDown()
    {
        $this->clean();
    }
}
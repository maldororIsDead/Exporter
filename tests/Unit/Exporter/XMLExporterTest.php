<?php

namespace Tests\Unit\Exporter;

use App\Exporter\Exporter;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;
use PHPUnit\Framework\TestCase;

class XMLExporterTest extends Testcase
{
    private function clean()
    {
        if (file_exists(dirname(__FILE__, 4) . '\test.xml')) {
            unlink(dirname(__FILE__, 4) . '\test.xml');
        }
    }

    public function setUp()
    {
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory(__FILE__, 4));
    }

    /** @test */
    public function it_returns_the_xml_data()
    {
        $content = array(
            'version' => 'https://jsonfeed.org/version/1'
        );

        $content = json_encode($content);

        $exporter = new Exporter();

        $this->assertFalse(vfsStreamWrapper::getRoot()->hasChild('test.xml'));

        $exporter->export($content, 'xml', 'test');

        $this->assertFileExists(dirname(__FILE__, 4) . DIRECTORY_SEPARATOR . 'test.xml');

        $expected = '<?xml version="1.0"?>' . "\n" . '<test><version>https://jsonfeed.org/version/1</version></test>' . "\n";

        $this->assertEquals($expected, file_get_contents('test.xml'));
    }

    public function tearDown()
    {
        $this->clean();
    }
}
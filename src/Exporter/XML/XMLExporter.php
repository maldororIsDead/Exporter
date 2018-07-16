<?php

namespace App\Exporter\XML;

use App\Exporter\Exportable;
use Mockery\Exception;
use SimpleXMLElement;


class XMLExporter implements Exportable
{
    const JSON_VERSION = 'https://jsonfeed.org/version/1';

    public function export(array $data, string $rootElement): void
    {
        $this->checkJSONVersion($data);
        $xmlData = new SimpleXMLElement("<?xml version=\"1.0\"?><{$rootElement}></{$rootElement}>");
        $this->arrayToXml($data, $xmlData);
        $this->generateXMLFile($xmlData, $rootElement);
    }

    protected function arrayToXml(array $data, SimpleXMLElement &$xmlData): void
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $subNode = $xmlData->addChild($this->replaceIntToString($key));
                $this->arrayToXml($value, $subNode);
            } else {
                $xmlData->addChild($this->replaceIntToString($key), htmlspecialchars($value));
            }
        }
    }

    private function replaceIntToString($key): string
    {
         return is_integer($key) ? "item" : $key;
    }

    private function generateXMLFile(SimpleXMLElement $xmlData, string $fileName): void
    {
        $xmlFile = $xmlData->asXML("{$fileName}.xml");

        if (!$xmlFile) {
            throw new Exception('XML file generation error.');
        }
    }

    private function checkJSONVersion(array $data): void
    {
        if ($data['version'] !== XMLExporter::JSON_VERSION) {
            throw new Exception('Incorrect JSON encode version');
        }
    }
}
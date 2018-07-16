<?php

namespace App\Exporter;


class Exporter
{
    public function export(string $content, string $type, string $fileName)
    {
        $data = $this->identifyContentType($content);
        $exporter = ExporterFactory::createExporter($type);

        return $exporter->export($data, $fileName);
    }

    public function identifyContentType(string $content): array
    {
        if ($this->isJSON($content)) {
            return json_decode($content, true);
        }

        if ($this->isXML($content)) {
            $xmlContent = simplexml_load_string($content, "SimpleXMLElement", LIBXML_NOCDATA);
            $jsonContent = json_encode($xmlContent);
            $content = json_decode($jsonContent, TRUE);

            return $content;
        }

        throw new \Exception("This contect has an invalid type");
    }

    public function isJson(string $content): string
    {
        json_decode($content, true);

        return (json_last_error() == JSON_ERROR_NONE) ? $content : false;
    }

    protected function isXML(string $content): string
    {
        libxml_use_internal_errors(true);

        return simplexml_load_string($content) ? $content : false;
    }
}
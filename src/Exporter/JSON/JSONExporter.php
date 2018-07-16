<?php

namespace App\Exporter\JSON;


class JSONExporter
{
    public function export(array $data, string $rootElement)
    {
        $data['items'] = $data['items']['item'];
        $json = json_encode($data, JSON_UNESCAPED_SLASHES);
        $this->generateJSONFile($json, $rootElement);
    }

    private function generateJSONFile(string $jsonData, string $fileName): void
    {
        file_put_contents("$fileName.json", $jsonData);

        if (!file_exists("$fileName.json")) {
            throw new \Exception('JSON file generation error.');
        }
    }
}
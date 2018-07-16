<?php

namespace App\Exporter;
use App\Exporter\XmlExporter;

class ExporterFactory
{
    public static function createExporter(string $type): Exportable
    {
        $exporter =  "App\\Exporter\\" . ucfirst(strtolower($type)) . "\\" . ucfirst(strtolower($type)) . 'Exporter';

        if (class_exists( $exporter)) {
            return new $exporter;
        }

        throw new \Exception("This class isn`t exist");
    }
}
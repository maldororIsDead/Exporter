<?php

namespace App\Exporter;
use App\Exporter\XMLExporter;

class ExporterFactory
{
    public static function createExporter(string $type): Exportable
    {
        $exporter =  "App\\Exporter\\" . strtoupper($type) . "\\" .strtoupper($type) . 'Exporter';

        if (class_exists( $exporter)) {
            return new $exporter;
        }

        throw new \Exception("This class isn`t exist");
    }
}
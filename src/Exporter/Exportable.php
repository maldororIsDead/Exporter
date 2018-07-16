<?php

namespace App\Exporter;


interface Exportable
{
    public function export(array $data, string $rootElement): void;
}
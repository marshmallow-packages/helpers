<?php

namespace Marshmallow\HelperFunctions;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CsvHelper
{
    protected $headers = [];

    protected $data = [];

    protected $callback = null;

    protected $file_name = null;

    protected $delimiter = ',';

    public function headers(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    public function data($data, $callback = null): self
    {
        $data = $this->makeDataArray($data);
        $this->data = $data;
        $this->callback = $callback;

        return $this;
    }

    public function delimiter($delimiter): self
    {
        $this->delimiter = $delimiter;
        return $this;
    }

    public function store(string $path = null): string
    {
        $path = $path ?? storage_path();

        $path = Str::of($path);
        if (!$path->endsWith('/')) {
            $path = $path->append('/');
        }

        $path = $path->append($this->getFilename());

        $file = fopen($path, 'w');

        $callback = $this->callback;

        if (!empty($this->headers)) {
            fputcsv($file, $this->headers);
        }

        foreach ($this->data as $row) {
            if ($callback) {
                $row = $callback($row);
            }
            fputcsv($file, $row, $this->delimiter);
        }

        fclose($file);

        return $path;
    }

    public function storeAndDownload(string $path = null): BinaryFileResponse
    {
        $location = $this->store($path);
        return response()->download($location);
    }

    public function download(): StreamedResponse
    {
        return $this->stream();
    }

    public function stream(): StreamedResponse
    {
        $headers = $this->headers;
        $data = $this->data;
        $row_callback = $this->callback;

        $callback = function () use ($data, $headers, $row_callback) {
            $file = fopen('php://output', 'w');
            if (!empty($headers)) {
                fputcsv($file, $headers);
            }

            foreach ($data as $row) {
                if ($row_callback) {
                    $row = $row_callback($row);
                }
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $this->getHeaders());
    }

    public function setFilename(string $file_name): self
    {
        $this->file_name = $file_name;
        return $this;
    }

    protected function getHeaders()
    {
        return [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename={$this->getFilename()}",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];
    }

    protected function getFilename(): string
    {
        if ($this->file_name) {
            $name = Str::of($this->file_name);
            if (!$name->endsWith('.csv')) {
                $name = $name->append('.csv');
            }

            return $name;
        }
        return time() . '.csv';
    }

    protected function makeDataArray($data)
    {
        if ($data instanceof \Illuminate\Database\Eloquent\Collection) {
            return $data->toArray();
        }

        if ($data instanceof \Illuminate\Support\Collection) {
            return $data->toArray();
        }

        return $data;
    }
}

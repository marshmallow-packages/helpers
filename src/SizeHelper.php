<?php

namespace Marshmallow\HelperFunctions;

use Exception;

class SizeHelper
{
    protected $to;

    protected $from = 'bytes';

    protected $value;

    protected $precision;

    protected $available_formules = [
        'bytes', 'Kb', 'Mb', 'Gb', 'Auto',
    ];

    public function __construct($value = null)
    {
        $this->value = $value;

        return $this;
    }

    public static function of($value = null)
    {
        return new self($value);
    }

    public function from($from)
    {
        $this->from = $from;

        return $this;
    }

    public function precision($precision)
    {
        $this->precision = $precision;

        return $this;
    }

    public function to($to)
    {
        if (! in_array($to, $this->available_formules)) {
            throw new Exception('We have no formule for "'. $to .'" yet.');
        }

        $this->to = $to;

        return $this;
    }

    protected function bytes()
    {
        if ($this->from == 'Kb') {
            return $this->value * 1024;
        } elseif ($this->from == 'Mb') {
            return $this->value * 1048576;
        } elseif ($this->from == 'Gb') {
            return $this->value * 1073741824;
        }

        return $this->value;
    }

    protected function getTo()
    {
        return $this->to;
    }

    public function convert($precision = 0)
    {
        if (strtolower($this->getTo()) === 'auto') {
            $size_extension = 'Gb';
            $value = $this->formules($this->bytes(), $size_extension, $precision);
            if ($value < 1) {
                $size_extension = 'Mb';
                $value = $this->formules($this->bytes(), $size_extension, $precision);
                if ($value < 1) {
                    $size_extension = 'Kb';
                    $value = $this->formules($this->bytes(), $size_extension, $precision);
                }
            }

            return $this->output(
                $value,
                $size_extension
            );
        }

        return $this->output(
            $this->formules($this->bytes(), $this->getTo(), $precision),
            $this->getTo()
        );
    }

    protected function output($value, $extention)
    {
        return $value . ' ' . $extention;
    }

    protected function formules($bytes, $to, $precision = 1)
    {
        $formulas = [
            'bytes' => number_format($bytes, $precision),
            'Kb' => number_format($bytes / 1024, $precision),
            'Mb' => number_format($bytes / 1048576, $precision),
            'Gb' => number_format($bytes / 1073741824, $precision),
        ];

        return isset($formulas[$to]) ? $formulas[$to] : 0;
    }
}

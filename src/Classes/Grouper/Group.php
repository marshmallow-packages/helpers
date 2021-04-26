<?php

namespace Marshmallow\HelperFunctions\Classes\Grouper;

use Illuminate\Support\Collection;

class Group extends Collection
{
    protected $name;

    protected $items = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function add($item)
    {
        $this->items[] = $item;
    }

    public function is($name)
    {
        return $this->name === $name;
    }
}

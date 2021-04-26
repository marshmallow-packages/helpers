<?php

namespace Marshmallow\HelperFunctions\Classes\Grouper;

use Marshmallow\HelperFunctions\Classes\Grouper\Group;

class Grouper
{
    protected $collection;
    protected $first_row;
    protected $second_row;

    protected $groups = [];
    protected $groups_created = 0;
    protected $current_group = null;
    protected $group_structure = [];
    protected $group_structure_names = [];
    protected $group_structure_key = 0;
    protected $group_size;
    protected $counter = 0;

    public function __construct($collection, $group_structure)
    {
        $this->collection = $collection;
        $this->createStructure($group_structure);
    }

    public function create()
    {
        $this->group_size = $this->group_structure[$this->group_structure_key];

        foreach ($this->collection as $item) {
            $this->addItem($item);
        }

        if ($this->lastGroupIsNotAddedYet()) {
            $this->storeCurrentGroup();
        }

        return $this;
    }

    public function getGroups()
    {
        return collect($this->groups);
    }

    protected function addItem($item)
    {
        if ($this->counter == 0) {
            $this->createNewGroup();
        }

        $this->current_group->add($item);
        $this->counter++;

        if ($this->groupIsFull()) {
            $this->resetCounters();
        }
    }

    protected function groupIsFull()
    {
        return $this->counter == $this->group_size;
    }

    protected function resetCounters()
    {
        $this->getNextGroupSize();
        $this->counter = 0;
    }

    protected function getNextGroupSize()
    {
        $this->group_structure_key++;
        if (array_key_exists($this->group_structure_key, $this->group_structure)) {
            $this->group_size = $this->group_structure[$this->group_structure_key];
        } else {
            $this->group_size = $this->group_structure[0];
            $this->group_structure_key = 0;
        }
    }

    protected function lastGroupIsNotAddedYet()
    {
        return count($this->groups) !== $this->groups_created;
    }

    protected function createNewGroup()
    {
        if ($this->current_group !== null) {
            $this->storeCurrentGroup();
        }
        $group_name = $this->group_structure_names[$this->group_structure_key];
        $this->current_group = new Group($group_name);
        $this->groups_created++;
    }

    protected function storeCurrentGroup()
    {
        $this->groups[] = $this->current_group;
    }

    protected function createStructure($structure)
    {
        foreach ($structure as $name => $size) {
            $this->group_structure[] = $size;
            $this->group_structure_names[] = $name;
        }
    }
}

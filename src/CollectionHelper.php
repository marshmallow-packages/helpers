<?php

namespace Marshmallow\HelperFunctions;

use Illuminate\Support\Collection;
use Marshmallow\HelperFunctions\Classes\Grouper\Grouper;

class CollectionHelper
{
    public function createGrouper($collection, $group_structure = [])
    {
        $grouper = new Grouper($collection, $group_structure);
        return $grouper->create()->getGroups();
    }
}

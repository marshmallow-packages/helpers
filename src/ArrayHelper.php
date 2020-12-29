<?php

namespace Marshmallow\HelperFunctions;

use Illuminate\Database\Eloquent\Builder;

class ArrayHelper
{
    public function allItemsAreMultipleOf($match, $items)
    {
        $matches_found = 0;
        if ($match === 0) {
            return false;
        }
        foreach ($items as $item) {
            if ($item === 0) {
                $matches_found++;
                continue;
            }
            $result = $item / $match;
            if (!is_int($result)) {
                return false;
            }
            $matches_found++;
        }
        return ($matches_found == count($items));
    }

    public function groupNumbers($numbers, $spacer = '-')
    {
        sort($numbers);
        $return = [];
        $groups = [];

        for($i = 0; $i < count($numbers); $i++) {
            if($i > 0 && ($numbers[$i - 1] == $numbers[$i] - 1)) {
                array_push($groups[count($groups) - 1], $numbers[$i]);
            } else {
                array_push($groups, array($numbers[$i]));
            }
        }

        foreach($groups as $group) {
            if(count($group) == 1) {
                $return[] = $group[0];
            } else {
                $return[] = $group[0] . $spacer . $group[count($group) - 1];
            }
        }

        return $return;
    }
    public function storeInFile(array $expression, string $file_location)
    {
        $export = var_export($expression, TRUE);
        $export = preg_replace("/^([ ]*)(.*)/m", '$1$1$2', $export);
        $array = preg_split("/\r\n|\n|\r/", $export);
        $array = preg_replace(["/\s*array\s\($/", "/\)(,)?$/", "/\s=>\s$/"], [NULL, ']$1', ' => ['], $array);
        $export = join(PHP_EOL, array_filter(["["] + $array));

        $file_contents = "<?php\n\nreturn " . $export . ";";

        file_put_contents($file_location, $file_contents);
    }
}

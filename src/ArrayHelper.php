<?php

namespace Marshmallow\HelperFunctions;

use Illuminate\Database\Eloquent\Builder;

class ArrayHelper
{
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

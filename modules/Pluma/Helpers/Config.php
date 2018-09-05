<?php
namespace Pluma\Helpers;

use StdClass;

/*
|--------------------------------------------------------------------------
| Array Helpers
|--------------------------------------------------------------------------
|
| Here are some functions to help in manipulating arrays.
|
*/
class Config
{
    public static function write($config, $filepath, $newValue)
    {
        $contents = config( $config );
        $contents = $this->toContent($contents, $newValue);
        file_put_contents($filepath, $contents);

        return $contents;
    }

    public function toContent($contents, $newValue)
    {
        $contents[] = $newValue;
        return $contents;
    }
}
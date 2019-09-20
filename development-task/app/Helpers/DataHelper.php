<?php

namespace App\Helpers;

/**
 * Class DataHelper.
 *
 * @package namespace App\Helpers;
 */
class DataHelper
{

    public static function filterArrayWithKeys(array $array, array $keys) : array
    {
        $filtered = array_filter(
            $array,
            function ($key) use ($keys) {
                return in_array($key, $keys);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $filtered;
    }
}

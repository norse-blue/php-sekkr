<?php
/**
 * Sekkr - A framework agnostic package for array manipulation.
 *
 * @author  Axel Pardemann <axel.pardemann@norse.blue
 * @link    https://github.com/NorseBlue/Sekkr
 * @license https://github.com/NorseBlue/Sekkr/blob/master/LICENSE.md
 */

use NorseBlue\Sekkr\Arr as SekkrArr;

if (! function_exists('sekkrarr')) {
    /**
     * Creates a new NorseBlue\Sekkr\Arr object with the given array.
     *
     * @param  array  $items
     *
     * @return NorseBlue\Sekkr\Arr
     */
    function sekkrarr(array $array)
    {
        return SekkrArr::make($array);
    }
}

<?php
/**
 * Sekkr - A framework agnostic package for array manipulation.
 *
 * @author  Axel Pardemann <axel.pardemann@norse.blue
 * @link    https://github.com/NorseBlue/Sekkr
 * @license https://github.com/NorseBlue/Sekkr/blob/master/LICENSE.md
 */

use NorseBlue\Sekkr\Arr;
use NorseBlue\Sekkr\ArrDot;

if (!function_exists('ext_arr')) {
    /**
     * Creates a new Arr or ArrDot object with the given items.
     *
     * @param  array $items
     *
     * @return Arr|ArrDot
     */
    function ext_arr(array $items = [], $with_dot_capability = false)
    {
        return ($with_dot_capability) ? ArrDot::make($items) : Arr::make($items);
    }
}

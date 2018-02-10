<?php
/**
 * Sekkr - A framework agnostic package for array manipulation.
 *
 * @author  Axel Pardemann <axel.pardemann@norse.blue
 * @link    https://github.com/NorseBlue/Sekkr
 * @license https://github.com/NorseBlue/Sekkr/blob/master/LICENSE.md
 */

namespace NorseBlue\Sekkr\Tests;

use NorseBlue\Sekkr\Arr;
use PHPUnit\Framework\TestCase;

class ArrEmptyTest extends TestCase
{
    /**
     * @test that the Arr object is empty.
     */
    public function arr_object_is_empty()
    {
        $arr = new Arr;

        $this->assertTrue($arr->isEmpty());
    }

    /**
     * @test that the Arr object is not empty.
     */
    public function arr_object_is_not_empty()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $this->assertFalse($arr->isEmpty());
    }

    /**
     * @test that all given items are empty.
     */
    public function all_items_are_empty()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $this->assertTrue($arr->isEmpty(['bar', 'qux']));
        $this->assertFalse($arr->isEmpty(['foo', 'baz']));
    }
}

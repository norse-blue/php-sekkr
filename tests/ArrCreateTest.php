<?php
/**
 * Sekkr
 * A package for array manipulation.
 *
 * @author  Axel Pardemann <axel.pardemann@norse.blue
 * @link    https://github.com/NorseBlue/Sekkr
 * @license https://github.com/NorseBlue/Sekkr/blob/master/LICENSE.md
 */

namespace NorseBlue\Sekkr\Tests;

use NorseBlue\Sekkr\Arr;
use PHPUnit\Framework\TestCase;

class ArrGetSetTest extends TestCase
{
    /**
     * @test that the Arr object is created with empty items.
     */
    public function arr_is_created_with_empty_items()
    {
        $arr = new Arr;

        $this->assertEquals([], $arr->all());
    }

    /**
     * @test that the Arr object is created with an array of simple keys.
     */
    public function arr_is_created_with_array_simple_keys()
    {
        $arr = new Arr(['foo' => 'bar']);

        $this->assertEquals(['foo' => 'bar'], $arr->all());
    }

    /**
     * @test that the Arr object is created with an array of composite keys.
     */
    public function arr_is_created_with_array_composite_keys()
    {
        $arr = new Arr(['foo.bar' => 'baz', 'qux.corge' => 'grault']);

        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ], $arr->all());
    }

    /**
     * @test that the Arr object is created with a multi-dimensional array with simple keys.
     */
    public function arr_is_created_with_multi_dimensional_array_simple_keys()
    {
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
        ]);

        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
        ], $arr->all());
    }

    /**
     * @test that the Arr object is created with the helper function.
     */
    public function arr_is_created_with_helper_function()
    {
        $arr = sekkrarr([
            'foo' => [
                'bar' => 'baz'
            ],
        ]);

        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
        ], $arr->all());
    }
}

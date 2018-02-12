<?php
/**
 * Sekkr - A framework agnostic package for array manipulation.
 *
 * @author  Axel Pardemann <axel.pardemann@norse.blue
 * @link    https://github.com/NorseBlue/Sekkr
 * @license https://github.com/NorseBlue/Sekkr/blob/master/LICENSE.md
 */

namespace NorseBlue\Sekkr\Tests;

use NorseBlue\Sekkr\ArrDot;
use PHPUnit\Framework\TestCase;

/**
 * Class ArrDotCreateTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrDotCreateTest extends TestCase
{
    /**
     * @test that the ArrDot object is created with empty items.
     */
    public function arr_is_created_with_empty_items()
    {
        $arr_dot = new ArrDot;

        $this->assertEquals([], $arr_dot->all());
    }

    /**
     * @test that the ArrDot object is created with an array of simple keys.
     */
    public function arr_is_created_with_array_simple_keys()
    {
        $arr_dot = new ArrDot(['foo' => 'bar']);

        $this->assertEquals(['foo' => 'bar'], $arr_dot->all());
    }

    /**
     * @test that the ArrDot object is created with an array of composite keys.
     */
    public function arr_is_created_with_array_composite_keys()
    {
        $arr_dot = new ArrDot(['foo.bar' => 'baz', 'qux.corge' => 'grault']);

        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ], $arr_dot->all());
    }

    /**
     * @test that the ArrDot object is created with a multi-dimensional array with simple keys.
     */
    public function arr_is_created_with_multi_dimensional_array_simple_keys()
    {
        $arr_dot = new ArrDot([
            'foo' => [
                'bar' => 'baz',
            ],
        ]);

        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
        ], $arr_dot->all());
    }

    /**
     * @test that an empty ArrDot object is created with the helper function.
     */
    public function empty_arr_is_created_with_helper_function()
    {
        $arr_dot = ext_arr([], true);

        $this->assertEquals([], $arr_dot->all());
    }

    /**
     * @test that the ArrDot object is created with the helper function.
     */
    public function arr_is_created_with_helper_function()
    {
        $arr_dot = ext_arr([
            'foo' => [
                'bar' => 'baz'
            ],
        ], true);

        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
        ], $arr_dot->all());
    }
}

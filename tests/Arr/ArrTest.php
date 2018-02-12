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

/**
 * Class ArrTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrTest extends TestCase
{
    /**
     * @test that an Arr is created with empty items.
     */
    public function arr_is_created_with_empty_items()
    {
        $arr = new Arr;

        $this->assertEquals([], $arr->all());
    }

    /**
     * @test that an Arr is created with an array.
     */
    public function arr_is_created_with_array()
    {
        $arr = new Arr(['foo' => 'bar', 'baz.qux' => 'corge']);

        $this->assertEquals(['foo' => 'bar', 'baz.qux' => 'corge'], $arr->all());
    }

    /**
     * @test that an Arr is created with a multi-dimensional array.
     */
    public function arr_is_created_with_multi_dimensional_array()
    {
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux.corge' => [
                'grault.garply' => 'waldo',
            ],
        ]);

        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux.corge' => [
                'grault.garply' => 'waldo',
            ],
        ], $arr->all());
    }

    /**
     * @test that an empty Arr is created with the helper function.
     */
    public function empty_arr_is_created_with_helper_function()
    {
        $arr = ext_arr();

        $this->assertEquals([], $arr->all());
    }

    /**
     * @test that the Arr object is created with the helper function.
     */
    public function arr_is_created_with_helper_function()
    {
        $arr = ext_arr(['foo' => 'bar', 'baz.qux' => 'corge']);

        $this->assertEquals(['foo' => 'bar', 'baz.qux' => 'corge'], $arr->all());
    }
}

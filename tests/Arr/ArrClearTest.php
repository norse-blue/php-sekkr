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
 * Class ArrClearTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrClearTest extends TestCase
{
    /**
     * @test that an Arr is cleared.
     */
    public function arr_is_cleared()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $arr->clear();

        $this->assertEquals([], $arr->all());
    }

    /**
     * @test that an Arr item is cleared.
     */
    public function arr_item_is_cleared()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $arr->clear('foo');

        $this->assertEquals([
            'foo' => [],
            'baz' => 'qux',
        ], $arr->all());
    }

    /**
     * @test that multiple Arr items are cleared.
     */
    public function arr_items_are_cleared()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
            'corge' => 'grault',
        ]);

        $arr->clear(['foo', 'baz']);

        $this->assertEquals([
            'foo' => [],
            'baz' => [],
            'corge' => 'grault',
        ], $arr->all());
    }

    /**
     * @test that an undefined Arr item is not set.
     */
    public function undefined_arr_item_is_not_set()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $arr->clear('corge');

        $this->assertEquals([
            'foo' => 'bar',
            'baz' => 'qux',
        ], $arr->all());
    }
}

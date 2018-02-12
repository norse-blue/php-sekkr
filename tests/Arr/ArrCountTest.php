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
use NorseBlue\Sekkr\Exceptions\ValueNotCountableException;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

/**
 * Class ArrCountTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrCountTest extends TestCase
{
    /**
     * @test that the count is zero when Arr is empty
     */
    public function count_zero_when_arr_is_empty()
    {
        $arr = new Arr;

        $this->assertEquals(0, $arr->count());
    }

    /**
     * @test that the count is the number of Arr items.
     */
    public function count_is_number_of_arr_items()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $this->assertEquals(2, $arr->count());
    }

    /**
     * @test that the count is zero for an empty Arr item.
     */
    public function count_is_zero_for_empty_arr_item()
    {
        $arr = new Arr([
            'foo' => [],
            'baz' => 'qux',
        ]);

        $this->assertEquals(0, $arr->count('foo'));
    }

    /**
     * @test that the count is the number of elements in Arr item.
     */
    public function count_is_number_of_elements_in_arr_item()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => [
                'qux' => 'corge',
                'grault' => 'garply',
            ],
            'waldo' => 'fred',
        ]);

        $this->assertEquals(2, $arr->count('baz'));
    }

    /**
     * @test that the count is the number of elements in each Arr item.
     */
    public function count_is_number_of_elements_in_each_arr_item()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => [
                'qux' => 'corge',
                'grault' => 'garply',
            ],
            'waldo' => 'fred',
        ]);

        $this->assertEquals([
            'foo' => 0,
            'baz' => 2,
            'waldo' => 0,
        ], $arr->count(['foo', 'baz', 'waldo']));
    }

    /**
     * @test that an undefined Arr item throws an exception.
     */
    public function undefined_arr_item_throws_exception()
    {
        $this->expectException(OutOfBoundsException::class);
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $arr->count('corge');
    }

    /**
     * @test that a not countable Arr item throws an exception.
     */
    public function not_countable_arr_item_throws_exception()
    {
        $this->expectException(ValueNotCountableException::class);
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $arr->count('foo', true);
    }
}

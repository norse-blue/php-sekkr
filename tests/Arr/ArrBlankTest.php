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
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

/**
 * Class ArrBlankTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrBlankTest extends TestCase
{
    /**
     * @test that an Arr is empty.
     */
    public function arr_is_empty()
    {
        $arr = new Arr;

        $this->assertTrue($arr->blank());
    }

    /**
     * @test that an Arr is not empty.
     */
    public function arr_object_is_not_empty()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $this->assertFalse($arr->blank());
    }

    /**
     * @test that an Arr item is empty.
     */
    public function arr_item_is_empty()
    {
        $arr = new Arr([
            'foo' => [],
            'bar' => [
                'baz' => 'qux',
            ],
        ]);

        $this->assertTrue($arr->blank('foo'));
    }

    /**
     * @test that an Arr item is not empty.
     */
    public function arr_item_is_not_empty()
    {
        $arr = new Arr([
            'foo' => [],
            'bar' => [
                'baz' => 'qux',
            ],
        ]);

        $this->assertFalse($arr->blank('bar'));
    }

    /**
     * @test that multiple Arr items are or not empty.
     */
    public function arr_items_are_or_not_empty()
    {
        $arr = new Arr([
            'foo' => [],
            'bar' => [
                'baz' => 'qux',
            ],
        ]);

        $this->assertEquals(['foo' => true, 'bar' => false], $arr->blank(['foo', 'bar']));
    }

    /**
     * @test that an undefined Arr item throws an exception.
     */
    public function undefined_arr_item_throws_exception()
    {
        $this->expectException(OutOfBoundsException::class);
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
        ]);

        $arr->blank('qux');
    }
}

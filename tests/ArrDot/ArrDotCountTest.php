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
use NorseBlue\Sekkr\Exceptions\ValueNotCountableException;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

/**
 * Class ArrDotCountTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrDotCountTest extends TestCase
{
    /**
     * @test that the count method returns zero for an empty array when no key specified.
     */
    public function count_method_returns_zero_for_empty_array_when_no_key()
    {
        $arr_dot = new ArrDot;

        $this->assertEquals(0, $arr_dot->count());
    }

    /**
     * @test that the count method returns the number of items in array when no key specified for items with simple keys.
     */
    public function count_method_returns_number_items_in_array_when_no_key_items_with_simple_keys()
    {
        $arr_dot = new ArrDot(['foo' => 'bar', 'baz' => 'qux', 'corge' => 'grault']);

        $this->assertEquals(3, $arr_dot->count());
    }

    /**
     * @test that the count method returns the number of items in array when no key specified for items with composite keys.
     */
    public function count_method_returns_number_items_in_array_when_no_key_items_with_composite_keys()
    {
        $arr_dot = new ArrDot(['foo.bar' => 'baz', 'qux.corge' => 'grault', 'garply.waldo' => ' fred']);

        $this->assertEquals(3, $arr_dot->count());
    }

    /**
     * @test that the count method returns the number of items when specifying a simple or composite key.
     */
    public function count_method_returns_number_of_items_value_when_simple_or_composite_key()
    {
        $arr_dot = new ArrDot([
            'foo' => 'bar',
            'baz' => ['qux' => ['corge']],
            'grault' => ['garply' => ['waldo', 'fred'], 'plugh' => []]
        ]);

        $this->assertEquals(0, $arr_dot->count('foo'));
        $this->assertEquals(1, $arr_dot->count('baz.qux'));
        $this->assertEquals(2, $arr_dot->count('grault.garply'));
        $this->assertEquals(0, $arr_dot->count('grault.plugh'));
    }

    /**
     * @test that the count method returns the number of elements for multiple items.
     */
    public function count_method_returns_number_of_elements_for_multiple_items()
    {
        $arr_dot = new ArrDot([
            'foo' => 'bar',
            'baz' => ['qux' => ['corge']],
            'grault' => ['garply' => ['waldo', 'fred'], 'plugh' => []]
        ]);

        $this->assertEquals(['baz' => 1, 'grault.garply' => 2], $arr_dot->count(['baz', 'grault.garply']));
    }

    /**
     * @test that an undefined Arr item throws an exception.
     */
    public function undefined_arr_item_throws_exception()
    {
        $this->expectException(OutOfBoundsException::class);
        $arr = new ArrDot([
            'foo' => 'bar',
            'baz' => [
                'qux' => 'corge',
            ],
        ]);

        $arr->count('baz.grault');
    }

    /**
     * @test that a not countable Arr item throws an exception.
     */
    public function not_countable_arr_item_throws_exception()
    {
        $this->expectException(ValueNotCountableException::class);
        $arr = new ArrDot([
            'foo' => 'bar',
            'baz' => [
                'qux' => 'corge',
            ],
        ]);

        $arr->count('baz.qux', true);
    }
}

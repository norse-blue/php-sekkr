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

class ArrCountTest extends TestCase
{
    /**
     * @test that the count method returns zero for an empty array when no key specified.
     */
    public function count_method_returns_zero_for_empty_array_when_no_key()
    {
        $arr = new Arr;

        $this->assertEquals(0, $arr->count());
    }

    /**
     * @test that the count method returns the number of items in array when no key specified for items with simple keys.
     */
    public function count_method_returns_number_items_in_array_when_no_key_items_with_simple_keys()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => 'qux', 'corge' => 'grault']);

        $this->assertEquals(3, $arr->count());
    }

    /**
     * @test that the count method returns the number of items in array when no key specified for items with composite keys.
     */
    public function count_method_returns_number_items_in_array_when_no_key_items_with_composite_keys()
    {
        $arr = new Arr(['foo.bar' => 'baz', 'qux.corge' => 'grault', 'garply.waldo' => ' fred']);

        $this->assertEquals(3, $arr->count());
    }

    /**
     * @test that the count method returns the correct value when specifying a simple or composite key.
     */
    public function count_method_returns_correct_value_when_simple_or_composite_key()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => ['qux' => ['corge']],
            'grault' => ['garply' => ['waldo', 'fred'], 'plugh' => []]
        ]);

        $this->assertEquals(0, $arr->count('foo'));
        $this->assertEquals(1, $arr->count('baz.qux'));
        $this->assertEquals(2, $arr->count('grault.garply'));
        $this->assertEquals(0, $arr->count('grault.plugh'));
    }
}

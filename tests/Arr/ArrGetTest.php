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
 * Class ArrGetTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrGetTest extends TestCase
{
    /**
     * @test that the get method returns an empty array if Arr is empty and no key is given.
     */
    public function get_method_returns_empty_array_if_arr_is_empty_and_no_key_given()
    {
        $arr = new Arr;

        $this->assertEquals([], $arr->get());
    }

    /**
     * @test that the get method gets all items when no key is given.
     */
    public function get_method_gets_all_items_when_no_key_given()
    {
        $arr = new Arr(['foo' => 'bar', 'baz.qux' => 'corge']);

        $this->assertEquals(['foo' => 'bar', 'baz.qux' => 'corge'], $arr->get());
    }

    /**
     * @test that the get method returns the item value for a given key.
     */
    public function get_method_returns_item_value_for_key()
    {
        $arr = new Arr(['foo' => 'bar', 'baz.qux' => 'corge']);

        $this->assertEquals('bar', $arr->get('foo'));
        $this->assertEquals('corge', $arr->get('baz.qux'));
    }

    /**
     * @test that the get method returns the default value when the given does not exist.
     */
    public function get_method_returns_default_value_key_not_exists()
    {
        $arr = new Arr(['foo' => 'bar', 'baz.qux' => 'corge']);

        $this->assertEquals(null, $arr->get('grault'));
        $this->assertEquals(9, $arr->get('garply', 9));
    }

    /**
     * @test that the get method returns the correct values for an array of keys.
     */
    public function get_method_gets_correct_value_array_simple_keys()
    {
        $arr = new Arr(['foo' => 'bar', 'baz.qux' => 'corge', 'grault' => 'garply', 'waldo.fred' => 'plugh']);

        $this->assertEquals(['foo' => 'bar', 'baz.qux' => 'corge'], $arr->get(['foo', 'baz.qux']));
    }

    /**
     * @test that the get method throws an exception when key is undefined.
     */
    public function get_method_throws_exception_when_key_undefined()
    {
        $this->expectException(OutOfBoundsException::class);
        $arr = new Arr(['foo' => 'bar', 'baz.qux' => 'corge']);

        $arr->get('grault', null, true);
    }

    /**
     * @test that the array syntax returns the value for a given key
     */
    public function array_syntax_returns_value_for_key()
    {
        $arr = new Arr(['foo' => 'bar', 'baz.qux' => 'corge']);

        $this->assertEquals('bar', $arr['foo']);
        $this->assertEquals('corge', $arr['baz.qux']);
    }

    /**
     * @test that the array syntax returns the correct values for an array of keys.
     */
    public function array_syntax_returns_value_for_array_of_keys()
    {
        $arr = new Arr(['foo' => 'bar', 'baz.qux' => 'corge', 'grault' => 'garply', 'waldo.fred' => 'plugh']);

        $this->assertEquals(['foo' => 'bar', 'baz.qux' => 'corge'], $arr[['foo', 'baz.qux']]);
    }
}

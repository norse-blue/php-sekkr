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
 * Class ArrSetTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrSetTest extends TestCase
{
    /**
     * @test that the set method creates an item when no key is given.
     */
    public function set_method_creates_item_when_no_key_given()
    {
        $arr = new Arr;

        $arr->set(null, 'foo');

        $this->assertEquals([0 => 'foo'], $arr->all());
    }

    /**
     * @test that the set method creates an item with the given key.
     */
    public function set_method_creates_item_with_given_key()
    {
        $arr = new Arr;

        $arr->set('foo', 'bar');

        $this->assertEquals(['foo' => 'bar'], $arr->all());
    }

    /**
     * @test that the set method creates the given items.
     */
    public function set_method_creates_given_items()
    {
        $arr = new Arr;

        $arr->set(['foo' => 'bar', 'baz.qux' => 'corge', 'grault']);

        $this->assertEquals(['foo' => 'bar', 'baz.qux' => 'corge', 0 => 'grault'], $arr->all());
    }

    /**
     * @test that the set method replaces value if the item exists
     */
    public function set_method_replaces_value_if_item_exists()
    {
        $arr = new Arr(['foo' => 'bar']);

        $arr->set('foo', 'baz');

        $this->assertEquals(['foo' => 'baz'], $arr->all());
    }

    /**
     * @test that the set method prevents the replacement if the item exists
     */
    public function set_method_prevents_replacement_if_item_exists()
    {
        $arr = new Arr(['foo' => 'bar']);

        $arr->set('foo', 'baz', true);

        $this->assertEquals(['foo' => 'bar'], $arr->all());
    }

    /**
     * @test that the array syntax creates item when no key is given.
     */
    public function array_syntax_creates_item_when_no_key_given()
    {
        $arr = new Arr;

        $arr[] = 'foo';

        $this->assertEquals([0 => 'foo'], $arr->all());
    }

    /**
     * @test that the array syntax creates item with given key.
     */
    public function array_syntax_creates_item_with_given_key()
    {
        $arr = new Arr;

        $arr['foo'] = 'bar';

        $this->assertEquals(['foo' => 'bar'], $arr->all());
    }
}

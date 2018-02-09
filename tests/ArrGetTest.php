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

class ArrGetTest extends TestCase
{
    /**
     * @test that the get method gets all items when no key is given.
     */
    public function get_method_gets_all_items_when_no_key_given()
    {
        $arr1 = new Arr;
        $arr2 = new Arr(['foo' => 'bar', 'baz' => 'qux']);
        $arr3 = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertEquals([], $arr1->get());
        $this->assertEquals(['foo' => 'bar', 'baz' => 'qux'], $arr2->get());
        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ], $arr3->get());
    }

    /**
     * @test that the get method gets the correct value for a simple key.
     */
    public function get_method_gets_correct_value_simple_key()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => 'qux']);

        $this->assertEquals('bar', $arr->get('foo'));
        $this->assertEquals('qux', $arr->get('baz'));
    }
    
    /**
     * @test that the get method gets the default value when simple key does not exist.
     */
    public function get_method_gets_default_value_simple_key_not_exists()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => 'qux']);

        $this->assertEquals(null, $arr->get('corge'));
        $this->assertEquals(9, $arr->get('grault', 9));
    }

    /**
     * @test that the get method gets the correct value for a composed key.
     */
    public function get_method_gets_correct_value_composed_key()
    {
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertEquals('baz', $arr->get('foo.bar'));
        $this->assertEquals('grault', $arr->get('qux.corge'));
    }
    
    /**
     * @test that the get method gets the default value when composite key does not exist.
     */
    public function get_method_gets_default_value_composite_key_not_exists()
    {
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertEquals(null, $arr->get('gradly.waldo'));
        $this->assertEquals(9, $arr->get('fred.plugh', 9));
    }

    /**
     * @test that the get method gets the correct values for an array of simple keys.
     */
    public function get_method_gets_correct_value_array_simple_keys()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => 'qux']);

        $this->assertEquals(['bar', 'qux'], $arr->get(['foo', 'baz']));
    }

    /**
     * @test that the get method gets the correct values for an array of composite keys.
     */
    public function get_method_gets_correct_value_array_composite_keys()
    {
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertEquals(['baz', 'grault'], $arr->get(['foo.bar', 'qux.corge']));
    }

    /**
     * @test that the get method gets the correct values for an array of mixed keys.
     */
    public function get_method_gets_correct_value_array_mixed_keys()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
            'corge' => [
                'grault' => 'garply',
            ],
            'waldo' => [
                'fred' => 'plugh'
            ],
        ]);

        $this->assertEquals(['bar', 'qux', 'garply', 'plugh'], $arr->get(['foo', 'baz', 'corge.grault', 'waldo.fred']));
    }

    /**
     * @test that the array access syntax gets the correct value for a simple key.
     */
    public function array_access_syntax_gets_correct_value_simple_key()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => 'qux']);

        $this->assertEquals('bar', $arr['foo']);
        $this->assertEquals('qux', $arr['baz']);
    }

    /**
     * @test that the array access syntax gets the correct value for a composite key.
     */
    public function array_access_syntax_gets_correct_value_composite_key()
    {
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertEquals('baz', $arr['foo.bar']);
        $this->assertEquals('grault', $arr['qux.corge']);
    }

    /**
     * @test that the array access syntax gets the correct values for an array of simple keys.
     */
    public function array_access_syntax_gets_correct_value_array_simple_keys()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => 'qux']);

        $this->assertEquals(['bar', 'qux'], $arr[['foo', 'baz']]);
    }

    /**
     * @test that the array access syntax gets the correct values for an array of composite keys.
     */
    public function array_access_syntax_gets_correct_value_array_composite_keys()
    {
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertEquals(['baz', 'grault'], $arr[['foo.bar', 'qux.corge']]);
    }

    /**
     * @test that the array access syntax gets the correct values for an array of mixed keys.
     */
    public function array_access_syntax_gets_correct_value_array_mixed_keys()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
            'corge' => [
                'grault' => 'garply',
            ],
            'waldo' => [
                'fred' => 'plugh'
            ],
        ]);

        $this->assertEquals(['bar', 'qux', 'garply', 'plugh'], $arr[['foo', 'baz', 'corge.grault', 'waldo.fred']]);
    }
}

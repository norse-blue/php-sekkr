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

/**.
 * Class ArrDotGetTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrDotGetTest extends TestCase
{
    /**
     * @test that the get method gets all items when no key is given.
     */
    public function get_method_gets_all_items_when_no_key_given()
    {
        $arr_dot1 = new ArrDot;
        $arr_dot2 = new ArrDot(['foo' => 'bar', 'baz' => 'qux']);
        $arr_dot3 = new ArrDot([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertEquals([], $arr_dot1->get());
        $this->assertEquals(['foo' => 'bar', 'baz' => 'qux'], $arr_dot2->get());
        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ], $arr_dot3->get());
    }

    /**
     * @test that the get method gets the correct value for a simple key.
     */
    public function get_method_gets_correct_value_simple_key()
    {
        $arr_dot = new ArrDot(['foo' => 'bar', 'baz' => 'qux']);

        $this->assertEquals('bar', $arr_dot->get('foo'));
        $this->assertEquals('qux', $arr_dot->get('baz'));
    }

    /**
     * @test that the get method gets the default value when simple key does not exist.
     */
    public function get_method_gets_default_value_simple_key_not_exists()
    {
        $arr_dot = new ArrDot(['foo' => 'bar', 'baz' => 'qux']);

        $this->assertEquals(null, $arr_dot->get('corge'));
        $this->assertEquals(9, $arr_dot->get('grault', 9));
    }

    /**
     * @test that the get method gets the correct value for a composed key.
     */
    public function get_method_gets_correct_value_composed_key()
    {
        $arr_dot = new ArrDot([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertEquals('baz', $arr_dot->get('foo.bar'));
        $this->assertEquals('grault', $arr_dot->get('qux.corge'));
    }

    /**
     * @test that the get method gets the default value when composite key does not exist.
     */
    public function get_method_gets_default_value_composite_key_not_exists()
    {
        $arr_dot = new ArrDot([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertEquals(null, $arr_dot->get('garply.waldo'));
        $this->assertEquals(9, $arr_dot->get('fred.plugh', 9));
    }

    /**
     * @test that the get method gets the correct values for an array of simple keys.
     */
    public function get_method_gets_correct_value_array_simple_keys()
    {
        $arr_dot = new ArrDot(['foo' => 'bar', 'baz' => 'qux']);

        $this->assertEquals(['bar', 'qux'], $arr_dot->get(['foo', 'baz']));
    }

    /**
     * @test that the get method gets the correct values for an array of composite keys.
     */
    public function get_method_gets_correct_value_array_composite_keys()
    {
        $arr_dot = new ArrDot([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertEquals(['baz', 'grault'], $arr_dot->get(['foo.bar', 'qux.corge']));
    }

    /**
     * @test that the get method gets the correct values for an array of mixed keys.
     */
    public function get_method_gets_correct_value_array_mixed_keys()
    {
        $arr_dot = new ArrDot([
            'foo' => 'bar',
            'baz' => 'qux',
            'corge' => [
                'grault' => 'garply',
            ],
            'waldo' => [
                'fred' => 'plugh'
            ],
        ]);

        $this->assertEquals(['bar', 'qux', 'garply', 'plugh'],
            $arr_dot->get(['foo', 'baz', 'corge.grault', 'waldo.fred']));
    }

    /**
     * @test that the array access syntax gets the correct value for a simple key.
     */
    public function array_access_syntax_gets_correct_value_simple_key()
    {
        $arr_dot = new ArrDot(['foo' => 'bar', 'baz' => 'qux']);

        $this->assertEquals('bar', $arr_dot['foo']);
        $this->assertEquals('qux', $arr_dot['baz']);
    }

    /**
     * @test that the array access syntax gets the correct value for a composite key.
     */
    public function array_access_syntax_gets_correct_value_composite_key()
    {
        $arr_dot = new ArrDot([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertEquals('baz', $arr_dot['foo.bar']);
        $this->assertEquals('grault', $arr_dot['qux.corge']);
    }

    /**
     * @test that the array access syntax gets the correct values for an array of simple keys.
     */
    public function array_access_syntax_gets_correct_value_array_simple_keys()
    {
        $arr_dot = new ArrDot(['foo' => 'bar', 'baz' => 'qux']);

        $this->assertEquals(['bar', 'qux'], $arr_dot[['foo', 'baz']]);
    }

    /**
     * @test that the array access syntax gets the correct values for an array of composite keys.
     */
    public function array_access_syntax_gets_correct_value_array_composite_keys()
    {
        $arr_dot = new ArrDot([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertEquals(['baz', 'grault'], $arr_dot[['foo.bar', 'qux.corge']]);
    }

    /**
     * @test that the array access syntax gets the correct values for an array of mixed keys.
     */
    public function array_access_syntax_gets_correct_value_array_mixed_keys()
    {
        $arr_dot = new ArrDot([
            'foo' => 'bar',
            'baz' => 'qux',
            'corge' => [
                'grault' => 'garply',
            ],
            'waldo' => [
                'fred' => 'plugh'
            ],
        ]);

        $this->assertEquals(['bar', 'qux', 'garply', 'plugh'], $arr_dot[['foo', 'baz', 'corge.grault', 'waldo.fred']]);
    }
}

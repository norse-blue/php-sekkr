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

/**
 * Class ArrDotSetTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrDotSetTest extends TestCase
{
    /**
     * @test that the set method sets the correct value for a simple key.
     */
    public function set_method_sets_correct_value_simple_key()
    {
        $arr_dot = new ArrDot;

        $arr_dot->set('foo', 'bar');
        $arr_dot->set('baz', 'qux');

        $this->assertEquals(['foo' => 'bar', 'baz' => 'qux'], $arr_dot->all());
    }

    /**
     * @test that the set method sets the correct value for a composed key.
     */
    public function set_method_sets_correct_value_composed_key()
    {
        $arr_dot = new ArrDot;

        $arr_dot->set('foo.bar', 'baz');
        $arr_dot->set('qux.corge', 'grault');

        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ], $arr_dot->all());
    }

    /**
     * @test that the set method sets the correct values for a single array of simple keys.
     */
    public function set_method_sets_correct_value_single_array_simple_keys()
    {
        $arr_dot = new ArrDot;

        $arr_dot->set(['foo' => 'bar', 'baz' => 'qux']);

        $this->assertEquals(['foo' => 'bar', 'baz' => 'qux'], $arr_dot->all());
    }

    /**
     * @test that the set method sets the correct values for separate arrays of simple keys.
     */
    public function set_method_sets_correct_value_separate_arrays_simple_keys()
    {
        $arr_dot = new ArrDot;

        $arr_dot->set(['foo', 'baz'], ['bar', 'qux']);

        $this->assertEquals(['foo' => 'bar', 'baz' => 'qux'], $arr_dot->all());
    }

    /**
     * @test that the set method sets the correct values for a simple array of composite keys.
     */
    public function set_method_sets_correct_value_simple_array_composite_keys()
    {
        $arr_dot = new ArrDot;

        $arr_dot->set([
            'foo.bar' => 'baz',
            'qux.corge' => 'grault',
        ]);

        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ], $arr_dot->all());
    }

    /**
     * @test that the set method sets the correct values for separate arrays of composite keys.
     */
    public function set_method_sets_correct_value_separate_arrays_composite_keys()
    {
        $arr_dot = new ArrDot;

        $arr_dot->set(['foo.bar', 'qux.corge'], ['baz', 'grault']);

        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ], $arr_dot->all());
    }

    /**
     * @test that the set method sets the correct values for a single array of mixed keys.
     */
    public function set_method_sets_correct_value_single_array_mixed_keys()
    {
        $arr_dot = new ArrDot;

        $arr_dot->set([
            'foo' => 'bar',
            'baz' => 'qux',
            'corge.grault' => 'garply',
            'waldo.fred' => 'plugh',
        ]);

        $this->assertEquals([
            'foo' => 'bar',
            'baz' => 'qux',
            'corge' => [
                'grault' => 'garply',
            ],
            'waldo' => [
                'fred' => 'plugh'
            ],
        ], $arr_dot->all());
    }

    /**
     * @test that the set method sets the correct values for separate arrays of mixed keys.
     */
    public function set_method_sets_correct_value_separate_array_mixed_keys()
    {
        $arr_dot = new ArrDot;

        $arr_dot->set(['foo', 'baz', 'corge.grault', 'waldo.fred'], ['bar', 'qux', 'garply', 'plugh']);

        $this->assertEquals([
            'foo' => 'bar',
            'baz' => 'qux',
            'corge' => [
                'grault' => 'garply',
            ],
            'waldo' => [
                'fred' => 'plugh'
            ],
        ], $arr_dot->all());
    }

    /**
     * @test that the array access syntax sets the correct value for a simple key.
     */
    public function array_access_syntax_sets_correct_value_simple_key()
    {
        $arr_dot = new ArrDot;

        $arr_dot['foo'] = 'bar';
        $arr_dot['baz'] = 'qux';

        $this->assertEquals(['foo' => 'bar', 'baz' => 'qux'], $arr_dot->all());
    }

    /**
     * @test that the array access syntax sets the correct value for a composite key.
     */
    public function array_access_syntax_sets_correct_value_composite_key()
    {
        $arr_dot = new ArrDot;

        $arr_dot['foo.bar'] = 'baz';
        $arr_dot['qux.corge'] = 'grault';

        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ], $arr_dot->all());
    }

    /**
     * @test that the array access syntax sets the correct values for an array of simple keys.
     */
    public function array_access_syntax_sets_correct_value_array_simple_keys()
    {
        $arr_dot = new ArrDot;

        $arr_dot[['foo', 'baz']] = ['bar', 'qux'];

        $this->assertEquals(['foo' => 'bar', 'baz' => 'qux'], $arr_dot->all());
    }

    /**
     * @test that the array access syntax sets the correct values for an array of composite keys.
     */
    public function array_access_syntax_sets_correct_value_array_composite_keys()
    {
        $arr_dot = new ArrDot;

        $arr_dot[['foo.bar', 'qux.corge']] = ['baz', 'grault'];

        $this->assertEquals([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ], $arr_dot->all());
    }

    /**
     * @test that the array access syntax sets the correct values for an array of mixed keys.
     */
    public function array_access_syntax_sets_correct_value_array_mixed_keys()
    {
        $arr_dot = new ArrDot;

        $arr_dot[['foo', 'baz', 'corge.grault', 'waldo.fred']] = ['bar', 'qux', 'garply', 'plugh'];

        $this->assertEquals([
            'foo' => 'bar',
            'baz' => 'qux',
            'corge' => [
                'grault' => 'garply',
            ],
            'waldo' => [
                'fred' => 'plugh'
            ],
        ], $arr_dot->all());
    }

    /**
     * @test that the set method sets the correct value without a key.
     */
    public function set_method_sets_correct_value_without_key()
    {
        $arr_dot = new ArrDot;

        $arr_dot->set(null, 'foo');
        $arr_dot->set(null, 'bar');

        $this->assertEquals([0 => 'foo', 1 => 'bar'], $arr_dot->all());
    }
}

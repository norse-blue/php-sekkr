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
 * Class ArrDotHasTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrDotHasTest extends TestCase
{
    /**
     * @test that the has method returns false when no key is given.
     */
    public function has_method_returns_false_when_no_key_given()
    {
        $arr_dot = new ArrDot(['foo' => 'bar', 'baz' => ' qux']);

        $this->assertFalse($arr_dot->has([]));
    }

    /**
     * @test that the has method returns the correct value for simple key.
     */
    public function has_method_returns_correct_value_simple_key()
    {
        $arr_dot = new ArrDot([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $this->assertTrue($arr_dot->has('foo'));
        $this->assertTrue($arr_dot->has('baz'));
        $this->assertFalse($arr_dot->has('corge'));
    }

    /**
     * @test that the has method returns the correct value for composite key.
     */
    public function has_method_returns_correct_value_composite_key()
    {
        $arr_dot = new ArrDot([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertTrue($arr_dot->has('foo.bar'));
        $this->assertTrue($arr_dot->has('qux.corge'));
        $this->assertFalse($arr_dot->has('waldo.fred'));
    }

    /**
     * @test that the has method returns the correct value for an array of simple key.
     */
    public function has_method_returns_correct_value_array_simple_key()
    {
        $arr_dot = new ArrDot([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $this->assertTrue($arr_dot->has(['foo', 'baz']));
        $this->assertFalse($arr_dot->has(['foo', 'baz', 'corge']));
    }

    /**
     * @test that the has method returns the correct value for an array of composite key.
     */
    public function has_method_returns_correct_value_array_composite_key()
    {
        $arr_dot = new ArrDot([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertTrue($arr_dot->has(['foo.bar', 'qux.corge']));
        $this->assertFalse($arr_dot->has(['foo.bar', 'qux.corge', 'waldo.fred']));
    }
}

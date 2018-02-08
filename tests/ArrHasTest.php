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

use InvalidArgumentException;
use NorseBlue\Sekkr\Arr;
use PHPUnit\Framework\TestCase;

class ArrHasTest extends TestCase
{
    /**
     * @test that the has method returns false when no key is given.
     */
    public function has_method_returns_false_when_no_key_given()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => ' qux']);

        $this->assertFalse($arr->has([]));
    }
    /**
     * @test that the has method returns the correct value for simple key.
     */
    public function has_method_returns_correct_value_simple_key()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $this->assertTrue($arr->has('foo'));
        $this->assertTrue($arr->has('baz'));
        $this->assertFalse($arr->has('corge'));
    }

    /**
     * @test that the has method returns the correct value for composite key.
     */
    public function has_method_returns_correct_value_composite_key()
    {
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertTrue($arr->has('foo.bar'));
        $this->assertTrue($arr->has('qux.corge'));
        $this->assertFalse($arr->has('waldo.fred'));
    }

    /**
     * @test that the has method returns the correct value for an array of simple key.
     */
    public function has_method_returns_correct_value_array_simple_key()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $this->assertTrue($arr->has(['foo', 'baz']));
        $this->assertFalse($arr->has(['foo', 'baz', 'corge']));
    }

    /**
     * @test that the has method returns the correct value for an array of composite key.
     */
    public function has_method_returns_correct_value_array_composite_key()
    {
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $this->assertTrue($arr->has(['foo.bar', 'qux.corge']));
        $this->assertFalse($arr->has(['foo.bar', 'qux.corge', 'waldo.fred']));
    }

    /**
     * @test that the has method throws an exception when a non int or string key is used.
     */
    public function has_method_throws_exception_when_non_int_or_string_key_is_used()
    {
        $arr = new Arr;

        $this->expectException(InvalidArgumentException::class);
        $arr->has(0.0);
    }
}

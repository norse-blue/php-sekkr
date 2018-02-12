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
 * Class ArrHasTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrHasTest extends TestCase
{
    /**
     * @test that the has method returns true if item with key exists.
     */
    public function has_method_returns_true_if_key_exists()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz.qux' => 'corge',
        ]);

        $this->assertTrue($arr->has('foo'));
        $this->assertTrue($arr->has('baz.qux'));
    }

    /**
     * @test that the has method returns false if item with key does not exist.
     */
    public function has_method_returns_false_if_key_does_not_exist()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz.qux' => 'corge',
        ]);

        $this->assertFalse($arr->has('grault'));
        $this->assertFalse($arr->has('garply.waldo'));
    }

    /**
     * @test that the has method returns an array with true for keys that exist and false for keys that don't exist.
     */
    public function has_method_returns_array_with_true_for_keys_that_exist_and_false_for_keys_that_dont_exist()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz.qux' => 'corge',
        ]);

        $this->assertEquals(['foo' => true, 'baz.qux' => true, 'corge' => false, 'grault.garply' => false],
            $arr->has(['foo', 'baz.qux', 'corge', 'grault.garply']));
    }
}

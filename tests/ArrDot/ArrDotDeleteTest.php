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
 * Class ArrDotDeleteTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrDotDeleteTest extends TestCase
{
    /**
     * @test that the delete method does nothing when empty array.
     */
    public function delete_method_does_nothing_when_empty_arr()
    {
        $arr_dot = new ArrDot;

        $arr_dot->delete([]);

        $this->assertEquals([], $arr_dot->all());
    }

    /**
     * @test that the delete method correctly removes the item for simple key.
     */
    public function delete_method_correctly_removes_item_simple_key()
    {
        $arr_dot = new ArrDot(['foo' => 'bar', 'baz' => 'qux']);

        $arr_dot->delete('foo');

        $this->assertEquals(['baz' => 'qux'], $arr_dot->all());
    }

    /**
     * @test that the delete method correctly removes the item for composite key.
     */
    public function delete_method_correctly_removes_item_composite_key()
    {
        $arr_dot = new ArrDot([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $arr_dot->delete('foo.bar');

        $this->assertEquals([
            'foo' => [],
            'qux' => [
                'corge' => 'grault',
            ],
        ], $arr_dot->all());
    }

    /**
     * @test that the array syntax correctly removes the item for simple key.
     */
    public function array_access_correctly_removes_item_simple_key()
    {
        $arr_dot = new ArrDot(['foo' => 'bar', 'baz' => 'qux']);

        unset($arr_dot['foo']);

        $this->assertEquals(['baz' => 'qux'], $arr_dot->all());
    }

    /**
     * @test that the array syntax correctly removes the item for composite key.
     */
    public function array_access_correctly_removes_item_composite_key()
    {
        $arr_dot = new ArrDot([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        unset($arr_dot['foo.bar']);

        $this->assertEquals([
            'foo' => [],
            'qux' => [
                'corge' => 'grault',
            ],
        ], $arr_dot->all());
    }
}

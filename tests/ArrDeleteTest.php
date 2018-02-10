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

class ArrDeleteTest extends TestCase
{
    /**
     * @test that the delete method does nothing when empty array.
     */
    public function delete_method_does_nothing_when_empty_arr()
    {
        $arr = new Arr;

        $arr->delete([]);

        $this->assertEquals([], $arr->all());
    }

    /**
     * @test that the delete method correctly removes the item for simple key.
     */
    public function delete_method_correctly_removes_item_simple_key()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => 'qux']);

        $arr->delete('foo');

        $this->assertEquals(['baz' => 'qux'], $arr->all());
    }

    /**
     * @test that the delete method correctly removes the item for composite key.
     */
    public function delete_method_correctly_removes_item_composite_key()
    {
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $arr->delete('foo.bar');

        $this->assertEquals([
            'foo' => [],
            'qux' => [
                'corge' => 'grault',
            ],
        ], $arr->all());
    }

    /**
     * @test that the array syntax correctly removes the item for simple key.
     */
    public function array_access_correctly_removes_item_simple_key()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => 'qux']);

        unset($arr['foo']);

        $this->assertEquals(['baz' => 'qux'], $arr->all());
    }

    /**
     * @test that the array syntax correctly removes the item for composite key.
     */
    public function array_access_correctly_removes_item_composite_key()
    {
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        unset($arr['foo.bar']);

        $this->assertEquals([
            'foo' => [],
            'qux' => [
                'corge' => 'grault',
            ],
        ], $arr->all());
    }
}

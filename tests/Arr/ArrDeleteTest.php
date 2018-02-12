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
 * Class ArrDeleteTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrDeleteTest extends TestCase
{
    /**
     * @test that the delete method does nothing on empty Arr.
     */
    public function delete_method_does_nothing_when_empty_arr()
    {
        $arr = new Arr;

        $arr->delete('foo');

        $this->assertEquals([], $arr->all());
    }

    /**
     * @test that the delete method removes the item.
     */
    public function delete_method_removes_item()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => 'qux']);

        $arr->delete('foo');

        $this->assertEquals(['baz' => 'qux'], $arr->all());
    }

    /**
     * @test that the delete method removes the item with dot in key.
     */
    public function delete_method_removes_item_with_dot_key()
    {
        $arr = new Arr([
            'foo.bar' => 'baz',
            'qux.corge' => 'grault',
        ]);

        $arr->delete('foo.bar');

        $this->assertEquals([
            'qux.corge' => 'grault',
        ], $arr->all());
    }

    /**
     * @test that the array syntax removes the item.
     */
    public function array_access_removes_item()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => 'qux']);

        unset($arr['foo']);

        $this->assertEquals(['baz' => 'qux'], $arr->all());
    }

    /**
     * @test that the the array syntax removes the item with dot in key.
     */
    public function array_access_removes_item_with_dot_key()
    {
        $arr = new Arr([
            'foo.bar' => 'baz',
            'qux.corge' => 'grault',
        ]);

        unset($arr['foo.bar']);

        $this->assertEquals(['qux.corge' => 'grault'], $arr->all());
    }
}

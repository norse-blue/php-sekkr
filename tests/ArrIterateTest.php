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

class ArrIterateTest extends TestCase
{
    /**
     * @test that an empty Arr object can be traversed.
     */
    public function empty_arr_object_can_be_traversed()
    {
        $arr = new Arr;
        $count = 0;

        foreach($arr as $item){
            $count++;
        }

        $this->assertEquals(0, $count);
    }

    /**
     * @test that the Arr object with simple keys can be traversed.
     */
    public function arr_object_with_simple_keys_can_be_traversed()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => 'qux']);
        $count = 0;

        foreach($arr as $item){
            $count++;
        }

        $this->assertEquals(2, $count);
    }

    /**
     * @test that the Arr object with composite keys can be traversed.
     */
    public function arr_object_with_composite_keys_can_be_traversed()
    {
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);
        $count = 0;

        foreach($arr as $item){
            $count++;
        }

        $this->assertEquals(2, $count);
    }
}

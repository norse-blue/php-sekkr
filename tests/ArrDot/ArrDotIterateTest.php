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
 * Class ArrDotIterateTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrDotIterateTest extends TestCase
{
    /**
     * @test that an empty ArrDot object can be traversed.
     */
    public function empty_arr_object_can_be_traversed()
    {
        $arr_dot = new ArrDot;
        $count = 0;

        foreach ($arr_dot as $item) {
            $count++;
        }

        $this->assertEquals(0, $count);
    }

    /**
     * @test that the ArrDot object with simple keys can be traversed.
     */
    public function arr_object_with_simple_keys_can_be_traversed()
    {
        $arr_dot = new ArrDot(['foo' => 'bar', 'baz' => 'qux']);
        $count = 0;

        foreach ($arr_dot as $item) {
            $count++;
        }

        $this->assertEquals(2, $count);
    }

    /**
     * @test that the ArrDot object with composite keys can be traversed.
     */
    public function arr_object_with_composite_keys_can_be_traversed()
    {
        $arr_dot = new ArrDot([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);
        $count = 0;

        foreach ($arr_dot as $item) {
            $count++;
        }

        $this->assertEquals(2, $count);
    }
}

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
 * Class ArrDotBlankTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrDotBlankTest extends TestCase
{
    /**
     * @test that the ArrDot object is empty.
     */
    public function arr_object_is_empty()
    {
        $arr_dot = new ArrDot;

        $this->assertTrue($arr_dot->blank());
    }

    /**
     * @test that the ArrDot object is not empty.
     */
    public function arr_object_is_not_empty()
    {
        $arr_dot = new ArrDot([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $this->assertFalse($arr_dot->blank());
    }

    /**
     * @test that all given items are empty.
     */
    public function all_items_are_empty()
    {
        $arr_dot = new ArrDot([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $this->assertTrue($arr_dot->blank(['bar', 'qux']));
        $this->assertFalse($arr_dot->blank(['foo', 'baz']));
    }
}

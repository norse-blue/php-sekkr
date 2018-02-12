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
 * Class ArrTraverseTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrTraverseTest extends TestCase
{
    /**
     * @test that an empty Arr can be traversed.
     */
    public function empty_arr_can_be_traversed()
    {
        $arr = new Arr;
        $count = 0;

        foreach ($arr as $item) {
            $count++;
        }

        $this->assertEquals(0, $count);
    }

    /**
     * @test that the Arr with items can be traversed.
     */
    public function arr_with_items_can_be_traversed()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => 'qux']);
        $count = 0;

        foreach ($arr as $item) {
            $count++;
        }

        $this->assertEquals(2, $count);
    }
}

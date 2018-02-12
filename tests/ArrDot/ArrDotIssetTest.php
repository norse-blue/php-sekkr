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
 * Class ArrDotIssetTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrDotIssetTest extends TestCase
{
    /**
     * @test that the given key is or not set.
     */
    public function key_is_or_not_set()
    {
        $arr_dot = new ArrDot([
            'foo' => 'bar',
            'baz.qux' => ' corge',
        ]);

        $this->assertTrue(isset($arr_dot['foo']));
        $this->assertTrue(isset($arr_dot['baz.qux']));
        $this->assertFalse(isset($arr_dot['foo.bar']));
        $this->assertFalse(isset($arr_dot['grault']));
        $this->assertFalse(isset($arr_dot['garply.waldo']));
    }
}

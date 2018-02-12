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
 * Class ArrIssetTest
 *
 * @package NorseBlue\Sekkr\Tests
 */
class ArrIssetTest extends TestCase
{
    /**
     * @test that the given key is set.
     */
    public function key_is_set()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz.qux' => ' corge',
        ]);

        $this->assertTrue(isset($arr['foo']));
        $this->assertTrue(isset($arr['baz.qux']));
    }

    /**
     * @test that the given key is not set.
     */
    public function key_is_not_set()
    {
        $arr = new Arr([
            'foo' => 'bar',
            'baz.qux' => ' corge',
        ]);

        $this->assertFalse(isset($arr['foo.bar']));
        $this->assertFalse(isset($arr['grault']));
        $this->assertFalse(isset($arr['garply.waldo']));
    }
}

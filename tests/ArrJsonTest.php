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

class ArrJsonTest extends TestCase
{
    /**
     * @test that an empty arr object is correctly serialized into JSON.
     */
    public function empty_arr_object_is_correctly_serialized_into_json()
    {
        $arr = new Arr;

        $json = json_encode($arr);

        $this->assertEquals('[]', $json);
    }

    /**
     * @test that the arr object with simple keys is correctly serialized into JSON.
     */
    public function arr_object_with_simple_keys_is_correctly_serialized_into_json()
    {
        $arr = new Arr(['foo' => 'bar', 'baz' => 'qux']);

        $json = json_encode($arr);

        $this->assertEquals('{"foo":"bar","baz":"qux"}', $json);
    }

    /**
     * @test that the arr object with composite keys is correctly serialized into JSON.
     */
    public function arr_object_with_composite_keys_is_correctly_serialized_into_json()
    {
        $arr = new Arr([
            'foo' => [
                'bar' => 'baz',
            ],
            'qux' => [
                'corge' => 'grault',
            ],
        ]);

        $json = json_encode($arr);

        $this->assertEquals('{"foo":{"bar":"baz"},"qux":{"corge":"grault"}}', $json);
    }
}

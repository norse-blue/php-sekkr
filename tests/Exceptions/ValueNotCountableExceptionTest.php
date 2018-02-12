<?php
/**
 * Sekkr - A framework agnostic package for array manipulation.
 *
 * @author  Axel Pardemann <axel.pardemann@norse.blue
 * @link    https://github.com/NorseBlue/Sekkr
 * @license https://github.com/NorseBlue/Sekkr/blob/master/LICENSE.md
 */

namespace NorseBlue\Sekkr\Tests;

use NorseBlue\Sekkr\Exceptions\ValueNotCountableException;
use PHPUnit\Framework\TestCase;

class ValueNotCountableExceptionTest extends TestCase
{
    /**
     * @test that the exception contains the given values.
     */
    public function exception_contains_given_value()
    {
        $exception = new ValueNotCountableException('Exception message.', gettype('foo'));

        $this->assertEquals('string', $exception->getValueType());
        $this->assertContains(sprintf("%s: Exception message.", ValueNotCountableException::class), (string)$exception);
        $this->assertContains(sprintf("Value type: %s", 'string'), (string)$exception);
    }
}

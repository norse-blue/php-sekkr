<?php
/**
 * Sekkr - A framework agnostic package for array manipulation.
 *
 * @author  Axel Pardemann <axel.pardemann@norse.blue
 * @link    https://github.com/NorseBlue/Sekkr
 * @license https://github.com/NorseBlue/Sekkr/blob/master/LICENSE.md
 */

namespace NorseBlue\Sekkr\Exceptions;

use RuntimeException;
use Throwable;

/**
 * Class ValueNotCountableException
 *
 * @package NorseBlue\Sekkr\Exceptions
 */
class ValueNotCountableException extends RuntimeException
{
    //region ========== Properties ==========
    protected $valueType;
    //endregion

    //region ========== Constructor ==========
    /**
     * FileNotFoundException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param string         $valueType
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", string $valueType = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->valueType = $valueType;
    }
    //endregion

    //region ========== Accessors ==========
    /**
     * Attribute $valueType accesor.
     *
     * @return string
     */
    public function getValueType(): string
    {
        return $this->valueType;
    }
    //endregion

    //region ========== Methods ==========
    /**
     * Returns the string representation.
     *
     * @return string
     */
    public function __toString(): string
    {
        $str = parent::__toString();

        !empty($this->valueType) && $str .= sprintf("\nValue type: %s", $this->valueType);

        return $str;
    }
    //endregion
}

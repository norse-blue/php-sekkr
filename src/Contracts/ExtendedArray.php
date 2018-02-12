<?php
/**
 * Sekkr - A framework agnostic package for array manipulation.
 *
 * @author  Axel Pardemann <axel.pardemann@norse.blue
 * @link    https://github.com/NorseBlue/Sekkr
 * @license https://github.com/NorseBlue/Sekkr/blob/master/LICENSE.md
 */

namespace NorseBlue\Sekkr\Contracts;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use OutOfBoundsException;

/**
 * Interface ExtendedArray
 *
 * @package NorseBlue\Sekkr\Contracts
 */
interface ExtendedArray extends ArrayAccess, Countable, IteratorAggregate
{
    //region ========== Methods ==========
    /**
     * Returns all items in the array.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Returns whether the item(s) specified by $key is(are) blank (empty) or not.
     * If $keys is set to null, it will check if the whole array is empty.
     *
     * @param int|string|array|null $keys
     *
     * @return bool|array
     * @throws OutOfBoundsException
     */
    public function blank($keys = null);

    /**
     * Clears (sets the value to an empty array) the item(s) specified by $key only if they exist.
     * If $key is set to null, the whole array will be cleared.
     *
     * @param int|string|array|null $keys
     *
     * @return void
     */
    public function clear($keys = null): void;

    /**
     * Returns the number of elements of the item(s) specified by $key.
     * If $keys is set to null, the count will be over the items array.
     *
     * @param int|string|array|null $keys
     * @param bool                  $throw_exception
     *
     * @return int|array
     */
    public function count($keys = null, $throw_exception = false);

    /**
     * Deletes the item(s) specified by $key.
     *
     * @param int|string|array $keys
     *
     * @return void
     */
    public function delete($keys): void;

    /**
     * Gets the value of item(s) specified by $key. If the item does not exist the default value is returned.
     * When $key is set to null all items are returned.
     *
     * @param int|string|array|null $keys
     * @param mixed                 $default
     * @param bool                  $throw_exception
     *
     * @return mixed
     * @throws OutOfBoundsException
     */
    public function get($keys = null, $default = null, $throw_exception = false);

    /**
     * Returns whether the item(s) specified by $key exist in the array or not.
     *
     * @param int|string|array $keys
     *
     * @return mixed
     */
    public function has($keys);

    /**
     * Sets the value of the item(s) specified by $key. If $key is set to null then a new item will be created with
     * the index set as per PHP array rules. If $prevent_replace is set to true and the item already exists in
     * the array, then the value will not be replaced.
     *
     * @param int|string|array|null $keys
     * @param mixed                 $value
     * @param bool                  $prevent_replace
     *
     * @return void
     */
    public function set($keys = null, $value = null, $prevent_replace = false): void;
    //endregion
}

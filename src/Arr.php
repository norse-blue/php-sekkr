<?php
/**
 * Sekkr - A framework agnostic package for array manipulation.
 *
 * @author  Axel Pardemann <axel.pardemann@norse.blue
 * @link    https://github.com/NorseBlue/Sekkr
 * @license https://github.com/NorseBlue/Sekkr/blob/master/LICENSE.md
 */

namespace NorseBlue\Sekkr;

use ArrayIterator;
use Countable;
use JsonSerializable;
use NorseBlue\Sekkr\Exceptions\ValueNotCountableException;
use NorseBlue\Sekkr\Contracts\ExtendedArray;
use OutOfBoundsException;
use Traversable;

/**
 * Class Arr
 *
 * @package NorseBlue\Sekkr
 */
class Arr implements ExtendedArray, JsonSerializable
{
    //region ========== Properties ==========
    /**
     * The items contained in the array.
     *
     * @var array
     */
    protected $items = [];
    //endregion

    //region ========== Static ==========
    /**
     * Creates a new instance with the given items.
     *
     * @param array $items
     *
     * @return Arr
     */
    public static function make(array $items = []): self
    {
        return new static($items);
    }
    //endregion

    //region ========== Constructor ==========
    /**
     * Arr constructor.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->set($items);
    }
    //endregion

    //region ========== Implements ArrayIterator ==========
    /**
     * Retrieve an external iterator.
     *
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
    //endregion

    //region ========== Implements ArrayAccess ==========
    /**
     * Whether an offset exists or not.
     *
     * @param mixed $offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return $this->has($offset);
    }

    /**
     * Offset to retrieve.
     *
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset, null, true);
    }

    /**
     * Offset to set.
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        $this->set($offset, $value);
    }

    /**
     * Offset to unset.
     *
     * @param mixed $offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        $this->delete($offset);
    }
    //endregion

    //region ========== Implements ExtendedArray ==========
    /**
     * Returns all items in the array.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Returns whether the item(s) specified by $key is(are) blank (empty) or not.
     * If $keys is set to null, it will check if the whole array is empty.
     *
     * @param int|string|array|null $keys
     *
     * @return bool|array
     * @throws OutOfBoundsException
     */
    public function blank($keys = null)
    {
        if (is_null($keys)) {
            return empty($this->items);
        }

        if (is_array($keys)) {
            $blanks = [];
            foreach ($keys as $key) {
                $blanks[$key] = empty($this->items[$key]);
            }
            return $blanks;
        }

        if ($this->has($keys)) {
            return empty($this->items[$keys]);
        }

        throw new OutOfBoundsException(sprintf('Undefined index: %s', $keys));
    }

    /**
     * Clears (sets the value to an empty array) the item(s) specified by $key only if they exist.
     * If $key is set to null, the whole array will be cleared.
     *
     * @param int|string|array|null $keys
     *
     * @return void
     */
    public function clear($keys = null): void
    {
        if (is_null($keys)) {
            $this->items = [];
            return;
        }

        if (is_array($keys)) {
            foreach ($keys as $key) {
                $this->set($key, []);
            }
            return;
        }

        if ($this->has($keys)) {
            $this->set($keys, []);
            return;
        }
    }

    /**
     * Returns the number of elements of the item(s) specified by $key.
     * If $keys is set to null, the count will be over the items array.
     *
     * @param int|string|array|null $keys
     * @param bool                  $throw_exception
     *
     * @return int|array
     */
    public function count($keys = null, $throw_exception = false)
    {
        if (is_null($keys)) {
            return count($this->items);
        }

        if (is_array($keys)) {
            $counts = [];
            foreach ($keys as $key) {
                $counts[$key] = $this->count($key);
            }
            return $counts;
        }

        if ($this->has($keys)) {
            $value = $this->items[$keys];
            if (is_array($value) || $value instanceof Countable) {
                return count($value);
            }

            if ($throw_exception) {
                throw new ValueNotCountableException(
                    sprintf('The value at index \'%s\' is not countable.', $keys),
                    gettype($value)
                );
            }

            return 0;
        }

        throw new OutOfBoundsException(sprintf('Undefined index: %s', $keys));
    }

    /**
     * Deletes the item(s) specified by $key.
     *
     * @param int|string|array $keys
     *
     * @return void
     */
    public function delete($keys): void
    {
        $keys = (array)$keys;
        foreach ($keys as $key) {
            unset($this->items[$key]);
        }
    }

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
    public function get($keys = null, $default = null, $throw_exception = false)
    {
        if (is_null($keys)) {
            return $this->items;
        }

        if (is_array($keys)) {
            $values = [];
            foreach ($keys as $key) {
                $values[$key] = $this->get($key, $default, $throw_exception);
            }
            return $values;
        }

        if ($this->has($keys)) {
            return $this->items[$keys];
        }

        if ($throw_exception) {
            throw new OutOfBoundsException(sprintf('Undefined index: %s', $keys));
        }

        return $default;
    }

    /**
     * Returns whether the item(s) specified by $key exist in the array or not.
     *
     * @param int|string|array $keys
     *
     * @return mixed
     */
    public function has($keys)
    {
        if (is_array($keys)) {
            $has = [];
            foreach ($keys as $key) {
                $has[$key] = array_key_exists($key, $this->items);
            }
            return $has;
        }

        return array_key_exists($keys, $this->items);
    }

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
    public function set($keys = null, $value = null, $prevent_replace = false): void
    {
        if (is_null($keys)) {
            $this->items[] = $value;
            return;
        }

        if (is_array($keys)) {
            foreach ($keys as $key => $value) {
                $this->set($key, $value);
            }
            return;
        }

        if ($this->has($keys) && $prevent_replace) {
            return;
        }

        $this->items[$keys] = $value;
    }
    //endregion

    //region ========== Implements JsonSerializable ==========
    /**
     * Specify data which should be serialized to JSON.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->items;
    }
    //endregion
}

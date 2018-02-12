<?php
/**
 * Sekkr - A framework agnostic package for array manipulation.
 *
 * @author  Axel Pardemann <axel.pardemann@norse.blue
 * @link    https://github.com/NorseBlue/Sekkr
 * @license https://github.com/NorseBlue/Sekkr/blob/master/LICENSE.md
 */

namespace NorseBlue\Sekkr;

use Countable;
use NorseBlue\Sekkr\Exceptions\ValueNotCountableException;
use OutOfBoundsException;

/**
 * Class ArrDot
 *
 * @package NorseBlue\Sekkr
 * @see     https://github.com/adbario/php-dot-notation Inspired by the work of Riku Särkinen (@adbario)
 */
class ArrDot extends Arr
{
    //region ========== Override Methods ==========
    /**
     * Returns whether the array is blank (empty).
     *
     * @param  array|int|string|null $keys
     *
     * @return bool
     */
    public function blank($keys = null): bool
    {
        if (is_null($keys)) {
            return empty($this->items);
        }

        $keys = (array)$keys;
        foreach ($keys as $key) {
            if (!empty($this->get($key))) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param null $keys
     * @param bool $throw_exception
     *
     * @return array|int
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
            $value = $this->get($keys);
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
     * Deletes the item specified by $key and returns whether the item existed or not.
     * Another way to put it: returns whether the item was deleted or there was nothing to delete.
     *
     * @param  array|int|string $keys
     *
     * @return void
     */
    public function delete($keys): void
    {
        $keys = (array)$keys;
        foreach ($keys as $key) {
            if (array_key_exists($key, $this->items)) {
                unset($this->items[$key]);
                continue;
            }

            $items = &$this->items;
            $segments = explode('.', $key);
            $lastSegment = array_pop($segments);
            foreach ($segments as $segment) {
                if (!isset($items[$segment]) || !is_array($items[$segment])) {
                    continue 2;
                }
                $items = &$items[$segment];
            }
            unset($items[$lastSegment]);
        }
    }

    /**
     * Gets the value of item specified by $key. If it does not exists the default value is returned.
     *
     * @param  int|string|null $key
     * @param  mixed           $default
     * @param bool             $throw_exception
     *
     * @return mixed
     */
    public function get($key = null, $default = null, $throw_exception = false)
    {
        if (is_null($key)) {
            return $this->items;
        }

        if (is_array($key)) {
            $result = [];
            foreach ($key as $k) {
                $result[] = $this->get($k, $default);
            }
            return $result;
        }

        if (array_key_exists($key, $this->items)) {
            return $this->items[$key];
        }

        if (strpos($key, '.') === false) {
            return $default;
        }

        $items = $this->items;
        foreach (explode('.', $key) as $segment) {
            if (!is_array($items) || !array_key_exists($segment, $items)) {
                return $default;
            }
            $items = &$items[$segment];
        }

        return $items;
    }

    /**
     * Check if the given key exists or all of the given keys exist.
     *
     * @param  int|string|array $keys
     *
     * @return bool
     */
    public function has($keys): bool
    {
        $keys = (array)$keys;
        if (empty($keys)) {
            return false;
        }

        foreach ($keys as $key) {
            $items = $this->items;
            if (array_key_exists($key, $items)) {
                continue;
            }

            foreach (explode('.', $key) as $segment) {
                if (!is_array($items) || !array_key_exists($segment, $items)) {
                    return false;
                }
                $items = $items[$segment];
            }
        }
        return true;
    }

    /**
     * Sets the value of the item specified by $key. If $prevent_replace is set to true and the item already
     * exists in the array, then the value will not be replaced.
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
            if (is_array($value) && (count($keys) == count($value))) {
                $keys = array_combine($keys, $value);
            }

            foreach ($keys as $key => $value) {
                $this->set($key, $value);
            }
            return;
        }

        $items = &$this->items;
        foreach (explode('.', $keys) as $key) {
            if (!isset($items[$key]) || !is_array($items[$key])) {
                $items[$key] = [];
            }
            $items = &$items[$key];
        }

        $items = $value;
    }
    //endregion
}

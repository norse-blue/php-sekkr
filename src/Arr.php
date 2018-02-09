<?php
/**
 * Sekkr
 * A package for array manipulation.
 *
 * @author  Axel Pardemann <axel.pardemann@norse.blue
 * @link    https://github.com/NorseBlue/Sekkr
 * @license https://github.com/NorseBlue/Sekkr/blob/master/LICENSE.md
 */

namespace NorseBlue\Sekkr;

use ArrayAccess;
use InvalidArgumentException;

/**
 * NorseBlue\Sekkr\Arr
 *
 * @see https://github.com/adbario/php-dot-notation Based on the work of Riku Särkinen (@adbario)
 */
class Arr implements ArrayAccess
{
    /**
     * The underlying array.
     *
     * @var array
     */
    protected $items = [];

    //region ========== Static ==========

    /**
     * Creates a new Arr object.
     *
     * @param array $items
     * @return Arr
     */
    public static function make(array $items = []): self
    {
        return new Arr($items);
    }
    //region

    //region ========== Constructor ==========
    /**
     * Creates a new instance.
     *
     * @param  array $items
     */
    public function __construct(array $items = [])
    {
        $this->set($items);
    }
    //endregion

    //region ========== Implements ArrayAccess ==========
    /**
     * Check if the given key exists.
     *
     * @param  int|string $key
     *
     * @return bool
     */
    public function offsetExists($key): bool
    {
        return $this->has($key);
    }

    /**
     * Return the value of the given key.
     *
     * @param  int|string $key
     *
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * Set the given value to the given key.
     *
     * @param  int|string|null $key
     * @param  mixed           $value
     *
     * @return void
     */
    public function offsetSet($key, $value): void
    {
        $this->set($key, $value);
    }

    /**
     * Delete the given key.
     *
     * @param  int|string $key
     *
     * @return void
     */
    public function offsetUnset($key): void
    {
        $this->delete($key);
    }
    //endregion

    //region ========== Private/Protected Methods ==========
    /**
     * Return the items as an array.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Checks if the given key exists in the given array.
     *
     * @param  int|string $key
     * @param  array      $array
     *
     * @return bool
     */
    protected function exists($key, array $array): bool
    {
        if (!is_int($key) && !is_string($key)) {
            throw new InvalidArgumentException(sprintf(
                'The $key value should be either a string or an integer, \'%s\' given.',
                gettype($key)
            ));
        }

        // TODO: make this compatible with the dot access syntax
        return array_key_exists($key, $array);
    }
    //endregion

    //region ========== Public Methods ==========
    /**
     * Delete the given key or keys.
     *
     * @param  array|int|string $keys
     *
     * @return void
     */
    public function delete($keys): void
    {
        $keys = (array)$keys;
        foreach ($keys as $key) {
            if ($this->exists($key, $this->items)) {
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
     * Gets the value of the given key or, if not exists, the default value.
     *
     * @param  int|string|null $key
     * @param  mixed           $default
     *
     * @return mixed
     */
    public function get($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->all();
        }

        if (is_array($key)) {
            $result = [];
            foreach ($key as $k) {
                $result[] = $this->get($k, $default);
            }
            return $result;
        }

        if ($this->exists($key, $this->items)) {
            return $this->items[$key];
        }

        if (strpos($key, '.') === false) {
            return $default;
        }

        $items = $this->items;
        foreach (explode('.', $key) as $segment) {
            if (!is_array($items) || !$this->exists($segment, $items)) {
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
            if ($this->exists($key, $items)) {
                continue;
            }

            foreach (explode('.', $key) as $segment) {
                if (!is_array($items) || !$this->exists($segment, $items)) {
                    return false;
                }
                $items = $items[$segment];
            }
        }
        return true;
    }

    /**
     * Check if a given key or keys are empty.
     *
     * @param  array|int|string|null $keys
     *
     * @return bool
     */
    public function isEmpty($keys = null)
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
     * Set the given key / value pair or pairs.
     *
     * @param  array|int|string $keys
     * @param  mixed            $value
     *
     * @return void
     */
    public function set($keys, $value = null): void
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

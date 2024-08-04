<?php

namespace App\Collection;

/**
 * AbstractCollection class provides a base implementation for a collection of items.
 */
abstract class AbstractCollection implements \ArrayAccess, \IteratorAggregate, \Countable
{
    /**
     * @var array The collection of items.
     */
    protected static array $items = [];

    /**
     * Constructor to initialize the collection with the provided items.
     *
     * @param array $items The items to initialize the collection with.
     */
    public function __construct(array $items)
    {
        self::$items = $items;
    }

    /**
     * Converts the collection to an array.
     *
     * @return array An array representation of the collection.
     */
    abstract public function toArray(): array;

    /**
     * Retrieves all items in the collection.
     *
     * @return array The array of items in the collection.
     */
    public function all(): array
    {
        return self::$items;
    }

    /**
     * Checks if an offset exists in the collection.
     *
     * @param mixed $offset The offset to check.
     * @return bool True if the offset exists, false otherwise.
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset(self::$items[$offset]);
    }

    /**
     * Retrieves the value at a specific offset in the collection.
     *
     * @param mixed $offset The offset to retrieve.
     * @return mixed The value at the specified offset.
     */
    public function offsetGet(mixed $offset): mixed
    {
        return self::$items[$offset];
    }

    /**
     * Sets the value at a specific offset in the collection.
     *
     * @param mixed $offset The offset to set.
     * @param mixed $value The value to set.
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            self::$items[] = $value;
        } else {
            self::$items[$offset] = $value;
        }
    }

    /**
     * Unsets the value at a specific offset in the collection.
     *
     * @param mixed $offset The offset to unset.
     */
    public function offsetUnset(mixed $offset): void
    {
        unset(self::$items[$offset]);
    }

    /**
     * Retrieves an iterator for the items in the collection.
     *
     * @return \ArrayIterator An iterator for the items in the collection.
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator(self::$items);
    }

    /**
     * Counts the number of items in the collection.
     *
     * @return int The number of items in the collection.
     */
    public function count(): int
    {
        return count(self::$items);
    }
}

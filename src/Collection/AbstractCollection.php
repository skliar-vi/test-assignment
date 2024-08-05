<?php

namespace App\Collection;

/**
 * AbstractCollection class provides a base implementation for a collection of items.
 */
abstract class AbstractCollection implements \ArrayAccess, \IteratorAggregate, \Countable
{
    protected static array $items = [];

    public function __construct(array $items)
    {
        self::$items = $items;
    }

    /**
     * Converts the collection to an array.
     */
    abstract public function toArray(): array;

    /**
     * Retrieves all items in the collection.
     */
    public function all(): array
    {
        return self::$items;
    }

    /**
     * Checks if an offset exists in the collection.
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset(self::$items[$offset]);
    }

    /**
     * Retrieves the value at a specific offset in the collection.
     */
    public function offsetGet(mixed $offset): mixed
    {
        return self::$items[$offset];
    }

    /**
     * Sets the value at a specific offset in the collection.
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
     */
    public function offsetUnset(mixed $offset): void
    {
        unset(self::$items[$offset]);
    }

    /**
     * Retrieves an iterator for the items in the collection
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator(self::$items);
    }

    /**
     * Counts the number of items in the collection.
     */
    public function count(): int
    {
        return count(self::$items);
    }
}

<?php

namespace App\Collection;

abstract class AbstractCollection implements \ArrayAccess, \IteratorAggregate, \Countable
{
    /**
     * @var array
     */
    protected static array $items = [];

    public function __construct(array $items)
    {
        self::$items = $items;
    }

    /**
     * @return array
     */
    abstract public function toArray(): array;

    /**
     * @return array
     */
    public function all(): array
    {
        return self::$items;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset(self::$items[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return self::$items[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
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
     * @param mixed $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        unset(self::$items[$offset]);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator(self::$items);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count(self::$items);
    }
}

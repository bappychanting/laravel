<?php

namespace App\Utils\Vo;

use Closure;
use Countable;
use Traversable;
use ArrayIterator;
use ReflectionClass;
use IteratorAggregate;
use InvalidArgumentException;
use App\Utils\VO\IntegerObject;

/**
 * @template T
 */
class Collection implements Countable, IteratorAggregate
{
    /**
     * @var T[]
     */
    protected $items = [];

    /**
     * Create a new collection.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * Get all of the items in the collection.
     *
     * @return T[]
     */
    public function toArray(): array
    {
        return $this->items;
    }

    /**
     * Get all of the string items in the collection.
     *
     * @return array
     */
    public function toStringArray(): array
    {
        if (empty($this->items)) {
            return [];
        }

        if ($this->items[0] instanceof string) {
            return $this->items;
        }

        if ($this->items[0] instanceof StringObject) {
            return array_map(static function (StringObject $item) {
                return $item->toString();
            }, $this->items);
        }

        return [];
    }

    /**
     * Get all of the integer items in the collection.
     *
     * @return array
     */
    public function toIntegerArray(): array
    {
        if (empty($this->items)) {
            return [];
        }

        if ($this->items[0] instanceof int) {
            return $this->items;
        }

        if ($this->items[0] instanceof IntegerObject) {
            return array_map(static function (IntegerObject $item) {
                return $item->toInt();
            }, $this->items);
        }

        return [];
    }

    /**
     * @return T[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    final public function count(): int
    {
        return count($this->items);
    }

    /**
     * Get an iterator for the items.
     *
     * @return ArrayIterator<T>
     */
    final public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    final public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * このCollectionの要素内に、想定外の型のオブジェクトが含まれていないかチェックします。
     *
     * @param string $itemClassName 格納可能なクラス名
     * @return void
     * @throws InvalidArgumentException 想定外の型のオブジェクトが含まれている場合throwされます。
     */
    protected function checkObjectInItem(string $itemClassName): void
    {
        foreach ($this->items as $item) {
            if (! $item instanceof $itemClassName) {
                throw new InvalidArgumentException(
                    vsprintf('contains NOT [%s] object [INPUT: %s]', [$itemClassName, $item]) // Note: The second argument should probably be handled to ensure it's a string, or toString() is called if available
                );
            }
        }
    }

    /**
     * 指定のメソッド名で値が一致する要素が存在するか確認します。
     *
     * @param string $methodName
     * @param mixed $value
     * @return bool
     */
    public function existsWithMethodName(string $methodName, mixed $value): bool
    {
        foreach ($this->items as $item) {
            $refClass = new ReflectionClass($item);
            // $refClass = new ReflectionClass($item); // The image seems to have a stray line here, removing for cleanup

            $propertyValue = $refClass->getMethod($methodName)->invoke($item);
            if ($propertyValue === $value) {
                return true;
            }
        }

        return false;
    }

    /**
     * ソートして新しいCollectionを返却します。
     *
     * @param Closure $closure
     * @return self
     */
    public function sort(Closure $closure): self
    {
        $items = $this->getItems();
        usort($items, $closure);
        return new static($items);
    }

    /**
     * 指定の条件を満たす最初の要素を返却します。
     *
     * @param Closure $cond
     * @param null $default
     * @return T|null
     */
    public function find(Closure $cond, $default = null): mixed
    {
        foreach ($this->items as $item) {
            if ($cond($item)) {
                return $item;
            }
        }

        return $default;
    }
}
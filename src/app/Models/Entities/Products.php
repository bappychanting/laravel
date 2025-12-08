<?php

namespace App\Models\Entities;

use App\Utils\Vo\Collection;

/**
 * @implements Collection<Products>
 */
class Products extends Collection
{
    public function getTotalPrice(): int
    {
        return array_sum(
            array_map(
                static function (Product $item) {
                    return $item->getPrice();
                },
                $this->items
            )
        );
    }
    public function getTotalQuantity(): int
    {
        return array_sum(
            array_map(
                static function (Product $item) {
                    return $item->getQuantity();
                },
                $this->items
            )
        );
    }
}
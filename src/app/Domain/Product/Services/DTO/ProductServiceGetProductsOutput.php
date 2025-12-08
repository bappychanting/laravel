<?php

namespace App\Domain\Product\Services\DTO;

use App\Models\Entities\Products;


class ProductServiceGetProductsOutput
{
    public function __construct(
        private Products $products
    ) {
    }

    public function getProducts(): Products
    {
        return $this->products;
    }
}
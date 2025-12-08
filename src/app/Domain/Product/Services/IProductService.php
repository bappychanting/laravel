<?php

namespace App\Domain\Product\Services;

use App\Domain\Product\Services\DTO\ProductServiceGetProductsInput;
use App\Domain\Product\Services\DTO\ProductServiceGetProductsOutput;

interface IProductService
{
    /**
     * Return all products as a Collection of ProductEntity.
     */
    public function getProducts(ProductServiceGetProductsInput $input): ProductServiceGetProductsOutput;
}
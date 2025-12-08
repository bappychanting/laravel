<?php

namespace App\Domain\Product\Repositories;

use App\Models\Product;

interface ICreateProductRepository
{
    // Define methods related to product operations
    public function __invoke(): void;
}
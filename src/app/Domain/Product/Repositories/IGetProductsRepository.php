<?php

namespace App\Domain\Product\Repositories;

use App\Models\Entities\Products;

interface IGetProductsRepository
{
    // Define methods related to product operations
    public function __invoke(string $keyword): Products;
}
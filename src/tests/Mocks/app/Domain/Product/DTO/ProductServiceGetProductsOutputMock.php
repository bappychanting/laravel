<?php

namespace Tests\Mocks\app\Domain\Product\DTO;

use App\Models\Entities\Products;
use Tests\Mocks\app\Models\Entities\ProductMock;
use App\Domain\Product\Services\DTO\ProductServiceGetProductsOutput;

class ProductServiceGetProductsOutputMock
{
    public static function usual(): ProductServiceGetProductsOutput 
    {
        return new ProductServiceGetProductsOutput(
            $products = new Products([
                    ProductMock::usual(),
            ])
        );
    }   
}
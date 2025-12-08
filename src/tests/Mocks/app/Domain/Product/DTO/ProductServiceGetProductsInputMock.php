<?php

namespace Tests\Mocks\app\Domain\Product\DTO;

use App\Domain\Product\Services\DTO\ProductServiceGetProductsInput;

class ProductServiceGetProductsInputMock
{
    public static function usual(): ProductServiceGetProductsInput 
    {
        return new ProductServiceGetProductsInput(
            $keyword = null
        );
    }   
}
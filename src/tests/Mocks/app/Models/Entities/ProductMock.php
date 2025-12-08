<?php

namespace Tests\Mocks\app\Models\Entities;

use App\Models\Entities\Product;


class ProductMock
{
    public static function usual(): Product 
    {
        return new Product(
            name: 'Sample Product',
            price: 19.99,
            quantity: 100,
            details: 'This is a sample product for testing purposes.'
        );
    }   
}
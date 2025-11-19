<?php

namespace App\UseCases\Products;

use App\Http\Requests\V1\Products\IProductListGetRequest;
use App\Http\Requests\V1\Products\ProductListGetRequest;

class ProductListGetUseCase implements IProductListGetUseCase
{

    public function __contruct()
    {
        // Logic to retrieve and return the product list

    }

    /**
     * @param ProductListGetRequest $request
     */
    public function __invoke(IProductListGetRequest $request)
    {
        // Logic to retrieve and return the product list
        return response()->json([
            'products' => [
                ['id' => 1, 'name' => 'Product A', 'price' => 100],
                ['id' => 2, 'name' => 'Product B', 'price' => 150],
                // ... more products
            ],
        ]);
    }
}

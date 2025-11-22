<?php

namespace App\Http\Responses\V1\Products;

use App\Http\Responses\BaseResponse;

class ProductListGetResponse extends BaseResponse implements IProductListGetResponse
{
    public function toArrayResponse(): array
    {
        return [
            'products' => [
                ['id' => 1, 'name' => 'Product A', 'price' => 100],
                ['id' => 2, 'name' => 'Product B', 'price' => 150],
                // ... more products
            ],
        ];
    }
}
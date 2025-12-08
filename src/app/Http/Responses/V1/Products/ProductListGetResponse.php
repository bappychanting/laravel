<?php

namespace App\Http\Responses\V1\Products;

use App\Http\Responses\BaseResponse;

class ProductListGetResponse extends BaseResponse implements IProductListGetResponse
{
    public function toArrayResponse(): array
    {
        $products = [];
        foreach($this->getProducts() as $product) {
            $products[] = [
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'details' => $product->getDetails(),
                'quantity' => $product->getQuantity(),
            ];
        }

        return $products;
    }
}
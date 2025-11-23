<?php

namespace App\UseCases\Products;

use App\Http\Requests\V1\Products\ProductListGetRequest;
use App\Http\Requests\V1\Products\IProductListGetRequest;
use App\Http\Responses\V1\Products\ProductListGetResponse;
use App\Http\Responses\V1\Products\IProductListGetResponse;

class ProductListGetUseCase implements IProductListGetUseCase
{

    public function __construct()
    {
        // Constructor left intentionally empty; add dependencies here if needed.
    }

    /**
     * @param ProductListGetRequest $request
     */
    public function __invoke(IProductListGetRequest $request): IProductListGetResponse
    {
        // Logic to retrieve and return the product list
        return new ProductListGetResponse([]);
    }
}

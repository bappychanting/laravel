<?php

namespace App\Http\Controllers\V1\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Products\IProductListGetRequest;
use App\UseCases\Products\ProductListGetUseCase;
use App\UseCases\Products\IProductListGetUseCase;

class ProductListGetAction extends Controller
{

    /**
     * @param ProductListGetUseCase $productListGetUseCase
     */
    public function __construct(
        private IProductListGetUseCase $productListGetUseCase
    ){
        // Constructor logic if needed
    }

    /**
     * @param IProductListGetRequest $request
     * returns \Illuminate\Http\JsonResponse
     */
    public function __invoke(IProductListGetRequest $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->productListGetUseCase->__invoke($request);
        return $response;
    }
}

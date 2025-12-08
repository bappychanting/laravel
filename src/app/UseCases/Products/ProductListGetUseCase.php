<?php

namespace App\UseCases\Products;

use Illuminate\Support\Facades\Log;
use App\Domain\Product\Services\IProductService;
use App\Http\Requests\V1\Products\ProductListGetRequest;
use App\Http\Requests\V1\Products\IProductListGetRequest;
use App\Http\Responses\V1\Products\ProductListGetResponse;
use App\Http\Responses\V1\Products\IProductListGetResponse;
use App\Domain\Product\Services\DTO\ProductServiceGetProductsInput;

class ProductListGetUseCase implements IProductListGetUseCase
{
    /**
     * @param ProductService $productService
     */
    public function __construct(
        private IProductService $productService
    ){
    }

    /**
     * @param ProductListGetRequest $request
     */
    public function __invoke(IProductListGetRequest $request): IProductListGetResponse
    {
        Log::info('started ProductListGetUseCase');

        $products = $this->productService->getProducts(new ProductServiceGetProductsInput($request->getKeyword()));

        Log::info('done ProductListGetUseCase');

        return new ProductListGetResponse($products);
    }
}

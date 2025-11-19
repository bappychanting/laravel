<?php

namespace App\UseCases\Products;

use App\Http\Requests\V1\Products\IProductListGetRequest;
use App\Http\Requests\V1\Products\ProductListGetRequest;

interface IProductListGetUseCase
{
    /**
     * @param ProductListGetRequest $request
     */
    public function __invoke(IProductListGetRequest $request);
}
<?php

namespace App\Infra\Product\Services;

use App\Domain\Product\Services\IProductService;
use App\Domain\Product\Services\DTO\ProductServiceGetProductsInput;
use App\Domain\Product\Repositories\IGetProductsRepository;
use App\Domain\Product\Services\DTO\ProductServiceGetProductsOutput;

class ProductService implements IProductService
{
    /**
     * @param GetProductsRepository $getProductsRepository
     */
    public function __construct(
        private IGetProductsRepository $getProductsRepository
    ){
    }

    /**
     * Return all products as a Collection of ProductEntity.
     */
    public function getProducts(ProductServiceGetProductsInput $input): ProductServiceGetProductsOutput
    {
        $products = $this->getProductsRepository->__invoke($input->getKeyword());

        return new ProductServiceGetProductsOutput($products);
    }
}
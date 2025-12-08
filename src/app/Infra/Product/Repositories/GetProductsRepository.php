<?php

namespace App\Infra\Product\Repositories;

use App\Models\Product;
use App\Models\Entities\Products;
use App\Models\Entities\Mappers\ProductsMapper;
use App\Domain\Product\Repositories\IGetProductsRepository;

class GetProductsRepository implements IGetProductsRepository
{
    public function __construct(
        private Product $productModel
    ){
    }

    public function __invoke(?string $keyword = null): Products
    {
        $products = $this->productModel->search($keyword)->get();

        return ProductsMapper::collectionFromModels($products);
    }
    
}
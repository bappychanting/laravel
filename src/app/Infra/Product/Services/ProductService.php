<?php

namespace App\Infra\Product\Services;

use App\Domain\Product\Services\IProductService;
use Illuminate\Support\Collection;
use App\Models\Entities\Product as ProductEntity;

class ProductService implements IProductService
{
    /**
     * Collection of product entities managed by this service.
     *
     * @var Collection<int, ProductEntity>
     */
    protected Collection $products;

    /**
     * Accept an array of Product entities and store as a Collection.
     *
     * @param array<int, ProductEntity> $products
     */
    public function __construct(array $products = [])
    {
        $this->products = collect($products);
    }

    /**
     * Return all products as a Collection of ProductEntity.
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * Add a ProductEntity to the collection.
     */
    public function addProduct(ProductEntity $product): static
    {
        $this->products->push($product);

        return $this;
    }

    /**
     * Return array representation of the products collection.
     * Uses entity `toArray()` if available.
     *
     * @return array<int,array>
     */
    public function toArray(): array
    {
        return $this->products->map(function ($p) {
            if (is_object($p) && method_exists($p, 'toArray')) {
                return $p->toArray();
            }

            return (array) $p;
        })->all();
    }
}
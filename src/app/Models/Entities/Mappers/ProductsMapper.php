<?php

namespace App\Models\Entities\Mappers;

use App\Models\Entities\Product;
use App\Models\Entities\Products;
use App\Models\Product as ProductModel;
use Illuminate\Support\Collection;

class ProductsMapper
{
    public static function collectionFromModels($models): Products
    {
        if ($models instanceof Collection) {
            $models = $models->all();
        }

        $entities = array_map(
            static fn($model) => self::entityFromModel($model),
            $models
        );

        return new Products($entities);
    }

    public static function entityFromModel($model): Product
    {
        $model = $model instanceof ProductModel
            ? $model
            : (new ProductModel())->forceFill((array) $model);

        return new Product(
            $model->name,
            $model->price,
            $model->quantity,
            $model->details
        );
    }
}
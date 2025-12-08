<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Infra\Product\Services\ProductService;
use App\Domain\Product\Services\IProductService;
use App\UseCases\Products\ProductListGetUseCase;
use App\UseCases\Products\IProductListGetUseCase;
use App\Http\Requests\V1\Products\ProductListGetRequest;
use App\Http\Requests\V1\Products\IProductListGetRequest;
use App\Domain\Product\Repositories\IGetProductsRepository;
use App\Infra\Product\Repositories\CreateProductRepository;
use App\Domain\Product\Repositories\ICreateProductRepository;
use App\Infra\Product\Repositories\GetProductsRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register requests
        $this->registerRequests();

        // Register user cases
        $this->registerUseCases();

        // Register services
        $this->registerServices();

        // Register repositories
        $this->registerRepositories();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    // Register requests
    private function registerRequests()
    {
        $this->app->bind(IProductListGetRequest::class, ProductListGetRequest::class);
    }

    // Register user cases
    private function registerUseCases()
    {
        $this->app->bind(IProductListGetUseCase::class, ProductListGetUseCase::class);
    }

    // Register services
    private function registerServices()
    {
        $this->app->bind(IProductService::class, ProductService::class);
    }

    // Register repositories
    private function registerRepositories()
    {
        $this->app->bind(ICreateProductRepository::class, CreateProductRepository::class);
        $this->app->bind(IGetProductsRepository::class, GetProductsRepository::class);
    }
}

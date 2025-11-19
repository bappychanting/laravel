<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Requests\V1\Products\IProductListGetRequest;
use App\Http\Requests\V1\Products\ProductListGetRequest;
use App\UseCases\Products\IProductListGetUseCase;
use App\UseCases\Products\ProductListGetUseCase;

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
}

<?php

namespace Tests\Unit\app\UseCases\Products;

use Mockery;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use App\Domain\Product\Services\IProductService;
use App\UseCases\Products\IProductListGetUseCase;
use App\Http\Requests\V1\Products\IProductListGetRequest;
use App\Http\Responses\V1\Products\IProductListGetResponse;
use Tests\Mocks\app\Domain\Product\DTO\ProductServiceGetProductsOutputMock;

class ProductListGetUseCaseTest extends TestCase
{
    private IProductService $productService;

    private IProductListGetRequest $request;

    private IProductListGetUseCase $targetUc;

    protected function setUp(): void
    {
        parent::setUp();

        Log::shouldReceive('info');
        
        $this->productService = Mockery::mock(IProductService::class);
        $this->instance(IProductService::class, $this->productService);

        $this->request = Mockery::mock(IProductListGetRequest::class);

        $this->request->shouldReceive('getKeyword')
            ->andReturn(null);

        $this->targetUc = app()->make(IProductListGetUseCase::class);
    }

    public function test_success()
    {
        $this->productService->shouldReceive('getProducts')
            ->once()
            ->andReturn(ProductServiceGetProductsOutputMock::usual());
        
        $actual = $this->targetUc->__invoke($this->request);

        $this->assertInstanceOf(IProductListGetResponse::class, $actual);
    }
}
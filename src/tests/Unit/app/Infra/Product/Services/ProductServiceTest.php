<?php

namespace Tests\Unit\app\Domain\Product\Services;

use Mockery;
use Tests\TestCase;
use App\Models\Entities\Products;
use App\Domain\Product\Services\IProductService;
use Tests\Mocks\app\Models\Entities\ProductMock;
use App\Domain\Product\Repositories\IGetProductsRepository;
use App\Domain\Product\Services\DTO\ProductServiceGetProductsOutput;
use Tests\Mocks\app\Domain\Product\DTO\ProductServiceGetProductsInputMock;

class ProductServiceTest extends TestCase
{
    private IGetProductsRepository $getProductsRepository;

    private IProductService $targetSc;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->getProductsRepository = Mockery::mock(IGetProductsRepository::class);
        $this->instance(IGetProductsRepository::class, $this->getProductsRepository);

        $this->targetSc = app()->make(IProductService::class);
    }



    public function test_success()
    {
        $this->getProductsRepository->shouldReceive('__invoke')
            ->once()
            ->andReturn(new Products([
                ProductMock::usual()
            ]));

        $actual = $this->targetSc->getProducts(ProductServiceGetProductsInputMock::usual());

        $this->assertInstanceOf(ProductServiceGetProductsOutput::class, $actual);
    }
}
<?php

namespace App\Domain\Product\Services\DTO;

class ProductServiceGetProductsInput
{
    public function __construct(
        private ?string $keyword = null
    )
    {
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }
}
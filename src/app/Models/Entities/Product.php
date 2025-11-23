<?php

namespace App\Models\Entities;

class Product extends BaseEntity
{
    public function __construct(
        private string $name,
        private float $price,
        private int $quantity,
        private ?string $details = null
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }
}

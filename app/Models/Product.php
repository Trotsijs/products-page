<?php declare(strict_types=1);

namespace App\Models;

class Product
{

    private int $sku;
    private string $name;
    private float $price;

    public function __construct(int $sku, string $name, float $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    public function getSku(): int
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

}
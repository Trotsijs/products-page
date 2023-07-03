<?php declare(strict_types=1);

namespace App\Models;

class Product {

    private int $id;
    private int $sku;
    private string $name;
    private float $price;
    public function __construct($id, $sku, $name, $price) {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
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
<?php

namespace App\Models;

use App\Repositories\PdoProductRepository;

class Book extends Product
{
    private string $weight;

    public function __construct(int $sku, string $name, float $price)
    {
        parent::__construct($sku, $name, $price);
        $this->weight = $_POST['weight'];
    }

    public function getWeight(): string
    {
        return $this->weight;
    }

    public function save()
    {
        (new PdoProductRepository)->queryBuilder()->insert('products')
            ->values([
                'sku' => '?',
                'name' => '?',
                'price' => '?',
                'weight' => '?',
                'type' => '?',
            ])
            ->setParameter(0, $this->getSku())
            ->setParameter(1, $this->getName())
            ->setParameter(2, $this->getPrice())
            ->setParameter(3, $this->getWeight())
            ->setParameter(4, 'book')
            ->executeQuery();
    }
}

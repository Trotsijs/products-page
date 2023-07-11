<?php

namespace App\Models;

use App\Repositories\PdoProductRepository;

class Dvd extends Product
{
    private string $size;

    public function __construct(int $sku, string $name, float $price)
    {
        parent::__construct($sku, $name, $price);
        $this->size = $_POST['size'];
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function save()
    {
        (new PdoProductRepository)->queryBuilder()->insert('products')
            ->values([
                'sku' => '?',
                'name' => '?',
                'price' => '?',
                'size' => '?',
                'type' => '?',
            ])
            ->setParameter(0, $this->getSku())
            ->setParameter(1, $this->getName())
            ->setParameter(2, $this->getPrice())
            ->setParameter(3, $this->getSize())
            ->setParameter(4, 'dvd')
            ->executeQuery();
    }
}
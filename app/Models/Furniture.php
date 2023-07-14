<?php

namespace App\Models;

use App\Repositories\PdoProductRepository;

class Furniture extends Product
{
    private string $width;
    private string $length;
    private string $height;

    public function __construct(string $sku, string $name, float $price)
    {
        parent::__construct($sku, $name, $price);
        $this->width = $_POST['width'];
        $this->length = $_POST['length'];
        $this->height = $_POST['height'];
    }

    public function getDimensions(): string
    {
        return $this->width . 'x' . $this->length . 'x' . $this->height;
    }

    public function save()
    {
        (new PdoProductRepository)->queryBuilder()->insert('products')
            ->values([
                'sku' => '?',
                'name' => '?',
                'price' => '?',
                'dimensions' => '?',
                'type' => '?',
            ])
            ->setParameter(0, $this->getSku())
            ->setParameter(1, $this->getName())
            ->setParameter(2, $this->getPrice())
            ->setParameter(3, $this->getDimensions())
            ->setParameter(4, 'furniture')
            ->executeQuery();
    }
}
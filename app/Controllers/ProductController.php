<?php

namespace App\Controllers;

use App\Core\TwigView;
use App\Repositories\PdoProductRepository;

class ProductController
{
    public function index(): TwigView
    {
        $products = (new PdoProductRepository)->queryBuilder()
            ->select('*')
            ->from('products')
            ->executeQuery()
            ->fetchAllAssociative();

        return new TwigView('products', ['products' => $products]);
    }

    public function addProduct(): TwigView
    {
        return new TwigView('addProduct', []);

    }

    public function store()
    {
        $sku = $_POST['sku'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $type = $_POST['productType'];

        $product = $this->createProduct($type, $sku, $name, $price);

        if ($product) {
            $this->setProductAttributes($product, $_POST);
            $product->save();
        }

        header('Location: /');
    }

    private function createProduct($type, $sku, $name, $price)
    {
        $productClass = "App\\Models\\" . $type;

        if (class_exists($productClass) && is_subclass_of($productClass, 'App\\Models\\Product')) {
            return new $productClass($sku, $name, $price);
        }

        return null;
    }

    private function setProductAttributes($product, $data)
    {
        $productAttributes = get_object_vars($product);

        foreach ($data as $key => $value) {
            if (array_key_exists($key, $productAttributes)) {
                $setterMethod = 'set' . ucfirst($key);
                $product->$setterMethod($value);
            }
        }
    }

    public function delete()
    {
        $selectedProducts = $_POST['delete-checkbox'];

        foreach ($selectedProducts as $sku) {
            (new PdoProductRepository)->queryBuilder()
                ->delete('products')
                ->where('sku = :sku')
                ->setParameter('sku', $sku)
                ->executeStatement();
        }

        header('Location: /');
    }
}

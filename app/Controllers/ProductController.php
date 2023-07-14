<?php

namespace App\Controllers;

use App\Core\Redirect;
use App\Core\TwigView;
use App\Core\Validator;
use App\Exceptions\ValidationException;
use App\Repositories\PdoProductRepository;
use Exception;

class ProductController
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator;
    }
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

    public function store(): Redirect
    {
        try {

            $this->validator->validateAddProductForm();
            $sku = $_POST['sku'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $type = $_POST['productType'];

            $product = $this->createProduct($type, $sku, $name, $price);

            if ($product) {
                $this->setProductAttributes($product, $_POST);
                $product->save();
            }

            return new Redirect('/');

        } catch (ValidationException $exception) {
            $_SESSION['errors'] = $this->validator->getErrors();
//            var_dump($_SESSION['errors']);die;
            return new Redirect('/add-product');

        } catch (Exception $exception) {
            return new Redirect('/add-product');
        }

    }

    private function createProduct($type, $sku, $name, $price): ?object
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

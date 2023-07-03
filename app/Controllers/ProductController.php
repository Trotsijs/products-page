<?php

namespace App\Controllers;

use App\Core\TwigView;

class ProductController
{
    public function index(): TwigView
    {
        return new TwigView('products', []);
    }

    public function addProduct(): TwigView
    {
        return new TwigView('addProduct', []);
    }
}
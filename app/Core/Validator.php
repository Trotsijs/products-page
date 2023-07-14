<?php

namespace App\Core;

use App\Exceptions\ValidationException;

class Validator
{
    private array $errors = [];


    public function validateAddProductForm(): void
    {
        $this->validateSku();
        $this->validateName();
        $this->validatePrice();
        $this->validateProductType();

        if (count($this->errors) > 0) {
            $_SESSION['errors'] = $this->errors;
            throw new ValidationException('Form is not valid');
        }

    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function validatePrice()
    {
        if (empty($_POST['price'])) {
            $this->errors['price'] = 'Price is required';
        } elseif (!is_numeric($_POST['price'])) {
            $this->errors['price'] = 'Price must be a number';
        }
    }

    private function validateName()
    {
        if (empty($_POST['name'])) {
            $this->errors['name'] = 'Name is required';
        }
    }

    private function validateSku()
    {
        if (empty($_POST['sku'])) {
            $this->errors['sku'] = 'SKU is required';
        }
    }

    private function validateProductType()
    {
        if (empty($_POST['productType'])) {
            $this->errors['productType'] = 'Product type is required';
        }
    }

}
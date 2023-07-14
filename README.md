<h1 align="center">Products page</h1>

<p align="center">
<a href="https://www.php.net/"><img src="https://img.shields.io/badge/PHP-7.4-grey?labelColor=777BB4" alt="PHP 7.4"></a>
<a href="https://www.mysql.com/"><img src="https://img.shields.io/badge/-MySQL-4479A1?logo=mysql&logoColor=white" alt="MySQL"></a>
</p>
<p align="center">[ <a href="https://products-akermanis.000webhostapp.com">LIVE VERSION</a> ]</p>

### About:

This is a simple products page with CRUD functionality and is based on the MVC pattern. <br>

Add new products by pressing "<b>ADD</b>" button and fill the form by entering <b>#sku</b>, <b>#name</b>, <b>#price</b> and <b>#type</b>. <br>
Based on the type of the product, additional fields will be displayed. <br>
Mass delete selected products by clicking on the "<b>MASS DELETE</b>" button. <br>

### Preview:

Add new products: <br>
<img src="add-product.gif" alt="add-product">

Mass delete selected products: <br>
<img src="delete-products.gif" alt="delete-products">





### Installation:

1. Clone or Download the project.
2. Run:
````
composer install
````
3. Navigate to `/public` directory:
````php
cd .\public\
````
4. Start a server from the terminal
```php
php -S localhost:8000
```


5. Navigate to http://localhost:8000 to see the site.
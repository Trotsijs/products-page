<?php declare(strict_types=1);

use App\Core\Renderer;
use App\Core\Router;

require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$response = Router::response();
$renderer = new Renderer(__DIR__ . '/../App/Views');

echo $renderer->render($response);

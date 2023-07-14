<?php declare(strict_types=1);

use App\Core\Redirect;
use App\Core\Renderer;
use App\Core\Router;
use App\Core\TwigView;

require '../vendor/autoload.php';

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$response = Router::response();
$renderer = new Renderer(__DIR__ . '/../App/Views');

if ($response instanceof TwigView) {
    echo $renderer->render($response);
    unset($_SESSION['errors']);
}

if ($response instanceof Redirect) {
    header('Location: ' . $response->getLocation());
}


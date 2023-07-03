<?php

namespace App\Core;

use App\Controllers\ProductController;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router
{
    public static function response(): ?TwigView
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $router) {
            $router->addRoute('GET', '/', [ProductController::class, 'index']);
            $router->addRoute('GET', '/add-product', [ProductController::class, 'addProduct']);
        });

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                [$controllerName, $methodName] = $handler;
                /** @var TwigView $response */
                $response = (new $controllerName)->{$methodName}();

                return $response;
        }

        return null;
    }
}
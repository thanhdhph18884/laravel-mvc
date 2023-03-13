<?php
use Phroute\Phroute\RouteCollector;
use App\Controllers\ProductController;

$router = new RouteCollector();

$router->get('/', function () {
    return 'Thi het mon';
});

$router->get('/list', [ProductController::class, 'index']);
$router->get('/create', [ProductController::class, 'create']);
$router->post('/store', [ProductController::class, 'store']);
$router->get('/edit/{id}', [ProductController::class, 'edit']);
$router->post('/update/{id}', [ProductController::class, 'update']);
$router->get('/destroy/{id}', [ProductController::class, 'destroy']);


$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$url = isset($_GET['url']) ? ($_GET['url']) : '/';
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);
echo $response;

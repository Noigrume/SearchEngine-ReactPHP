<?php

require_once __DIR__ . '/../vendor/autoload.php';
require '../config.php';

use App\Middlewares\CorsMiddleware;
//CORS
CorsMiddleware::applyHeaders();

// basic router
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request) {

    case '/SearchEngine-ReactPHP/search-api/www/search':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new \App\Controllers\SearchController();
            echo $controller->searchProducts($_GET['query'] ?? '');
        } else {
            http_response_code(405);
            echo 'Method Not Allowed';
        }
        break;

    default:
        http_response_code(404);
        echo '404 Not Found';
        break;
}

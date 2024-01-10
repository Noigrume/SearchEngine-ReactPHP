<?php

require_once '../vendor/autoload.php';
require '../config.php';

use App\Middlewares\CorsMiddleware;
//CORS MIDDLEWARE
CorsMiddleware::applyHeaders();

// BASIC ROUTER
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request) {

    case '/SearchEngine-ReactPHP/search-api/www/search':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $query = $_GET['query'] ?? '';
            validateQuery($query);
            $controller = new \App\Controllers\SearchController();
            echo $controller->searchProducts($query);
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

// SANITIZE QUERY
function validateQuery($query)
{
    $query = trim($query);

    if (empty($query)) {
        http_response_code(400);
        echo 'Query parameter is required';
        exit;
    }

    // PAYLOAD TOO LARGE
    if (strlen($query) > 255) {
        http_response_code(413);
        echo 'Query too long';
        exit;
    }
}

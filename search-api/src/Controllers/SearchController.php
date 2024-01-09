<?php

namespace App\Controllers;

use App\Models\SearchModel;

class SearchController
{
    public function searchProducts($query)
    {
        $products = new SearchModel();
        return json_encode($products->searchProduct($query));
    }
}

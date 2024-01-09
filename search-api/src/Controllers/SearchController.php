<?php

namespace App\Controllers;

use App\Models\SearchModel;

class SearchController
{
    protected $musicModel;

    public function searchProducts($query)
    {
        $musics = new SearchModel();
        return json_encode($musics->searchProduct($query));
    }
}

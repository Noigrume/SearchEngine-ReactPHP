<?php

namespace App\Models;

use App\Config\Database;

class SearchModel
{
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function searchProduct($query)
    {
        $stmt = $this->db->prepare("SELECT title FROM oc_product_description WHERE title LIKE :query");
        $stmt->execute(['query' => '%' . $query . '%']);
        return $stmt->fetchAll();
    }
}

<?php

namespace App\Models;

use App\Config\Model;

class SearchModel extends Model
{

    public function searchProduct($query): array
    {

        $sql = 'SELECT 
        product.product_id, 
        product_description.name, 
        product_description.description,
        product_description.tag,
        product_description.main_tag
    FROM 
        oc_product product
    JOIN 
        oc_product_description product_description ON product.product_id = product_description.product_id
    JOIN 
        oc_product_to_store ps ON product.product_id = ps.product_id
    WHERE 
        product.status = 1 
        AND ps.store_id = 5 
        AND product_description.language_id = 1 
        AND product.subscription = 0
        AND (
            product_description.name LIKE CONCAT( ? ) 
            OR product_description.description LIKE CONCAT( ? ) 
            OR product_description.tag LIKE CONCAT( ? ) 
            OR product_description.main_tag LIKE CONCAT( ? )
        )
    ORDER BY 
        (product_description.main_tag LIKE CONCAT( ? )) DESC, 
        product.product_id;';

        $likeQuery = '%' . $query . '%';

        return self::$database->fetchAllRows($sql, [$likeQuery, $likeQuery, $likeQuery, $likeQuery, $likeQuery]);
    }
}

<?php

namespace App\Models;

use App\Config\Model;

class SearchModel extends Model
{

    public function searchProduct($query): array
    {
        //+ test + test2
        $sql = 'SELECT 
            product.product_id, 
            product_description.name, 
            product_description.title, 
            product_description.main_tag,
            -- extracts the value of filterName

-- THIS DOESNT WORK AS IS
            -- JSON_UNQUOTE(JSON_EXTRACT(
            --     product_description.filters_json, 
            --     CONCAT("$[", 
            --         JSON_UNQUOTE(
            --             JSON_SEARCH(
            --                 product_description.filters_json, 
            --                 "one", 
            --                 "editor rank ",  
            --                 NULL, 
            --                 "$[*].filterGroup"
            --             )
            --         ), 
            --     "].filterName")
            -- )) AS editor_rank
            JSON_UNQUOTE(JSON_EXTRACT(product_description.filters_json, "$[0].filterName" )) AS editor_rank
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
                -- FULLTEXT SEARCH DOESNT WORK WITH MULTIPLE FIELDS
                MATCH(product_description.description) AGAINST(? )
                OR MATCH(product_description.tag) AGAINST(?)
                OR MATCH(product_description.main_tag) AGAINST(?)
            --     product_description.description LIKE  
                OR product_description.title LIKE  ?
            --     OR product_description.tag LIKE  
            --     OR product_description.main_tag LIKE  
             )
            ORDER BY 
            -- PRIORITIZE MAIN_TAG
                CASE 
                    WHEN product_description.main_tag LIKE CONCAT(?) THEN 1
                    ELSE 2
                END, 
            -- THEN BY EDITOR RANK
            editor_rank DESC';

        $likeQuery = '%' . $query . '%';
        // Count the number of ? in the SQL query (event in comments !)
        $placeholderCount = substr_count($sql, '?');
        $parameters = array_fill(0, $placeholderCount, $likeQuery);
        return self::$database->fetchAllRows($sql, $parameters);
    }
}

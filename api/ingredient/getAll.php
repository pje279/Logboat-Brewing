<?php

require '../init.php';
require '../tools.php';

$query = '  SELECT    ingredient.id, 
                    ingredient.name, 
                    supplier, 
                    quantity, 
                    unitId, 
                    unit.name as unitName 
            FROM ingredient 
            LEFT OUTER JOIN unit ON unitId=unit.id 
            ORDER BY ingredient.name';

if(($result = $link->query($query))) {
    $ingredients = array();
    
    while($row = $result->fetch_assoc()) {
        array_push($ingredients, $row);
    }
    
    
    
    success($ingredients);
}

fail("Error getting ingredients");
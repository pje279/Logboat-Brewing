
<?php
require '../init.php';
require '../tools.php';
$query = 
    'SELECT
        ing.id, 
        ing.name, 
        ing.supplier, 
        ing.quantity,
        ing.unitId, 
        unit.name as unitName 
    FROM ingredient AS ing
        LEFT OUTER JOIN unit ON ing.unitId = unit.id
    WHERE (unit.name = "lbs" AND ing.quanity < 10) OR (unit.name = "bags" AND ing.quantity < 10) OR (unit.name = "oz" AND ing.quanity < 25) 
    ORDER BY ing.name';
if(($result = $link->query($query))) {
    $ingredients = array();
    
    while($row = $result->fetch_assoc()) {
        array_push($ingredients, $row);
    }
    
    success($ingredients);
}
fail("Error getting ingredients");

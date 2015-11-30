<?php

require '../init.php';
require '../tools.php';

$query = 'SELECT * FROM ingredient ORDER BY name';

if(($result = $link->query($query))) {
    $ingredients = array();
    
    while($row = $result->fetch_assoc()) {
        array_push($ingredients, $row);
    }
    
    success($ingredients);
}

fail("Error getting ingredients");
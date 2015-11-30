<?php

require '../init.php';
require '../tools.php';

$query = 'SELECT * FROM unit';

if(($result = $link->query($query))) {
    $units = array();
    
    while($row = $result->fetch_assoc()) {
        array_push($units, $row);
    }
    
    success($units);
}

fail("Error performing query");
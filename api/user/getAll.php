<?php

require '../init.php';
require '../tools.php';

$query = 'SELECT * FROM userSafe ORDER BY username';

if(($result = $link->query($query))) {
    $users = array();
    
    while($row = $result->fetch_assoc()) {
        array_push($users, $row);
    }
    
    success($users);
}

fail("Error getting users");
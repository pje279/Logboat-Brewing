<?php

require '../init.php';
require '../tools.php';

$name = htmlspecialchars($_POST['name']);
$supplier = htmlspecialchars($_POST['supplier']);
$quantity = $_POST['quantity'];
$unitId = $_POST['unitId'];

//TODO: handle cases for empty supplier / quantity

$query = 'INSERT INTO ingredient VALUES (DEFAULT, ?, ?, ?, ?)';

if(($stmt = $link->prepare($query))) {
    
    $stmt->bind_param("ssdd", $name, $supplier, $quantity, $unitId);
    
    if($stmt->execute()) {
        success();
    }
}

fail("Error creating ingredient");
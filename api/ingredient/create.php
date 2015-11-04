<?php

require '../init.php';
require '../tools.php';

$name = htmlspecialchars($_POST['name']);
$supplier = htmlspecialchars($_POST['supplier']);
$quantity = $_POST['quantity'];
$units = htmlspecialchars($_POST['units']);

//TODO: handle cases for empty supplier / quantity

$query = 'INSERT INTO ingredient VALUES (DEFAULT, ?, ?, ? , ?)';

if(($stmt = $link->prepare($query))) {
    
    $stmt->bind_param("ssds", $name, $supplier, $quantity, $units);
    
    if($stmt->execute()) {
        success();
    }
    
    fail("Failed to execute");
}

fail("Failed to prepare query");
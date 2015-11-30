<?php

require '../init.php';
require '../tools.php';

$id = htmlspecialchars($_POST['id']);
$name = htmlspecialchars($_POST['name']);
$supplier = htmlspecialchars($_POST['supplier']);
$quantity = $_POST['quantity'];
$unitId = $_POST['unitId'];

$query = 'UPDATE ingredient SET name=?, supplier=?, quantity=?, unitId=? WHERE id=?';

if(($result = $link->query($query))) {
    
    $stmt->bind_param("ssddd", $name, $supplier, $quantity, $unitId, $id);
    
    if($stmt->execute()) {
        success();
    }
}

fail("Error updating ingredient");
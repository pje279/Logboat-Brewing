<?php

require '../init.php';

$result = array();

$name = htmlspecialchars($_POST['name']);
$supplier = htmlspecialchars($_POST['supplier']);
$quantity = $_POST['quantity'];
$units = htmlspecialchars($_POST['units']);

//TODO: handle cases for empty supplier / quantity

$query = 'INSERT INTO ingredient VALUES (DEFAULT, ?, ?, ? , ?)';

if(($stmt = $link->prepare($query))) {
    
    $stmt->bind_param("ssds", $name, $supplier, $quantity, $units);
    
    if($stmt->execute()) {
        $result['success'] = true;
        echo json_encode($result);
        exit();
    }
    
    $result['error'] = 'Failed to execute';
    
} else {
    $result['error'] = 'Failed to prepare query';
}

$result['success'] = false;
echo json_encode($result);
exit();
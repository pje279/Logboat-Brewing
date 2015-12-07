<?php

require '../init.php';
require '../tools.php';

$name = htmlspecialchars($_POST['name']);
$supplier = htmlspecialchars($_POST['supplier']);
$quantity = $_POST['quantity'];
$unitId = $_POST['unitId'];
$lowIngredient = $_POST['low'];

//TODO: handle cases for empty supplier / quantity

/* This is the old query. Current schema doesn't support $unitId */
$query = 'INSERT INTO ingredient VALUES (DEFAULT, ?, ?, ?, ?, ?)';


$stmt = $link->prepare($query);

$stmt->bind_param("ssdd", $name, $supplier, $quantity, $unitId, $lowIngredient);

if($stmt->execute()) {
    success();
} else {
    fail($stmt->error);
}
    //     success();
    // } else {
    //     fail("Error creating ingredient");
    // }


// fail("Error creating ingredient");

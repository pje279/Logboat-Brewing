<?php

require '../init.php';
require '../tools.php';

if(!isLoggedIn()) {
    fail("Only logged in users can update beer recipes");
}

$id = htmlspecialchars($_POST['beerId']);
$name = htmlspecialchars($_POST['name']);
$beerTypeId = htmlspecialchars($_POST['beerTypeId']);
$createdBy = $_SESSION['userId'];

$query = 'UPDATE beer SET name=?, createdBy=?, beerTypeId=? WHERE id=?';

$stmt = $link->prepare($query);
    
$stmt->bind_param("sddd", $name, $createdBy, $beerTypeId, $id);

if($stmt->execute()) {
    success();
} else {
    fail("Error: " . $stmt->error);
}
<?php

require '../init.php';
require '../tools.php';

if(!isLoggedIn()) {
    fail("Only logged in users can create beer recipes");
}

//Beer attributes
$name = htmlspecialchars($_POST['name']);
$beerTypeId = htmlspecialchars($_POST['beerTypeId']);
$createdBy = htmlspecialchars($_SESSION['userId']);

$query = 'INSERT INTO beer VALUES (DEFAULT, ?, ?, ?)';

$stmt = $link->prepare($query);

$stmt->bind_param("sdd", $name, $createdBy, $beerTypeId);

if($stmt->execute()) {
    success();
}

fail($stmt->error);
<?php

require '../init.php';
require '../tools.php';

if(!isLoggedIn()) {
    fail("Only logged in users can update beer recipes");
}

$id = htmlspecialchars($_POST['id']);
$name = htmlspecialchars($_POST['name']);
$createdBy = $_SESSION['userId'];
$beerTypeId = $_POST['beerTypeId'];

$query = 'UPDATE beer SET name=?, createdBy=?, beerTypeId=? WHERE id=?';

$stmt = $link->prepare($query);

$stmt->bind_param("sddd", $name, $createdBy, $beerTypeId, $id);

if($stmt->execute()) {
    success();
}

fail($stmt->error);
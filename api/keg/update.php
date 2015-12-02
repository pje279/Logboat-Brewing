<?php

require '../init.php';
require '../tools.php';

if(!isLoggedIn()) {
    fail("Only logged in users can update kegs");
}

$id = htmlspecialchars($_POST['kegId']);
$serialNum = htmlspecialchars($_POST['serialNum']);

$query = 'UPDATE keg SET serialNum=? WHERE id=?';

$stmt = $link->prepare($query);
    
$stmt->bind_param("sd", $serialNum, $id);

if($stmt->execute()) {
    success();
} else {
    fail("Error: " . $stmt->error);
}
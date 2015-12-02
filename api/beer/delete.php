<?php

require '../init.php';
require '../tools.php';

if(!isLoggedIn()) {
    fail("Only logged in users can delete beer recipes");
}

$id = htmlspecialchars($_POST['beerId']);

$query = 'DELETE FROM beer WHERE id = ? LIMIT 1';

$stmt = $link->prepare($query);

$stmt->bind_param("d", $id);

if($stmt->execute()) {
    success();
} else {
    fail($stmt->error);
}
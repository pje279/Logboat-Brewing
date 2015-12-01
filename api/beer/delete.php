<?php

require '../init.php';
require '../tools.php';

$id = htmlspecialchars($_POST['id']);

$query = 'DELETE FROM ingredient WHERE id = ? LIMIT 1';

$stmt = $link->prepare($query);

$stmt->bind_param("d", $id);

if($stmt->execute()) {
    success();
} else {
    fail($stmt->error);
}
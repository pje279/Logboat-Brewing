<?php

require '../init.php';
require '../tools.php';

try {
    $data = Database::runQuery("INSERT INTO keg (serialNum) VALUES (:serialNum)", array("serialNum" => $_POST['serialNum']));
    success();
} catch (Exception $e) {
    fail("Error in api/update.php: " . $e->getMessage());
}
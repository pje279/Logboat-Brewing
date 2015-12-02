<?php

require '../init.php';
require '../tools.php';

try {
    Database::runQuery("DELETE FROM brew WHERE id = :brewid LIMIT 1", array("brewid" => (int)$_POST['brewId']));
    success();
} catch (PDOException $e) {
    fail("Error in api/schedule/create.php: " . $e->getMessage());
}
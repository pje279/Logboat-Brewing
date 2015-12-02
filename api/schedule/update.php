<?php

require '../init.php';
require '../tools.php';


$brewStart = new DateTime($_POST['brewStart']);
$brewStart = $brewStart->format("Y-m-d H:i:s");

$brewEnd = new DateTime($_POST['brewEnd']);
$brewEnd = $brewEnd->format("Y-m-d H:i:s");

try {
    $data = Database::runQuery("UPDATE brew
                                SET brewStart = :brewStart,
                                    brewEnd = :brewEnd,
                                    quantity = :quantity,
                                    beerId = :beerId,
                                    userId = :userId
                                WHERE id = :brewId"
                                , array(
                                    "brewStart" => $brewStart,
                                    "brewEnd" => $brewEnd,
                                    "quantity" => (int) $_POST['quantity'],
                                    "beerId" => (int) $_POST['beerId'],
                                    "userId" => (int) $_POST['userId'],
                                    "brewId" => (int) $_POST['brewId'])
                                );
    if($data) {
        success();
    } else {
        fail("Error in api/schedule/create.php: $data not valid");
    }
} catch (PDOException $e) {
    fail("Error in api/schedule/create.php: " . $e->getMessage());
}

?>
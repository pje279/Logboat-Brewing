<?php

require '../init.php';
require '../tools.php';

$brewStart = new DateTime($_POST['brewStart']);
$brewStart = $brewStart->format("Y-m-d H:i:s");

$brewEnd = new DateTime($_POST['brewEnd']);
$brewEnd = $brewEnd->format("Y-m-d H:i:s");

try {
    $data = Database::runQuery("INSERT INTO brew (brewStart, brewEnd, quantity, beerId, userId)
                                VALUES (:brewStart, :brewEnd, :quantity, :beerId, :userId)"
                                , array(
                                    "brewStart" => $brewStart,
                                    "brewEnd" => $brewEnd,
                                    "quantity" => (int) $_POST['quantity'],
                                    "beerId" => (int) $_POST['beerId'],
                                    "userId" => $_SESSION['userId'])
                                );
    if($data) {
        success();
    } else {
        fail("Error in api/schedule/create.php: $data not valid");
    }
} catch (PDOException $e) {
    fail("Error in api/schedule/create.php: " . $e->getMessage());
}

fail("Testing Fail");

?>
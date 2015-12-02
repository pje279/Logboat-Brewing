<?php

require '../init.php';
require '../tools.php';

$events = json_decode($_POST['events']);

if(!is_array($events)) {
    fail("Error: Expecting an Array of Events.");
}

// foreach($events as $event) {
//     $date = new DateTime($event->start);
//     echo $date->format("Y-m-d H:i:s") . "<br>\n";
// }

// foreach($events as $event) {
//     echo $event->start;
// }

// print_r($events);
$conn = Database::getConn();
$stmt = $conn->prepare("UPDATE brew
                        SET brewStart = :brewStart,
                            brewEnd = :brewEnd
                        WHERE id = :brewId");

foreach($events as $event) {
    $eventStart = new DateTime($event->start);
    $eventStart = $eventStart->format("Y-m-d H:i:s");
    
    $eventEnd = new DateTime($event->end);
    $eventEnd = $eventEnd->format("Y-m-d H:i:s");
    
    $bind_params = array("brewStart" => $eventStart, "brewEnd" => $eventEnd, "brewId" => $event->id);

    $stmt->execute($bind_params);
}

success();

// foreach($events as $event) {
//     $eventStart = new DateTime($event->start);
//     $eventStart = $eventStart->format("Y-m-d H:i:s");
    
//     $eventEnd = new DateTime($event->end);
//     $eventEnd = $eventEnd->format("Y-m-d H:i:s");
    
//     try {
//         Database::runQuery(
//             "UPDATE brew
//             SET brewStart = :brewStart,
//                 brewEnd = :brewEnd
//             WHERE id = :brewId"
//             , array("brewStart" => $eventStart, "brewEnd" => $eventEnd, "brewId" => $event->id));
        
//     } catch (PDOException $e) {
//         fail("Error in api/schedule/saveFullCalendar.php: " . $e->getMessage());
//     }
// }


<?php

require '../init.php';
require '../tools.php';

$events = json_decode($_POST['events']);

if(!is_array($events)) {
    fail("Error: Expecting an Array of Events.");
}

print_r($events);

// try {
//     foreach($events as $event) {
//         $event['start']['i']
//     }
// }
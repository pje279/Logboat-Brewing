<?php

require '../init.php';
require '../tools.php';

$query = 
    "SELECT 
        keg.id as kegId,
        keg.serialNum,
        kegorder.id as kegOrderId,
        kegorder.customerId as customerId,
        customer.firstName as customerFirstName,
        customer.lastName as customerLastName
    FROM keg
    LEFT OUTER JOIN 
        (SELECT * FROM kegorder WHERE returned = 0) AS kegorder
        ON kegorder.kegId=keg.id
    LEFT OUTER JOIN customer ON kegorder.customerId = customer.id
    GROUP BY keg.id";

if(($data = Database::runQuery($query))) {
    success($data);
}

fail("Error in keg/getAll.php");
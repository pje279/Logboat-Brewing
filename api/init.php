<?php

//Master VM
$link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "be1dbd64a86c89", "3b83625d", "logboatdb") or fail("Connection error " . mysql_error($link));

header('Content-type: application/json');

session_start();

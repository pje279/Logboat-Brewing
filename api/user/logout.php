<?php

//Unset the session variables
session_unset();

//Destroy the session
$result['success'] = session_destroy();

//Set the result
echo json_encode($result);
exit();

<?php

require '../init.php';
require '../tools.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$query = "INSERT INTO user VALUES (DEFAULT, ? ?)";

//TODO: I don't think this is totally secure because their password could be intercepted
//when calling this API hook, but it is better than before.

if(($stmt = $link->prepare($query))) {
    
    $hashedPass = password_hash($password, PASSWORD_BCRYPT);
    
    $stmt->bind_param("ss", $username, $hashedPass);
    
    if($stmt->execute()) {
        success();
    }
    
    fail("Failed to execute");
}

fail("Failed to prepared query");
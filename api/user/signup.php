<?php

require '../init.php';
require '../tools.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$query = "INSERT INTO user VALUES (DEFAULT, ?, ?, DEFAULT, DEFAULT)";

//TODO: I don't think this is totally secure because their password could be intercepted
//when calling this API hook, but it is better than before.

if(($stmt = $link->prepare($query))) {
    
    //Salts and hashes our passwords for us using BlowFish.
    $hashedPass = password_hash($password, PASSWORD_BCRYPT);
    
    $stmt->bind_param("ss", $username, $hashedPass);
    
    if($stmt->execute()) {
        success();
    }
    
    fail("Failed to execute");
} else {   
    fail("Failed to prepare query");
}
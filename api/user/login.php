<?php

require '../init.php';
require '../tools.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

//$query = "SELECT id FROM user WHERE username = '$username' AND password = '$password'";
$query = "SELECT id, password, is_admin FROM user WHERE username = '$username'";

if(($stmt = $link->prepare($query))) {
    
    $stmt->execute();
    $stmt->store_result();
    
    //User does not exist in database
    if($stmt->num_rows == 0) {
        fail();
    }
    
    //Fetch result
    $stmt->bind_result($id, $storedPass, $isAdmin);
    $stmt->fetch();
    
    if(!password_verify($password, $storedPass)) {
        fail("Incorrect username or password");
    }
    
    //Start session 
    session_start();
    $_SESSION['userId'] = $id;
    $_SESSION['username'] = $username;
    $_SESSION['isAdmin'] = $isAdmin;
    
    success();
}
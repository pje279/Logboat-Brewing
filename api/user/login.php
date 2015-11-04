<?php

require '../init.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

//$query = "SELECT id FROM user WHERE username = '$username' AND password = '$password'";
$query = "SELECT id, password FROM user WHERE username = '$username'";

function fail() {
    $result['success'] = false;
    $result['error'] = 'Invalid username or password.';
    echo json_encode($result);
    exit();
}

if(($stmt = $link->prepare($query))) {
    
    $stmt->execute();
    $stmt->store_result();
    
    $result = array();
    
    //User does not exist in database
    if($stmt->num_rows == 0) {
        fail();
    }
    
    //Fetch result
    $stmt->bind_result($id, $storedPass);
    $stmt->fetch();
    
    if(!password_verify($password, $storedPass)) {
        fail();
    }
    
    //Start session 
    session_start();
    $_SESSION['userId'] = $id;
    $_SESSION['username'] = $username;
    
    success();
}
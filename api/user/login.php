<?php

require '../init.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$query = "SELECT id FROM user WHERE username = '$username' AND password = '$password'";

if(($stmt = $link->prepare($query))) {
    
    $stmt->execute();
    $stmt->store_result();
    
    $result = array();
    
    //Password does not match username
    if($stmt->num_rows == 0) {
        $result['success'] = false;
        $result['error'] = 'Invalid username or password.';
        echo json_encode($result);
        exit();
    }
    
    //Fetch result
    $stmt->bind_result($id);
    $stmt->fetch();
    
    //Start session 
    session_start();
    $_SESSION['userId'] = $id;
    $_SESSION['username'] = $username;
    
    $result['success'] = true;
    echo json_encode($result);
    exit();
}
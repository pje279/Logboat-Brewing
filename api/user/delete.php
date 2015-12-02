<?php

require '../init.php';
require '../tools.php';

if(!isUserAdmin()) {
    fail("Only admins can delete user accounts");
}

$userId = htmlspecialchars($_POST['id']);

$query = 'DELETE FROM user WHERE id=?';

if(($stmt = $link->prepare($query))) {
    
    $stmt->bind_param("s", $userId);
    
    if($stmt->execute()) {
        if($stmt->affected_rows > 0) {
            success();
        }
        
        fail("User does not exist");
    }
    
    fail("Error deleting user: " . $stmt->error);
}

fail("Error deleting user");
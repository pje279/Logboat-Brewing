<?php

function fail($error) {
    $data = array();
    $data['success'] = false;
    $data['error'] = $error;
    echo json_encode($data);
    exit();
}

function success($resultArr) {
    $data = array();
    $data['success'] = true;
    $data['result'] = $resultArr;
    echo json_encode($data);
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['userId']);
}

function isUserAdmin() {
    return isLoggedIn() && $_SESSION['isAdmin'];
}
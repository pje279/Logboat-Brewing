<?php

function fail($error) {
    $result = array();
    $result['success'] = false;
    $result['error'] = $error;
    echo json_encode($result);
    exit();
}

function success() {
    $result = array();
    $result['success'] = true;
    echo json_encode($result);
    exit();
}
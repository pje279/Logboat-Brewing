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

function getBaseUrl() {
    //return "https://cs3380-jam9rd.cloudapp.net/LogboatBrewing/";    //Jacob
    //Pearse
    //Devun
    //Seth
    //Peter
    return "https://logboat.cloudapp.net/";                       //Master VM
}

/*
 * Create a random string
 * @author XEWeb <http://www.xeweb.net>
 * @param $length the length of the string to create
 * @return $str the string
 */
function randomString($length = 6) {
    $str = "";
    $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
    $max = count($characters) - 1;
    
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}
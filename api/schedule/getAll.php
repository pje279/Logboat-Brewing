<?php

require '../init.php';
require '../tools.php';

$dateStart = $_GET['start'] . " 00:00:00";
$dateEnd = $_GET['end'] . " 23:59:59";

$returnJSON = array();;

$events = Database::runQuery("  SELECT
                                  brew.id AS brewId,
                                  brew.brew_start,
                                  brew.brew_end,
                                  brew.quantity,
                                  brew.beerid,
                                  brew.userid,
                                  beer.name AS beerName,
                                  u.username as username,
                                  u.id as userId
                                FROM
                                  brew
                                LEFT OUTER JOIN
                                  beer ON beerid = beer.id
                                LEFT OUTER JOIN
                                  `user` AS u ON userid = u.id
                                WHERE brew_start BETWEEN :start1 AND :end1
                                OR brew_end BETWEEN :start2 AND :end2"
                            , array(    "start1" => $dateStart,
                                        "start2" => $dateStart,
                                        "end1" => $dateEnd,
                                        "end2" => $dateEnd)
                            );

foreach($events as $event) {
    $returnJSON[] = array(  'title'     => $event['beerName'] . " " .$event['brewId'],
                            'start'     => $event['brew_start'],
                            'end'       => $event['brew_end'],
                            'editable'  => ($event['userid']) == $_SESSION['userId'] ? true : false);
}

echo json_encode($returnJSON);
?>
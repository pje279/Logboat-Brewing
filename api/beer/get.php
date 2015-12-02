<?php

require '../init.php';
require '../tools.php';

if(!isLoggedIn()) {
    fail("Only logged in users can get recipes");
}

$beerId = htmlspecialchars($_GET['beerId']);

$query =
    "SELECT 
        beer.id,
        beer.name,
        beer.beerTypeId,
        beer.beerType,
        beer.createdBy,
        user.username
    FROM
        (SELECT
            beer.id,
            beer.name,
            beer.beerTypeId,
            beerType.name as beerType,
            beer.createdBy
        FROM beer INNER JOIN beerType
            ON beer.beerTypeId = beerType.id)
        AS beer
    INNER JOIN user
        ON beer.createdBy = user.id
    WHERE beer.id= :id
    LIMIT 1";

$bind_params = array("id" => $beerId);

if(($data = Database::runQuery($query, $bind_params))) {
    success($data[0]);
}

fail("Error in beer/get.php");
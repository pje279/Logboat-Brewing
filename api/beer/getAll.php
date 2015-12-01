<?php

require '../init.php';
require '../tools.php';

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
        ON beer.createdBy = user.id";

if(($data = Database::runQuery($query))) {
    success($data);
}

fail("Error in beer/getAll.php");
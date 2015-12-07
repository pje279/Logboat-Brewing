<?php

require '../init.php';
require '../tools.php';

try {
    $brews = Database::runQuery(
    	"SELECT
    		brew.id AS brewId,
    		brew.brewStart,
    		brew.brewEnd,
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
    		`user` AS u ON userid = u.id");
    success($brews);
} catch (PDOException $e) {
    fail("Error in api/getBrews: " . $e->getMessage());
}
	
?>	
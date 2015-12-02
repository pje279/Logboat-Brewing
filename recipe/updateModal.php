<?php
require '../utilities/init.php';
require '../utilities/tools.php';

$data = Database::runQuery("SELECT * FROM beer WHERE id = :id", array("id" => $_GET['beerId']));
$beer = $data[0]; // Grab the first result (should only be one)
?>
<form id="updateBeerRecipeForm" method="post" action="<?= getBaseUrl(); ?>api/beer/update.php">
    <input type="hidden" name="beerId" id="beerId" value="<?= $beer['id']; ?>">
    <div id="errorMessage" class="alert alert-danger text-center" role="alert" style="display: none;"></div>
    <div class="form-group">
        <label for="name">Beer Name</label>
        <input type="text" class="form-control" id="name" name="name" maxlength="50" required value="<?= $beer['name'] ?>">
    </div>
    <div class="form-group">
        <label for="beerTypeId">Beer Type</label>
        <select name="beerTypeId" class="form-control">
            <?php 
            $beerTypes = Database::runQuery("SELECT * FROM beerType ORDER BY name");
            foreach($beerTypes as $beerType) {
                if($beerType['id'] == $beer['beerTypeId']) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                echo "<option value='{$beerType['id']}' $selected>{$beerType['name']}</option>";
            }
            ?>
        </select>
    </div>
</form>
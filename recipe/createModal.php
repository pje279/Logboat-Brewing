<?php
require '../utilities/init.php';
require '../utilities/tools.php';

?>
<form id="createBeerRecipeForm" method="post" action="<?php echo getBaseUrl(); ?>api/beer/create.php">
    <div id="errorMessage" class="alert alert-danger text-center" role="alert" style="display: none;"></div>
    <div class="form-group">
        <label for="name">Beer Name</label>
        <input type="text" class="form-control" id="name" name="name" maxlength="50" required>
    </div>
    <div class="form-group">
        <label for="beerTypeId">Beer Type</label>
        <select name="beerTypeId" class="form-control">
            <?php 
            $beerTypes = Database::runQuery("SELECT * FROM beerType ORDER BY name");
            foreach($beerTypes as $beerType) {
                echo "<option value='{$beerType['id']}'>{$beerType['name']}</option>";
            }
            ?>
        </select>
    </div>
</form>
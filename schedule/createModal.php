<?php
require '../utilities/init.php';
require '../utilities/tools.php';

?>
<form id="createBrewForm" method="post" action="<?php echo getBaseUrl(); ?>api/schedule/create.php">
    <div id="errorMessage" class="alert alert-danger text-center" role="alert" style="display: none;"></div>
    
    <div class="form-group">
        <label for="beerId">Beer</label>
        <select name="beerId" class="form-control">
            <?php 
            $beers = Database::runQuery("SELECT * FROM beer");
            foreach($beers as $beer) {
                echo "<option value='{$beer['id']}'>{$beer['name']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="brewStart">Start Brew</label>
        <div class="input-group date datepicker" id="startDatepicker">
            <input type="text" class="form-control" name="brewStart">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="brewEnd">End Brew</label>
        <div class="input-group date datepicker" id="endDatepicker">
            <input type="text" class="form-control"  name="brewEnd">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" value='0' required>
    </div>
</form>
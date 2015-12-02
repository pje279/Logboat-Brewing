<?php
require '../utilities/init.php';
require '../utilities/tools.php';

$data = Database::runQuery("SELECT * FROM brew WHERE id = :id", array("id" => $_GET['brewId']));
$data = $data[0]; // Grab the first result (should only be one)

?>
<form id="updateBrewForm" method="post" action="<?php echo getBaseUrl(); ?>api/schedule/create.php">
    <div id="errorMessage" class="alert alert-danger text-center" role="alert" style="display: none;"></div>
    <input type="hidden" name="brewId" id="brewId" value="<?php echo $data['id']; ?>">
    <input type="hidden" name="userId" id="userId" value="<?php echo $data['userId']; ?>">
    
    <div class="form-group">
        <label for="beerId">Beer</label>
        <select name="beerId" class="form-control">
            <?php 
            $beers = Database::runQuery("SELECT * FROM beer");
            foreach($beers as $beer) {
                echo "<option value='{$beer['id']}'" . ($data['beerId'] == $beer['id'] ? " selected" : "") . ">{$beer['name']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="brewStart">Start Brew</label>
        <div class="input-group date datepicker" id="startDatepicker" data-givenDate="<?= $data['brewStart'] ?>">
            <input type="text" class="form-control" name="brewStart">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="brewEnd">End Brew</label>
        <div class="input-group date datepicker" id="endDatepicker" data-givenDate="<?= $data['brewEnd'] ?>">
            <input type="text" class="form-control"  name="brewEnd">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" value='<?= $data['quantity'] ?>' required>
    </div>
</form>
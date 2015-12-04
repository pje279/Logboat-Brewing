<!DOCTYPE html>
<html>
<body>
  <form id="selectBrewFermentation" method="post" action="<?php echo getBaseUrl(); ?>api/analytics/select.php">
  <div class="form-group">
        <label for="brewId">Beer</label>
        <select name="brewId" class="form-control">
          <?php 
            $brews = Database::runQuery("SELECT brew.id AS brewId,beer.name AS beerName FROM brew LEFT JOIN beer ON brew.beerID = beer.id");
            foreach($brew as $brews) {
              echo "<option value='{$brew['brewId']}'>{$brew['beerName']} . ' - ' . {$brew[brewId]}</option>";
            }
          ?>
        </select>
        <select name="fermentationId" class="form-control">
          <?php
            $types = Database::runQuery("SELECT * from fermentationType");
            foreach($types as $type) {
              echo "<option value='{$type['id']}'>{$type['name']}</option>";
            }
          ?>
        </select>
        <button type="button" class="btn btn-primary">Submit</button>
  </div>
  </form>
</body>
</html>
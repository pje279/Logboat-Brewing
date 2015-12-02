<!DOCTYPE html>
<html>
<body>
  <form id="selectBrewFermentation" method="post" action="<?php echo getBaseUrl(); ?>api/analytics/select.php">
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

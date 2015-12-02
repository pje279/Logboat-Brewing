<?php
require '../utilities/init.php';
require '../utilities/tools.php';
if(!isLoggedIn()) {
    header("Location: " . getBaseUrl() . "user/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Logboat Brewing</title>
  <?php require '../utilities/links.php'; ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
</head>
<body>
  <?php require '../navbar.php'; 
  $dates = Database::runQuery("SELECT brewStart, brewEnd FROM brew where id= :id",array("id",$_POST['fermentationId']);
  ?>
    <div class="container">
      <div class="form-group">
        <label for="value">Value</label>
        <input type"text" class="form-control" id="value" name="value" required>
      </div>
      <div class="form-group">
        <label for="fermentationDate">Fermentation Collection Date</label>
        <div class="input-group date datepicker" id="startDatepicker">
            <input type="text" class="form-control" name="fermentationDate">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
      </div>
      <button type="button" class="btn btn-primary">Submit</button>
    </div>
</body>
</html>

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
  ?>
    <div class="container">
      <form id="addBrewFermentation" method="post" action="<?php echo getBaseUrl(); ?>api/anayltics/addAnayltics.php"> <!-- need to send the selected brews info to addAnayltics.php for proper insertion along with this other data-->
        <div class="form-group">
          <label for="value">Value</label>
          <input type"text" class="form-control" id="value" name="value" required>
        </div>
        <!-- Need to add time in the picker or elsewhere because datetime is required -->
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
      </form>

      <div id="chartContainer">
        <script type="text/javascript"> 
          $.get("../api/analytics/chartData.php", function(jsonData) {
            var ctx = document.getElementById("chart").getContext("2d");
            var chartObj = new Chart(ctx).Line(jsonData.chartData);
          }
        </script>
      </div>

    </div>
</body>
</html>
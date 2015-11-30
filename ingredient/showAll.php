<?php
require '../utilities/init.php';
require '../utilities/tools.php';

?>
<html>
    <head>
        <title>Logboat Brewing</title>
        <?php require '../utilities/links.php'; ?>
        
        <script>
            $(document).ready(function() {
                $.get("../api/ingredient/getAll.php", function(data) {
                    for(var i = 0, len = data.result.length; i < len; i++) {
                        $("#getAllTable").append("<tr><td>" +
                                                 data.result[i].name +
                                                 "</td><td>" +
                                                 data.result[i].supplier +
                                                 "</td><td>" + 
                                                 data.result[i].quantity +
                                                 "</td><td>" +
                                                 data.result[i].unitName +
                                                 "</td></tr>");
                    }
                
                });
            });
        </script>
    </head>
    <body>
        <?php require '../navbar.php'; ?>
        <div class="container">
            <div class="row">
                <a href="<?php echo getBaseUrl(); ?>ingredient/create.php">Add a New Ingredient</a>
                <table id="getAllTable" class="table table-hover">
                <?php
                
                echo "<th>Name</th><th>Supplier</th><th>Quantity</th><th>Units</th>";
                
                
                ?>
            </div>
        </div>
    </body>
</html>
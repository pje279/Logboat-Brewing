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
                                                 data.return.name +
                                                 "</td><td>" +
                                                 data.return.supplier +
                                                 "</td><td" + 
                                                 data.return.quantity +
                                                 "</tr>");
                    }
                
                });
            });
        </script>
    </head>
    <body>
        <?php require 'navbar.php'; ?>
        
        <table id="getAllTable">
        <?php
        
        echo "<th>Name</th><th>Supplier</th><th>Quantity</th>";
        
        
        ?>
    </body>
</html>
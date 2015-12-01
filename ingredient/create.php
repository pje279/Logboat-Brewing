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
                $("#createIngredientForm").submit(function(e) {
                    e.preventDefault();
                    $.post("../api/ingredient/create.php", $("#createIngredientForm").serialize(), function(jsonData) {
                        if(jsonData.success === false) {
                            $("#errorMessage")
                                .html(jsonData.error)
                                .slideDown("fast")
                                .delay(10000)
                                .slideUp(1000);
                        } else {
                            window.location = "../ingredient/showAll.php";
                        }
                    });
                });
                
                //Open Modal for each row
                
            });
        </script>
    </head>
    <body>
        <?php require '../navbar.php'; ?>
        <div class="container">
            <div class="row">
                <form id="createIngredientForm" method="post" action="<?php echo getBaseUrl(); ?>api/ingredient/create.php">
                    <h2 class="text-center">Create New Ingredient Form</h2>
                    <div id="errorMessage" class="alert alert-danger text-center" role="alert" style="display: none;"></div>
                    <div class="form-group">
                        <label for="name">Ingredient Name</label>
                        <input type="text" class="form-control" id="name" name="name" maxlength="100" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier">Supplier</label>
                        <input type="text" class="form-control" id="supplier" name="supplier" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value='0' required>
                    </div>
                    <div class="form-group">
                        <label for="unitId">Units</label>
                        <select name="unitId" class="form-control">
                            <?php 
                            $units = Database::runQuery("SELECT * FROM unit");
                            foreach($units as $unit) {
                                echo "<option value='{$unit['id']}'>{$unit['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default pull-right">Add Ingredient</button>
                </form>
            </div>
        </div>
    </body>
</html>
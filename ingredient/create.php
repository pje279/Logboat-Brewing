<?php
require '../utilities/init.php';
require '../utilities/tools.php';

?>
<html>
    <head>
        <title>Logboat Brewing</title>
        <?php require '../utilities/links.php'; ?>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <form method="post" action="<?php echo getBaseUrl(); ?>api/ingredient/create.php">
                    <div class="form-group">
                        <label for="name">Ingredient Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier">Supplier</label>
                        <input type="text" class="form-control" id="supplier" name="supplier">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value='0' required>
                    </div>
                    <div class="form-group">
                        <label for="unitid">Units</label>
                        <select name="unitid" class="form-control">
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
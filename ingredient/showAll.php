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
                    $("#showAllLoading").fadeOut("slow", function() {
                        for(var i = 0, len = data.result.length; i < len; i++) {
                            $("#getAllTable").append("<tr data-ingredientId='" + data.result[i].id + "'><td>" +
                                                     data.result[i].name +
                                                     "</td><td>" +
                                                     data.result[i].supplier +
                                                     "</td><td>" + 
                                                     data.result[i].quantity +
                                                     "</td><td>" +
                                                     data.result[i].unitName +
                                                     "</td></tr>");
                        }
                        // Set all the rows to open modal
                        $("#getAllTable tr").each(function() {
                            $(this).click(function() {
                                console.log("Clicked");
                                $.get("updateModal.php", {"ingredientId": $(this).attr("data-ingredientId")}, function(data) {
                                    $("#showAllModal .modal-body").html(data);
                                    $("#showAllModal").modal('toggle');
                                });
                            });
                        });
                    });
                    
                });
                // Set modal buttons
                $("#modalSave").click(function() {
                    $.post("../api/ingredient/update.php", $("#updateIngredientForm").serialize(), function(jsonData) {
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
                
                $("#modalDelete").click(function() {
                    if(confirm("Are you sure you want to delete this ingredient? This is not reversable!")) {
                        $.post("../api/ingredient/delete.php", {"id":$("#updateIngredientForm > #ingredientId").val()} , function(jsonData) {
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
                </table>
                <div id="showAllLoading" class="col-xs-2 col-xs-offset-5"><i class="fa fa-circle-o-notch fa-spin fa-5x text-center"></i></div>
            </div>
        </div>
        
        <!--Modal Used for clicking on a row-->
        <div class="modal fade" id="showAllModal" tabindex="-1" role="dialog" aria-labelledby="showAllModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel">Update Ingredient Form</h4>
                    </div>
                    <div class="modal-body">
                        <p>Text</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close Without Saving</button>
                        <button id="modalDelete" type="button" class="btn btn-danger">Delete Ingredient</button> 
                        <button id="modalSave" type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
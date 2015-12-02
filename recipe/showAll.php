<?php
require '../utilities/init.php';
require '../utilities/tools.php';

if(!isLoggedIn()) {
    header("Location: " . getBaseUrl() . "user/login.php");
    exit();
}
?>
<html>
    <head>
        <title>Logboat Brewing</title>
        <?php require '../utilities/links.php'; ?>
        
        <script>
            $(document).ready(function() {
                //Get all of the rows
                $.getJSON("../api/beer/getAll.php", function(data) {
                    
                    $("#showAllLoading").fadeOut("slow", function() {
                        
                        data.result.forEach(function(beer) {
                            $("#getAllTable").append("<tr data-beerId='" + beer.id + "'><td>" +
                                                     beer.name +
                                                     "</td><td>" +
                                                     beer.beerType +
                                                     "</td><td>" + 
                                                     beer.username +
                                                     "</td></tr>");
                        });
                        
                        //Set all the rows to open modal
                        $("#getAllTable tr").each(function() {
                            $(this).click(function() {
                                console.log("Clicked");
                                $("#updateModal .modal-body").html("<div style='text-align: center;'><i class='fa fa-beer fa-spin fa-5x text-center'></i></div>");
                                $("#updateModal").modal('toggle');
                                $.get("updateModal.php", {"beerId": $(this).attr("data-ingredientId")}, function(data) {
                                    $("#updateModal .modal-body div").fadeOut("slow", function() {
                                        $("#updateModal .modal-body").hide().html(data).slideDown("slow");
                                    });
                                });
                            });
                        });
                    });
                });
                
                $.getJSON("<?= getBaseUrl(); ?>api/beer/get.php?beerId=1", function(data) {
                    console.log(data);
                });
                
                //Set Create Modal links
                $(".callCreateModal").click(function(e) {
                    e.preventDefault();
                    $("#createModal .modal-body").html("<div style='text-align: center;'><i class='fa fa-beer fa-spin fa-5x text-center'></i></div>");
                    $("#createModal").modal('toggle');
                    $.get("createModal.php", function(data) {
                        $("#createModal .modal-body div").fadeOut("slow", function() {
                            $("#createModal .modal-body").hide().html(data).slideDown("slow");
                        });
                    });
                });
                
                // Set modal buttons
                $(".modalSave").click(function() {
                    if($("#updateIngredientForm input#name").val() == '') {
                        $("#errorMessage")
                            .html("Please Enter an Ingredient Name")
                            .slideDown("fast")
                            .delay(10000)
                            .slideUp(1000);
                    } else if ($("#updateIngredientForm input#name").val().length > 100) {
                        $("#errorMessage")
                            .html("Ingredient Name can be no longer than 100 characters")
                            .slideDown("fast")
                            .delay(10000)
                            .slideUp(1000);
                    } else {
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
                    }
                });
                
                $(".modalDelete").click(function() {
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
                
                $(".modalCreate").click(function() {
                    if($("#createKegForm input#serialNum").val() == '') {
                        $("#errorMessage")
                            .html("Please Enter a Keg Serial Number")
                            .slideDown("fast")
                            .delay(10000)
                            .slideUp(1000);
                    } else if ($("#createKegForm input#serialNum").val().length > 50) {
                        $("#errorMessage")
                            .html("Serial Number can be no longer than 50 characters")
                            .slideDown("fast")
                            .delay(10000)
                            .slideUp(1000);
                    } else {
                        $.post("../api/keg/create.php", $("#createKegForm").serialize() , function(jsonData) {
                            if(jsonData.success === false) {
                                $("#errorMessage")
                                    .html(jsonData.error)
                                    .slideDown("fast")
                                    .delay(10000)
                                    .slideUp(1000);
                            } else {
                                window.location = "../keg/showAll.php";
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
                <a href="<?php echo getBaseUrl(); ?>recipe/create.php" class="callCreateModal">Add a New Beer Recipe</a>
                <table id="getAllTable" class="table table-hover">
                    <th>Beer Name</th><th>Type</th><th>Created By</th>
                </table>
                <div id="showAllLoading" style="text-align: center;"><i class="fa fa-beer fa-spin fa-5x text-center"></i></div>
            </div>
        </div>
        
        <!--Modal Used for clicking on a row-->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel">Update Beer Recipe Form</h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close Without Saving</button>
                        <button type="button" class="modalDelete btn btn-danger">Delete Recipe</button> 
                        <button type="button" class="modalSave btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Modal Used for new ingredient-->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel">New Beer Recipe Form</h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close Without Saving</button>
                        <button type="button" class="modalCreate btn btn-primary">Create Recipe</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
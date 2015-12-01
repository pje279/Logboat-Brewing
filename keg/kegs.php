<!DOCTYPE html>
<html>
    <head>
        <title>Logboat Brewing</title>
    </head>
    <body>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input type="submit" name="insert" value="Insert">
            <input type="submit" name="update" value="Update">
            <input type="submit" name="remove" value="Remove">
        </form>
    </body>
</html>

<?php
    if(issset($_POST['insert'])){   
        
    }
    if(issset($_POST['update'])){   
        
    }
    if(issset($_POST['remove'])){   
        
    }
?>
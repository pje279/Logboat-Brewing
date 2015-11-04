<?php

session_start();

if(isset($_SESSION['userId'])){
    header("Location: start.php");
    exit;
}

if(isset($_POST['inputUsername'])){
    
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Logboat Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <h2 class="text-center">Please Sign In</h2>
                    <label for='inputUsername' class="sr-only">Username</label>

                    <input type="text" id="inputUsername" name="inputUsername" class="form-control input-lg" placeholder="Username" required autofocus>
                    <label for='inputpassword' class="sr-only">Password</label>
                    <input type="password" id="inputpassword" name="inputpassword" class="form-control input-lg" placeholder="Password" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
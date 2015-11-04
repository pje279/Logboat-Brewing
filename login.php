<?php

session_start();

if(isset($_SESSION['userId'])){
    header("Location: start.php");
    exit;
}

// if(isset($_POST['inputUsername'])){
    
//     $_SESSION['triedUsername'] = $_POST['inputUsername'];
//     $apiURL = 'api/user/login.php';
//     $curl = curl_init($apiURL);
//     $curl_post_data = array(
//         "username" => $_POST['inputUsername'],
//         "password" => $_POST['inputPassword']
//         );
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($curl, CURLOPT_POST, true);
//     curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
//     $curl_response = curl_exec($curl);
//     curl_close($curl);
//     print_r($_POST);
//     echo "<br>";
//     print_r($_SESSION);
//     // header("Location: {$_SERVER['PHP_SELF']}");
//     // exit;
// }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Logboat Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#errorMessage").hide();
            $("#loginForm").submit(function(e) {
                e.preventDefault();
                $.post("api/user/login.php", $("#loginForm").serialize(),function(data) {
                    var jsonData = $.parseJSON(data);
                    console.dir(jsonData);
                    if(jsonData.success == false){
                        $("#errorMessage")
                            .html(jsonData.error)
                            .slideDown("fast")
                            .delay(10000)
                            .slideUp(1000);
                        $("#inputPassword").val("");
                        $("#inputUsername").focus().select();
                    } else {
                        window.location.href = "start.php";
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form id="loginForm">
                    <h2 class="text-center">Please Sign In</h2>
                    <div id="errorMessage" class="alert alert-danger text-center" role="alert"></div>
                    <label for='inputUsername' class="sr-only">Username</label>
                    <input type="text" id="inputUsername" name="inputUsername" class="form-control input-lg" placeholder="Username" required autofocus<?php echo $triedUsername; ?>>
                    <label for='inputpassword' class="sr-only">Password</label>
                    <input type="password" id="inputPassword" name="inputPassword" class="form-control input-lg" placeholder="Password" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
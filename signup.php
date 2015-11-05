<!DOCTYPE html>
<html>
<head>
    <title>Logboat Login</title>
    <?php require 'utilities/links.php'; ?>
    
    <script>
        $(document).ready(function() {
            $("#errorMessage").hide();
            $("#loginForm").submit(function(e) {
                e.preventDefault();
                
                var password = $("#password").val();
                var confirmPassword = $("#confirmPassword").val();
                
                if(password !== confirmPassword) {
                    $("#errorMessage")
                            .html("Passwords do not match")
                            .slideDown("fast");
                    $("#password").focus().select();
                    return;
                }
                
                $.post("api/user/signup.php", $("#loginForm").serialize(),function(data) {
                    var jsonData = $.parseJSON(data);
                    console.dir(jsonData);
                    if(jsonData.success === false){
                        $("#errorMessage")
                            .html(jsonData.error)
                            .slideDown("fast")
                            .delay(10000)
                            .slideUp(1000);
                        $("#username").focus().select();
                    } else {
                        window.location.href = "home.php";
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
                    <h2 class="text-center">Sign up</h2>
                    <div id="errorMessage" class="alert alert-danger text-center" role="alert"></div>
                    
                    <!-- Username -->
                    <div class="form-group">
                        <label for='username' class="sr-only">Username</label>
                        <input type="text" id="username" name="username" class="form-control input-lg" placeholder="Username" required autofocus<?php echo $triedUsername; ?>>
                    </div>
                        
                    <!-- Password -->
                    <div class="form-group">
                        <label for='password' class="sr-only">Password</label>
                        <input type="password" id="password" name="password" class="form-control input-lg" placeholder="Password" required>
                    </div>
                    
                    <!-- Confirm password -->
                    <div class="form-group">
                        <label for='confirmPassword' class="sr-only">Confirm Password</label>
                        <input type="password" id="confirmPassword" class="form-control input-lg" placeholder="Confirm password" required>
                    </div>
                    
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
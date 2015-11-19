<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Inventory</a></li>
        <li><a href="#">Orders</a></li>
        <li><a href="#">Scheduling</a></li>
        <li><a href="#">Analytics</a></li>
        <li><a href="#">Keg Rentals</a></li>
        <li><a href="#">Reports</a></li>
        
        <?php if(isset($_SESSION['userId']) && $_SESSION['isAdmin']) { ?>
            
        <li><a href="users.php">Users</a></li>
        
        <?php } ?>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <?php if(!isset($_SESSION['userId'])) { ?>
          
            <li><a href="login.php">Login</a></li>
            
          <?php } else { ?>
            
            <li style="height:50px">
                <div class="center-vertical">
                    <p class="center-block text-center" style="margin:0">Logged in as:</p>
                    <a class="center-block text-center" style="padding:0" href="#"><?= $_SESSION['username'] ?></a>
                </div>
            </li>
            <li><a href="api/user/logout.php">Logout</a></li>
            
          <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
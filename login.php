<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'header.php';?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Log in</title>

</head>
<body class="hold-transition login-page bg-dark">
<div class="login-box">
  <div class="login-logo">
  <a href="index.php"><img src="media/logo.png" alt="AdminLTE Logo" class="brand-image " style="opacity: .8"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
            <?php
            session_start();
            if(isset($_SESSION["ERROR"]))
            	echo "<span style='color:red;'>" .$_SESSION["ERROR"] . "</span><br/>";
            ?>
      <form action="loginAction.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="Pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
           <button class="btn custom-btn col-12" style="wdijth:100%">Login</button>
        </div>
      </form>

   
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


</body>
</html>

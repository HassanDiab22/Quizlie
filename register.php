<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'header.php';?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration</title>

</head>
<body class="hold-transition register-page bg-dark">
<div class="register-box">
  <div class="register-logo ">
    <a href="index.php"><img src="media/logo.png" alt="AdminLTE Logo" class="brand-image " style="opacity: .8"></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>
            <?php
            session_start();
            if(isset($_SESSION["ERROR_Reg"]))
            	echo "<span style='color:red;'>" .$_SESSION["ERROR_Reg"] . "</span><br/>";
            ?>
      <form action="registerAction.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="Username">
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
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="Confirm">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
           <button class="btn custom-btn col-12" style="wdijth:100%">Register</button>
        </div>
      </form>

     

      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>

</body>
</html>

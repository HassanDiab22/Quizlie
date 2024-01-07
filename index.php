<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <?php include 'header.php';?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
 <?php include 'nav.php'?>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> 📝Recent Quizliez📝 </h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
    <div class="container">
  <div class="row">
    <?php
    $query = "SELECT * FROM quiz ";
    $result = mysqli_query($con, $query);
    while( $row = mysqli_fetch_array($result) ) {
      $cover='';
      if($row['cover']==''){
        $cover='media/logo.png';
      }else{
        $cover=$row['cover'];
      }
      echo'<div class="col-md-4" style="height:100%">
      <div class="card" style="width: 18rem;height:100%">
        <img class="card-img-top" src="'.$cover.'" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">'.$row['title'].'</h5>
          <p class="card-text">'.$row['description'].'</p>';
          if(isset($_SESSION["LoggedIN"])){
            if($_SESSION["LoggedIN"]){
              echo '<a href="quizattempt.php" class="btn custom-btn ">🎉 Take The Quiz 🎉 </a>';
              }
          }else{
            echo '<a href="login.php" class="btn custom-btn ">👋Sign IN To Enjoy👋</a>';
          }
          
        echo '</div>
      </div>
    </div>';
    }
    ?>
    

    
  </div>
</div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


</body>
</html>

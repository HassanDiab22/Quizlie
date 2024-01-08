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
  <div class="content-wrapper " >
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->
    <?php
    $query1 = "SELECT * FROM user where user_id=".$_SESSION["UserId"];
    $query2 = "SELECT * FROM quiz where user_id=".$_SESSION["UserId"];
    $query3 = "SELECT COUNT(*) as attempt_count FROM quiz_attempt WHERE user_id = " . $_SESSION["UserId"];
    $result1 = mysqli_query($con, $query1);
    $result2 = mysqli_query($con, $query2);
    $result3 = mysqli_query($con, $query3);
    $score=0;
    $quizes_created=0;
    $quizes_attempted=0;
    
    function statusCalculator($score){
        if($score>=0 && $score<=200){
            $profilepic='media/profiles/noob.png';
            return '👶noob👶';
        }elseif ($score>=201 && $score<=400){
            $profilepic='media/profiles/king.png';
            return '👑king👑';
        }else{
            $profilepic='media/profiles/goat.png';
            return '🐐goat🐐';
        }
    }
    function profileGetter($score){
        if($score>=0 && $score<=200){
            return'media/profiles/noob.png';
        }elseif ($score>=201 && $score<=400){
            return 'media/profiles/king.png';
        }else{
            return 'media/profiles/goat.png';

        }
    }
    while( $row = mysqli_fetch_array($result1) ) {
        $username=$row['username'];
        $score=$row['score'];
    }
    while( $row = mysqli_fetch_array($result2) ) {
        $quizes_created++;
    }
    while( $row = mysqli_fetch_array($result3) ) {
        $quizes_attempted=$row['attempt_count'];
    }
    $status=statusCalculator($score);
    $profilepic=profileGetter($score);
    ?>
    <!-- Main content -->
    <div class="content pt-1" >
    <div class="container" style="background-color: ;">
  <div class="row">
        <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-warning text-light">
                <h3 class="widget-user-username text-light"><?php echo $username;?></h3>
                <h5 class="widget-user-desc text-light"><?php echo $status;?></h5>
              </div>
              <div class="widget-user-image"> 
                
                <img class="img-circle elevation-2" src="<?php echo $profilepic;?>" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $score;?></h5>
                      <span class="description-text">Score</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $quizes_created;?></h5>
                      <span class="description-text">Quizes Created</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $quizes_attempted;?></h5>
                      <span class="description-text">Quizes Attempted</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
        </div> 
        <?php
$query2 = "SELECT * FROM quiz WHERE user_id=" . $_SESSION["UserId"];
$result2 = mysqli_query($con, $query2);

while ($row = mysqli_fetch_array($result2)) {
    $cover = ($row['cover'] == '') ? 'media/logo.png' : $row['cover'];
    
    echo '<div class="col-md-4" style="height:100%">
        <div class="card" style="width: 18rem;height:100%">
            <img class="card-img-top" src="' . $cover . '" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">' . $row['title'] . '</h5>
                <p class="card-text">' . $row['description'] . '</p>';

    if (isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"]) {
        echo '<a href="attemptPage.php?quizID=' . $row['quiz_id'] . '" class="btn custom-btn col-12 ">🎉 Take The Quiz 🎉</a>
            <a href="editQuiz.php?quizID=' . $row['quiz_id'] . '" class="btn custom-btn col-12 mt-2">&#9999; Edit Quiz &#9999;</a>
            <a href="deleteQuiz.php?quizID=' . $row['quiz_id'] . '" class="btn custom-btn col-12 mt-2" onclick="return confirm(\'Are you sure you want to delete this quiz?\')">&#128465; Delete Quiz &#128465</a>';
    } else {
        echo '<a href="login.php" class="btn custom-btn">👋 Sign IN To Enjoy 👋</a>';
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

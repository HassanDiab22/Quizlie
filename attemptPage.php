<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php';?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attempt</title>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include 'nav.php'?>
        <?php
              if (!isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"] != 1) {
                  header("Location: login.php");
              }
              
              if (!isset($_GET["quizID"])) {
                header("Location: notfound.php");
            }
                $quizID = mysqli_real_escape_string($con, $_GET["quizID"]); 
                $query = "SELECT * FROM quiz WHERE quiz_id = $quizID";
                
                $result = mysqli_query($con, $query);
            
                if (!$result || mysqli_num_rows($result) === 0) {
                    header("Location: notfound.php");
                }else{
                    $row = mysqli_fetch_assoc($result);
                }
            
            

            ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <!-- <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> 🧠Create A Quizlie🧠 </h1>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="card col-12" id="card">

                            
                                <div class="card-body" >
                                    <?php 
                                    $cover='';
                                    if($row['cover']==''){
                                      $cover='media/logo.png';
                                    }else{
                                      $cover=$row['cover'];
                                    }
                                    echo'<div class="col-md-12" style="height:100%">
                                    <div class="card" style="width: 100%;height:100%">
                                     
                                      <div class="card-body">
                                        <h5 class="card-title">'.$row['title'].'</h5>
                                        <p class="card-text">'.$row['description'].'</p>';
                                        if(isset($_SESSION["LoggedIN"])){
                                          if($_SESSION["LoggedIN"]){
                                            echo '<a href="attemptAction.php?quizID='.$row['quiz_id'].'" class="btn custom-btn col-12">🎉 Take The Quiz 🎉 </a>';
                                            }
                                        }else{
                                          echo '<a href="login.php" class="btn custom-btn col-12">Start</a>';
                                        }
                                        
                                      echo '</div>
                                    </div>
                                  </div>';
                                  
                                    ?>
                                   
                                </div>
                                <!-- /.card-body -->

                                
                            </form>

                        </div>
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
        <?php include 'footer.php';?>
    </div>
    <!-- ./wrapper -->



</body>
</html>

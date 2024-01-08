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
  <title>Edit</title>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
 <?php include 'nav.php'?>
  <!-- /.navbar -->
<!-- ... (previous code) ... -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="card col-12" id="card">
                    <div class="card-body">
                    <table class="table table-bordered">
        <thead>
            <tr>
                <th>QUESTION</th>
                <th>C1</th>
                <th>C2</th>
                <th>C3</th>
                <th>C4</th>
                <th>CORRECT ANSWER</th>
                <th>EDIT</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once("Config.php");


            if (!isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"] != 1) {
                header("Location: login.php");
            }
            
            if (isset($_GET["quizID"])) {
                
                $quizID = $_GET["quizID"];
            
                $userID = $_SESSION["UserId"];
                $checkOwnershipQuery = "SELECT * FROM question WHERE quiz_id = $quizID";
                $result = mysqli_query($con, $checkOwnershipQuery);
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['question_text'] . '</td>';
                    echo '<td>' . $row['choice1'] . '</td>';
                    echo '<td>' . $row['choice2'] . '</td>';
                    echo '<td>' . $row['choice3'] . '</td>';
                    echo '<td>' . $row['choice4'] . '</td>';
                    echo '<td>' . $row['correct_choice'] . '</td>';
                    echo '<td><a href="editQuestion.php?qid=' . $row['question_id'] . '" class="btn btn-primary">🏃‍♂️ Edit Question 🏃‍♂️</a></td>';
                    echo '</tr>';
                }
                
               
            } else {
                // quizID parameter is not set
                echo "Invalid request.";
                exit();
            }
            
            ?>
        </tbody>
    </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ... (remaining code) ... -->

</body>
</html>

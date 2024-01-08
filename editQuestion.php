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

<?php
if (!isset($_SESSION["LoggedIN"]) || $_SESSION["LoggedIN"] != 1) {
    header("Location: login.php");
}

if (isset($_GET["qid"])) {
    $questionId = $_GET["qid"];
    $sql = "SELECT * FROM question WHERE question_id = $questionId";
    $result = $con->query($sql);
    $questionDetails;
    if ($result) {
        $questionDetails = $result->fetch_assoc();
    }else{
        header("Location: notfound.php");
    }
} else {
    header("Location: error.php");
    exit();
}

if (isset($_POST["edit_question"])) {
    // Handle the update logic here
    $updatedTitle = mysqli_real_escape_string($con, $_POST["quiz_title"]);
    $updatedChoice1 = mysqli_real_escape_string($con, $_POST["choice_1"]);
    $updatedChoice2 = mysqli_real_escape_string($con, $_POST["choice_2"]);
    $updatedChoice3 = mysqli_real_escape_string($con, $_POST["choice_3"]);
    $updatedChoice4 = mysqli_real_escape_string($con, $_POST["choice_4"]);
    $updatedRightChoice = intval($_POST["right_choice"]); // Assuming it's an integer value
    
    $updateQuery = "UPDATE question 
                    SET question_text = '$updatedTitle', 
                        choice1 = '$updatedChoice1', 
                        choice2 = '$updatedChoice2', 
                        choice3 = '$updatedChoice3', 
                        choice4 = '$updatedChoice4', 
                        correct_choice = $updatedRightChoice 
                    WHERE question_id = $questionId";

    if (mysqli_query($con, $updateQuery)) {
        
        header("Location: retriveQuestions.php?quizID=".$questionDetails['quiz_id']);
        exit();
    } else {
        // Handle the case when the update query fails
        echo "Error updating question: " . mysqli_error($con);
    }
}
?>
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

                            <form method="post"  enctype="multipart/form-data" id="questionForm">
                            <div class="card-header">
                                            <h3 class="card-title">Edit Question</h3>
                            </div>
                                            <div class="card-body" >
                                              <div class="form-group">
                                                <label for="question_title"> title</label>
                                                <input type="text" class="form-control" id="quiz_title" placeholder="Enter Quiz Title" name="quiz_title" value="<?php echo $questionDetails['question_text'] ;?>" required>
                                              </div>
                                              <div class="form-group">
                                                <label for="choice_1">choice 1️⃣</label>
                                                <input type="text" class="form-control" id="choice_1" placeholder="Enter choice 1" name="choice_1" value="<?php echo $questionDetails['choice1'] ;?>" required>
                                              </div>
                                              <div class="form-group">
                                                <label for="choice_2">choice 2️⃣</label>
                                                <input type="text" class="form-control" id="choice_2" placeholder="Enter choice 2" name="choice_2" value="<?php echo $questionDetails['choice2'] ;?>" required>
                                              </div>
                                              <div class="form-group">
                                                <label for="choice_3">choice 3️⃣</label>
                                                <input type="text" class="form-control" id="choice_3" placeholder="Enter choice 3" name="choice_3" value="<?php echo $questionDetails['choice3'] ;?>" required>
                                              </div>
                                              <div class="form-group">
                                                <label for="choice_4">choice 4️⃣</label>
                                                <input type="text" class="form-control" id="choice_4" placeholder="Enter choice 4" name="choice_4" value="<?php echo $questionDetails['choice4'] ;?>" required>
                                              </div>
                            
                                              <div class="form-group">
                                                <label for="right_choice">Correct Answer ✅</label>
                                                <input type="number" class="form-control" id="right_choice" value="<?php echo $questionDetails['correct_choice'] ;?>" name="right_choice" max="4" min="1" required>
                                              </div>
                                              
                            
                                            </div>
                                            <!-- /.card-body -->
                                            
                                            <button  class="btn custom-btn btn-block" name="edit_question" type="submit">
                                            ⭐ Update ⭐
                                                </button>
                            </form>
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

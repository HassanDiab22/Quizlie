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
require_once("Config.php");


if (!isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"] != 1) {
    header("Location: login.php");
}

if (isset($_GET["quizID"])) {
    
    $quizID = $_GET["quizID"];

    $userID = $_SESSION["UserId"];
    $checkOwnershipQuery = "SELECT * FROM quiz WHERE quiz_id = $quizID AND user_id = $userID";
    $result = $con->query($checkOwnershipQuery);

    if ($result) {
        $quiz = $result->fetch_assoc();
    } else {
        // Quiz does not belong to the user
        echo "You do not have permission to edit this quiz.";
        exit();
    }
} else {
    // quizID parameter is not set
    echo "Invalid request.";
    exit();
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">&#9999; <?php echo $quiz['title'];?> &#9999; </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="card col-12" id="card">
                    <div class="card-body">
                        <form method="post" action="editQuizAction.php/?quiz_id=<?php echo $quizID ;?>" enctype="multipart/form-data" id="quizForm">
                            <div class="form-group">
                                <label for="quiz_title">Quiz title 🧛‍♂️</label>
                                <input type="text" class="form-control" id="quiz_title" value="<?php echo $quiz['title']; ?>" placeholder="Enter Quiz Title" name="quiz_title" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description 📝 (Max 150 characters)</label>
                                <textarea class="form-control" rows="3" maxlength="150" placeholder="Enter Description..." id="description" name="description"  required><?php echo $quiz['description']; ?></textarea>

                            </div>

                           

                            <div class="form-group">
                                <label for="exampleInputFile">Quiz Cover Image 🎨</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="quiz_cover" accept="image/*">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <!-- ... (remaining form elements) ... -->

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary col-12 custom-btn" name="edit">⭐ Update ⭐</button>
                            </div>
                        </form>
                        <a href="retriveQuestions.php?quizID=<?php echo $quizID; ?>"><button  class="btn btn-primary col-12 custom-btn" name="edit"> 🤔 Edit Question  🤔</button></a>
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

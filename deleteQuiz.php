<?php
require_once("Config.php");
session_start();

if (!isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"] != 1) {
    header("Location: login.php");
}

if (isset($_GET["quizID"])) {
    
    $quizID = $_GET["quizID"];

    $userID = $_SESSION["UserId"];
    $checkOwnershipQuery = "SELECT * FROM quiz WHERE quiz_id = $quizID AND user_id = $userID";
    $result = mysqli_query($con, $checkOwnershipQuery);

    if (mysqli_num_rows($result) > 0) {
        $deleteQuizQuery = "DELETE FROM quiz WHERE quiz_id = $quizID";
        

        if ($con->query($deleteQuizQuery) ) {
            header("Location: profile.php");
            exit();
        } else {
            echo "Error deleting quiz. Please try again.";
        }
    } else {
        echo "You do not have permission to delete this quiz.";
    }
} else {
    // quizID parameter is not set
    echo "Invalid request.";
}
?>
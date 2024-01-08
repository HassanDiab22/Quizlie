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
        // Quiz belongs to the user, proceed with deletion
        $deleteQuizQuery = "DELETE FROM quiz WHERE quiz_id = $quizID";
        

        // Perform deletion
        if ($con->query($deleteQuizQuery) && $con->query($deleteAttemptsQuery)) {
            // Deletion successful
            header("Location: profile.php");
            exit();
        } else {
            // Deletion failed
            echo "Error deleting quiz. Please try again.";
        }
    } else {
        // Quiz does not belong to the user
        echo "You do not have permission to delete this quiz.";
    }
} else {
    // quizID parameter is not set
    echo "Invalid request.";
}
?>
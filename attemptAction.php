<?php
require_once("Config.php"); 
session_start();

if(isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"] ){
    $user_id = $_SESSION["UserId"];
    $quizID = mysqli_real_escape_string($con, $_GET["quizID"]); 
    $query = "SELECT * FROM quiz WHERE quiz_id = $quizID";
    $result = mysqli_query($con, $query);
    // if (!$result || mysqli_num_rows($result) === 0) {
    //     echo 'hi';
    //     header("Location: notfound.php");
    // }
    echo $quizID;
    $row = mysqli_fetch_assoc($result);
    
    $number_questions=$row['number_questions'];
    $sql = "INSERT INTO quiz_attempt (user_id, quiz_id) 
    VALUES ($user_id,$quizID)";
    
    if ($con->query($sql) === TRUE) {
    
    // Store the quiz information in the session
    $_SESSION["attempt_id"] = $con->insert_id;;
    $_SESSION["quiz_id"] = $quizID;
    echo 'success man congrats';
    header('Location: attemptQuestionPage.php');
    } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    }
    
} else {
    header("Location: login.php");
}
?>

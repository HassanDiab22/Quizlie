<?php
session_start();
require_once("Config.php");

if (isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"] == 1) {
    $user_id = $_SESSION["UserId"];
    $quiz_id = $_SESSION["quiz_id"];
    $counter = $_SESSION["questions_number"];


        // Retrieve form data
        $count = $_POST['count'];
        $question_title = mysqli_real_escape_string($con, $_POST['quiz_title']);
        $choice_1 = mysqli_real_escape_string($con, $_POST['choice_1']);
        $choice_2 = mysqli_real_escape_string($con, $_POST['choice_2']);
        $choice_3 = mysqli_real_escape_string($con, $_POST['choice_3']);
        $choice_4 = mysqli_real_escape_string($con, $_POST['choice_4']);
        $right_choice = mysqli_real_escape_string($con, $_POST['right_choice']);

        // Validate and sanitize the data (add more validation as needed)
        $question_title = htmlspecialchars(trim($question_title));
        $choice_1 = htmlspecialchars(trim($choice_1));
        $choice_2 = htmlspecialchars(trim($choice_2));
        $choice_3 = htmlspecialchars(trim($choice_3));
        $choice_4 = htmlspecialchars(trim($choice_4));
        $right_choice = intval($right_choice); // Ensure it's an integer

        // Insert the question into the Question table
        $sql = "INSERT INTO Question (quiz_id, question_text, choice1, choice2, choice3, choice4, correct_choice) 
                VALUES ($quiz_id, '$question_title', '$choice_1', '$choice_2', '$choice_3', '$choice_4', '$right_choice')";
        $con->query($sql);
      

        if ($counter == $count) {
       
           echo 'done';
           unset($_SESSION["quizTitle"]);
           unset($_SESSION["quiz_id"]);
           unset($_SESSION["questions_number"]);
           unset($_SESSION["count"]);
                   
          
        }
       

} else {
    // Redirect to the login page if not logged in
    header("Location: login.php");
}
?>

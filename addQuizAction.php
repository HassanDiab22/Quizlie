<?php
require_once("Config.php"); 
session_start();

if(isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"] ){
    $user_id = $_SESSION["UserId"];

    $quizTitle = isset($_POST['quiz_title']) ? mysqli_real_escape_string($con, $_POST['quiz_title']) : '';
    $description = isset($_POST['description']) ? mysqli_real_escape_string($con, $_POST['description']) : '';
    $numberQuestions = isset($_POST['number_questions']) ? intval($_POST['number_questions']) : 0;

    $coverImagePath = "media/";
    if(isset($_FILES['quiz_cover']['name']) && $_FILES['quiz_cover']['name'] !=""){
        $coverImageExtension = pathinfo($_FILES['quiz_cover']['name'], PATHINFO_EXTENSION);
        $coverImageName = time() . '_' . uniqid() . '.' . $coverImageExtension;
        $coverImageTmpName = $_FILES['quiz_cover']['tmp_name'];
        move_uploaded_file($coverImageTmpName, $coverImagePath . $coverImageName);
    } else {
        $coverImageName = 'default.png';
    }

    if (!empty($quizTitle) && !empty($description) && $numberQuestions > 0) {
        $sql = "INSERT INTO quiz (title, description, number_questions, cover, user_id) 
                VALUES ('$quizTitle', '$description', $numberQuestions, '$coverImagePath$coverImageName', $user_id)";

        if ($con->query($sql) === TRUE) {
            $lastQuizId = $con->insert_id;

            $_SESSION["quizTitle"] = $quizTitle;
            $_SESSION["quiz_id"] = $lastQuizId;
            $_SESSION["questions_number"] = $numberQuestions;
            $_SESSION["count"]=1;
            echo 'success man congrats';
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
        echo "Error: Missing or invalid form data.";
    }
} else {
    header("Location: login.php");
}
?>
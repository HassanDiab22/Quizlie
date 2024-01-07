<?php
require_once("Config.php"); 
session_start();

if(isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"] ){
    $user_id = $_SESSION["UserId"];
    
        // Retrieve form data
        $quizTitle = isset($_POST['quiz_title']) ? $_POST['quiz_title'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $numberQuestions = isset($_POST['number_questions']) ? intval($_POST['number_questions']) : 0;
    
        // Validate and sanitize the data
        $quizTitle = htmlspecialchars(trim($quizTitle));
        $description = htmlspecialchars(trim($description));
    
        // Handle file upload
        $coverImagePath = "media/";
        var_dump($_FILES['quiz_cover']);
        if(isset($_FILES['quiz_cover']['name']) && $_FILES['quiz_cover']['name'] !=""){
            
            $coverImageExtension = pathinfo($_FILES['quiz_cover']['name'], PATHINFO_EXTENSION);
            $coverImageName = time() . '_' . uniqid() . '.' . $coverImageExtension;
            $coverImageTmpName = $_FILES['quiz_cover']['tmp_name'];
            move_uploaded_file($coverImageTmpName, $coverImagePath . $coverImageName);
        }else{
            $coverImageName='default.png';
        }
        
    
        // Check if essential values are not empty before executing the query
        if (!empty($quizTitle) && !empty($description) && $numberQuestions > 0) {
            // Prepare and execute the SQL query
            $sql = "INSERT INTO quiz (title, description, number_questions, cover, user_id) 
                    VALUES ('$quizTitle', '$description', $numberQuestions, '$coverImagePath$coverImageName', $user_id)";
    
            if ($con->query($sql) === TRUE) {
                // Get the ID of the last inserted quiz
                $lastQuizId = $con->insert_id;
    
                // Store the quiz information in the session
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

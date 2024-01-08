<?php
require_once("Config.php");
session_start();

if (isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"]) {
    $user_id = $_SESSION["UserId"];
    var_dump($_GET);
    // Retrieve form data
    $quiz_id = $_GET['quiz_id'] ;
    $quizTitle = isset($_POST['quiz_title']) ? $_POST['quiz_title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';


    // Validate and sanitize the data
    $quiz_id = htmlspecialchars(trim($quiz_id));
    $quizTitle = htmlspecialchars(trim($quizTitle));
    $description = htmlspecialchars(trim($description));
    $description = preg_replace("/(?<!\\\\)'/", "it", $description);
    // Handle file upload
    $coverImagePath = "media/";
    if (isset($_FILES['quiz_cover']['name']) && $_FILES['quiz_cover']['name'] != "") {
        $coverImageExtension = pathinfo($_FILES['quiz_cover']['name'], PATHINFO_EXTENSION);
        $coverImageName = time() . '_' . uniqid() . '.' . $coverImageExtension;
        $coverImageTmpName = $_FILES['quiz_cover']['tmp_name'];
        move_uploaded_file($coverImageTmpName, $coverImagePath . $coverImageName);
    } else {
        // If no new image is provided, keep the existing one
        $coverImageName = isset($_POST['existing_cover']) ? $_POST['existing_cover'] : 'default.png';
    }

    // Check if essential values are not empty before executing the query
    echo $quiz_id;
    echo $quizTitle;
    echo $description;
    if (!empty($quiz_id) && !empty($quizTitle) && !empty($description) ) {
        // Prepare and execute the SQL query
        $sql = "UPDATE quiz SET title = '$quizTitle', description = '$description', cover = '$coverImagePath$coverImageName' WHERE quiz_id = $quiz_id AND user_id = $user_id;";
            echo $sql;
        if ($con->query($sql) === TRUE) {
            echo 'success';
            header("index.php");
            
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

<?php
include 'header.php';
require_once("Config.php");
session_start();
$quiz_id = $_SESSION["quiz_id"];
$query = "SELECT * FROM quiz WHERE quiz_id = $quiz_id";
$result=$con->query($query);
if ($result) {
    $quiz = $result->fetch_assoc();
    $number_of_questions = $quiz['number_questions'];
} 
$quiz_attempt = $_SESSION["attempt_id"];
$score=0;
$q1="SELECT * FROM quiz_attempt WHERE attempt_id = $quiz_attempt ;";
$result1 = $con->query($q1);
if ($result1) {
    $row = $result1->fetch_assoc();
    $score = $row['score']; 
}    
$q2 = 'UPDATE user SET score = score + '.$score.' WHERE user_id = '.$_SESSION["UserId"];
$con->query($q2);
?>

<div class="info-box">
    <span class="info-box-icon bg-warning">
        <i class="far fa-star"></i>
    </span>
    <div class="info-box-content">
        <span class="info-box-text"><?php echo $_SESSION["Username"]; ?> Your score is</span>
        <span class="info-box-number"><?php echo $score; ?></span>
    </div>
    <a href="index.php"><button class="custom-btn" >
        Play More &#x1F525; 
    </button></a>
</div>
